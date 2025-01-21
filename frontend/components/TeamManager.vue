<script setup>
const props = defineProps({
  team: {
    type: Object,
    required: true,
  },
  isPlaying: {
    type: Boolean,
    default: true,
  },
  isDisabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update", "isReadyChanged"]);
const client = useSanctumClient();
const teamMembers = ref(props.team?.members ?? []);
const newMember = ref("");
const focusOnInput = ref(false);
const toast = useToast();
const { t } = useI18n();
const showInput = ref(false);
const loading = ref(false);

const roles = [
  { label: "Developer" },
  { label: "Scrum Master" },
  { label: "Product Owner" },
];

const unsetRoles = computed(() => {
  const currentRoles = teamMembers?.value.map((member) => member.role);
  return roles
    .map((role) => role.label)
    .filter((role) => role !== "Developer" && !currentRoles.includes(role));
});

const isReady = computed(() => {
  return unsetRoles.value.length === 0;
});

const preventInteraction = computed(() => {
  return props.isPlaying || props.isDisabled;
});

// Emit the isReady state to the parent component
onMounted(() => {
  emit("isReadyChanged", isReady.value, props.team.id);
});

watch(focusOnInput, (newVal) => {
  if (!newVal) {
    showInput.value = false;
  }
});

// If the team doesn't include all roles, propagate the information to the parent
watch(isReady, (newVal) => {
  emit("isReadyChanged", newVal, props.team.id);
});

async function addMember() {
  if (newMember.value === "") {
    return;
  }

  try {
    const response = await client(`/api/team/${props.team.id}/members`, {
      method: "PUT",
      body: {
        name: newMember.value,
        role: "Developer",
      },
    });

    if (!response) {
      throw new Error("No response from server");
    }
    newMember.value = "";

    teamMembers.value.push({
      id: response.id,
      name: response.name,
      role: response.role,
      refRow: ref(),
    });

    // Scroll to the bottom of the list when a new member is added
    await nextTick();
    const lastEntry = teamMembers.value[teamMembers.value.length - 1];

    if (lastEntry) {
      lastEntry.refRow.scrollIntoView({ behavior: "smooth", block: "end" });
    }
    showInput.value = false;
  } catch (error) {
    toast.add({
      title: useNuxtApp().$i18n.t("team_manager.add_member_error"),
      icon: "material-symbols:error",
      variant: "error",
    });
  }
}

async function deleteMember(memberId) {
  loading.value = true;
  try {
    await client(`/api/team/${props.team.id}/members/${memberId}`, {
      method: "DELETE",
    });
    toast.add({
      title: t("team_manager.member_deleted"),
      icon: "clarity:success-line",
      variant: "success",
    });

    // Refresh parent after member deletion
    emit("update");
  } catch (error) {
    toast.add({
      title: useNuxtApp().$i18n.t("team_manager.delete_member_error"),
      icon: "material-symbols:error",
      variant: "error",
    });
  } finally {
    loading.value = false;
  }
}

async function updateRole(memberId, newRole) {
  loading.value = true;
  const member = teamMembers.value.find((member) => member.id === memberId);
  const originalMember =
    newRole !== "Developer"
      ? teamMembers.value.find((m) => m.role === newRole && m.id !== memberId)
      : null;

  try {
    const [, response] = await Promise.all([
      originalMember
        ? client(`/api/team/${props.team.id}/members/${originalMember.id}`, {
            method: "PATCH",
            body: {
              name: originalMember.name,
              role: "Developer",
            },
          })
        : Promise.resolve(),
      client(`/api/team/${props.team.id}/members/${memberId}`, {
        method: "PATCH",
        body: {
          name: member?.name,
          role: newRole,
        },
      }),
    ]);

    if (originalMember) {
      originalMember.role = "Developer";

      toast.add({
        title: t("team_manager.role_taken.title"),
        description: t("team_manager.role_taken.description", {
          member: originalMember.name,
        }),
        icon: "mdi:alert-circle",
      });
    }

    if (!response) {
      throw new Error("No response from server");
    }

    // Update the role in the local state
    if (member) {
      member.role = newRole;
    }
  } catch (error) {
    toast.add({
      title: useNuxtApp().$i18n.t("team_manager.update_role_error"),
      icon: "material-symbols:error",
      variant: "error",
    });
  } finally {
    loading.value = false;
  }
}

function deleteTeam() {
  toast.add({
    icon: "mdi:trash-can-outline",
    title: t("team_manager.delete.are_you_sure", { name: props.team.name }),
    description: " ", // make buttons render on the bottom, not on the ride hand side
    timeout: 0,
    actions: [
      {
        label: t("team_manager.delete.delete_forever"),
        variant: "solid",
        color: "red",
        click: async () => {
          loading.value = true;
          try {
            await client(`/api/team/${props.team.id}`, { method: "DELETE" });
            toast.add({
              title: t("team_manager.delete.success"),
              icon: "mdi:success",
            });
            emit("update");
          } catch {
            toast.add({
              title: t("team_manager.delete.error"),
              icon: "material-symbols:error-outline",
            });
          } finally {
            loading.value = false;
          }
        },
      },
    ],
  });
}
</script>
<template>
  <div
    class="flex h-[11rem] w-[21rem] flex-grow-0 cursor-default flex-col justify-between gap-1 rounded-lg border border-sc-black-400 bg-sc-white px-2 pb-1 pt-2 drop-shadow-sc-shadow"
  >
    <LoadingSpinner class="z-10 rounded-xl backdrop-blur-md" v-if="loading" />
    <div class="ml-5 mr-1 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <h3 class="text-lg font-bold text-sc-orange">{{ team.name }}</h3>
        <UTooltip
          v-show="!isReady"
          :popper="{ strategy: 'absolute', arrow: true }"
          :ui="{
            base: 'h-full w-full',
            text: 'whitespace-normal',
            container: 'shadow-lg',
          }"
          class="border-gray-900"
          color="text-gray-900"
        >
          <template #text>
            <div class="w-48">
              <i18n-t
                keypath="team_manager.missing_roles"
                tag="p"
                scope="global"
                class="whitespace-normal break-words"
              >
                <template #roles
                  ><strong>{{
                    unsetRoles.join(` ${$t("team_manager.and")} `)
                  }}</strong></template
                >
              </i18n-t>
            </div>
          </template>
          <SvgWarning class="size-5 text-sc-yellow" />
        </UTooltip>
      </div>
      <UButton
        @click="deleteTeam"
        icon="mdi:trash-can-outline"
        class="size-6 justify-center hover:bg-sc-black-100"
        :padded="false"
        variant="ghost"
        color="sc-orange"
        :ui="{
          rounded: 'rounded-full',
          icon: { size: { sm: 'size-5' } },
        }"
        :disabled="preventInteraction"
        :class="{
          'z-20': loading,
        }"
      >
      </UButton>
    </div>
    <div class="mx-2 flex h-full overflow-y-auto">
      <table class="w-full font-semibold">
        <tbody>
          <tr
            v-for="member in teamMembers"
            :key="member.id"
            :ref="
              (el) => {
                member.refRow = el;
              }
            "
            class="flex justify-between border-b border-sc-black"
          >
            <td class="flex-grow p-2 text-xs font-bold">{{ member.name }}</td>
            <td class="flex items-center text-xs">
              <select
                class="mr-4 rounded-md bg-sc-white p-1"
                v-model="member.role"
                @change="updateRole(member.id, $event.target.value)"
                :disabled="preventInteraction"
              >
                <option
                  v-for="role in roles"
                  :key="role.label"
                  :value="role.label"
                >
                  {{ role.label }}
                </option>
              </select>
              <UButton
                @click="deleteMember(member.id)"
                icon="mdi:trash-can-outline"
                class="size-5 justify-center hover:bg-sc-black-100"
                :padded="false"
                variant="ghost"
                color="sc-orange"
                :ui="{
                  rounded: 'rounded-full',
                  icon: { size: { sm: 'size-2' } },
                }"
                :disabled="preventInteraction"
              >
              </UButton>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="!preventInteraction">
      <div class="relative mt-1" v-if="showInput">
        <input
          class="w-full cursor-pointer rounded-lg bg-sc-yellow/70 p-1 text-center text-xs font-bold drop-shadow-sc-shadow placeholder:text-sc-black focus:cursor-auto focus:outline-1 focus:placeholder:text-transparent"
          :placeholder="$t('join_room.add_team_member')"
          v-model="newMember"
          @keydown.enter="addMember"
          @focusout="!newMember ? (showInput = false) : ''"
          v-show="showInput || teamMembers.length === 0"
        />
        <button
          @click="addMember"
          class="absolute bottom-2 right-2 flex size-4 justify-center rounded bg-sc-orange text-xs hover:bg-sc-orange-700"
          :class="{
            'top-[50%] -translate-y-[50%]': showInput,
          }"
          :disabled="preventInteraction"
        >
          <UIcon name="ic:round-plus" class="size-4" />
        </button>
      </div>
      <button
        @click="showInput = true"
        v-else
        class="absolute bottom-2 right-4 flex size-4 justify-center rounded bg-sc-orange text-xs hover:bg-sc-orange-700"
        :disabled="preventInteraction"
      >
        <UIcon name="ic:round-plus" class="size-4" />
      </button>
    </div>

    <div
      v-if="preventInteraction"
      class="pointer-events-none absolute inset-0 size-full rounded-lg bg-sc-black-100 opacity-50"
    ></div>
  </div>
</template>
