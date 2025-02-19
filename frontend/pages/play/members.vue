<script setup>
definePageMeta({
  layout: "play",
  middleware: "ensure-playing",
});

const toast = useToast();
const { t } = useI18n();
const localRoute = useLocaleRoute();

useSeoMeta({
  title: t("join_room.members.page_title"),
});

const game = useGameStore();

const newMember = ref("");
const focusOnInput = ref(false);
const teamMembers = ref([]);
const modalIsOpen = ref(false);
const loading = ref(false);

const roles = [
  { label: "Developer" },
  { label: "Scrum Master" },
  { label: "Product Owner" },
];

function deleteMember(memberId) {
  teamMembers.value = teamMembers.value.filter(
    (member) => member.id !== memberId,
  );
}

async function addMember() {
  if (newMember.value === "") {
    return;
  }
  teamMembers.value.push({
    id: teamMembers.value.length,
    name: newMember.value,
    role: "Developer",
    refRow: ref(),
  });
  newMember.value = "";

  // Scroll to the bottom of the list when a new member is added
  await nextTick();
  const lastEntry = teamMembers.value[teamMembers.value.length - 1];
  if (lastEntry) {
    lastEntry.refRow.scrollIntoView({ behavior: "smooth", block: "end" });
  }
}

function updateRole(memberId, newRole) {
  const member = teamMembers.value.find((member) => member.id === memberId);

  // Set role of original member with role to developer
  const originalMember =
    newRole !== "Developer"
      ? teamMembers.value.find(
          (member) => member.role === newRole && member.id !== memberId,
        )
      : null;
  if (originalMember) {
    toast.add({
      title: t("join_room.role_taken.title"),
      description: t("join_room.role_taken.description", {
        member: originalMember.name,
      }),
      icon: "mdi:alert-circle",
    });
    originalMember.role = "Developer";
  }

  // Set chosen role to member
  if (member) {
    member.role = newRole;
  }
}

const isReady = computed(() => {
  const scrumMasters = teamMembers.value.filter(
    (member) => member.role === "Scrum Master",
  ).length;
  const productOwners = teamMembers.value.filter(
    (member) => member.role === "Product Owner",
  ).length;
  return scrumMasters === 1 && productOwners === 1;
});

async function routeToReadyScreen() {
  try {
    loading.value = true;
    await game.addMembers(
      teamMembers.value.map((member) => ({
        name: member.name,
        role: member.role,
      })),
    );
    navigateTo(localRoute("play-ready"));
  } catch (error) {
    toast.add({
      title: t("join_room.add_members_error.title"),
      description: t("join_room.add_members_error.description"),
      icon: "mdi:alert-circle",
    });
  } finally {
    loading.value = false;
  }
}

const showWelcomeInfobox = ref(false);

function welcomeInfoboxShown() {
  showWelcomeInfobox.value = false;
  if (typeof localStorage !== "undefined") {
    localStorage.setItem("welcomeInfoboxShown", "true");
  }
}

onMounted(() => {
  if (typeof localStorage !== "undefined") {
    showWelcomeInfobox.value =
      localStorage?.getItem("welcomeInfoboxShown") === null;
  }
});
</script>

<template>
  <ClientOnly>
    <Infobox v-if="showWelcomeInfobox" :withTimeout="false">
      <template #button="{ close }">
        <UButton
          @click="
            close();
            welcomeInfoboxShown();
          "
          class="bg-sc-blue font-heading text-lg hover:bg-sc-blue-default-hover"
          >{{ $t("join_room.infobox.welcome.button") }}</UButton
        >
      </template>
    </Infobox>
    <Infobox v-else>
      <template #title>
        <h2 class="font-heading text-2xl font-medium text-sc-black-900">
          {{ $t("join_room.infobox.scrum_roles.title") }}
        </h2>
      </template>
      <template #content>
        <i18n-t
          keypath="join_room.infobox.scrum_roles.content"
          tag="p"
          class="my-2 text-sc-black-500"
          scope="global"
        >
          <template #roles>
            <ul class="ml-6 list-disc font-bold">
              <li>
                {{ $t("join_room.infobox.scrum_roles.roles.scrum_master") }}
              </li>
              <li>
                {{ $t("join_room.infobox.scrum_roles.roles.product_owner") }}
              </li>
              <li>
                {{ $t("join_room.infobox.scrum_roles.roles.development_team") }}
              </li>
            </ul>
          </template>
        </i18n-t>
      </template>
    </Infobox>
  </ClientOnly>
  <div class="flex w-full flex-col">
    <div class="-mt-10 ml-[10vw] mr-[40vw]">
      <p class="ml-[3%] font-heading text-3xl font-medium">
        {{ game.team.room.roomcode }}
      </p>
      <h1
        class="mb-[3%] ml-[3%] font-heading text-6xl font-bold text-sc-orange"
      >
        {{ game.team.name }}
      </h1>
      <div
        class="mb-4 flex h-[45vh] flex-grow-0 flex-col justify-between rounded-lg border-2 border-sc-black-400 bg-sc-white p-7 drop-shadow-sc-shadow"
      >
        <div class="mx-8 mt-4 flex h-full overflow-y-auto">
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
                <td class="flex-grow p-2 text-2xl">{{ member.name }}</td>
                <td class="flex items-center">
                  <select
                    class="mr-4 rounded-md bg-sc-white p-1"
                    v-model="member.role"
                    @change="updateRole(member.id, $event.target.value)"
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
                    class="size-10 justify-center hover:bg-sc-black-100"
                    :padded="false"
                    variant="ghost"
                    color="sc-orange"
                    :ui="{
                      rounded: 'rounded-full',
                      icon: { size: { sm: 'size-6' } },
                    }"
                  >
                  </UButton>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="relative mt-6">
          <input
            class="w-full cursor-pointer rounded-lg bg-sc-yellow/70 p-3 text-center text-2xl font-bold drop-shadow-sc-shadow placeholder:text-sc-black focus:cursor-auto focus:placeholder:text-transparent"
            :placeholder="$t('join_room.add_team_member')"
            v-model="newMember"
            @keydown.enter="addMember"
            @focus="focusOnInput = true"
            @focusout="focusOnInput = false"
          />
          <button
            @click="addMember"
            class="absolute right-3 top-[50%] flex size-8 translate-y-[-50%] justify-center rounded-lg bg-sc-orange text-3xl font-bold hover:bg-sc-orange/50"
            v-show="focusOnInput || newMember"
          >
            <UIcon name="ic:round-plus" class="size-8" />
          </button>
        </div>
      </div>
      <div class="flex w-full justify-end">
        <UPopover mode="hover" :disabled="isReady">
          <template #panel>
            <p class="w-80 p-3">
              {{ $t("join_room.product_owner_or_scrum_master_required") }}
            </p>
          </template>
          <button
            :disabled="!isReady"
            @click="modalIsOpen = true"
            class="w-72 rounded-lg bg-sc-green py-6 text-center text-4xl font-bold text-sc-black drop-shadow-sc-shadow hover:bg-sc-green-400 disabled:cursor-not-allowed disabled:bg-sc-black-400 disabled:text-sc-white"
          >
            {{ $t("join_room.add_members_ready") }}
          </button>
        </UPopover>
      </div>
    </div>
  </div>
  <UModal
    v-model="modalIsOpen"
    :ui="{
      rounded: 'rounded-xl',
      border: 'border',
      shadow: 'drop-shadow-md',
    }"
  >
    <LoadingSpinner class="z-10 rounded-xl backdrop-blur-md" v-if="loading" />
    <div class="p-6">
      <h2 class="mb-4 text-2xl font-bold">
        {{ $t("join_room.confirmation_modal.are_you_sure") }}
      </h2>
      <p class="mb-6">{{ $t("join_room.confirmation_modal.description") }}</p>
      <div class="flex justify-end">
        <button
          @click="modalIsOpen = false"
          class="mr-4 rounded-lg bg-sc-black-400 px-6 py-2 text-sc-white hover:bg-sc-black-500"
        >
          {{ $t("join_room.confirmation_modal.cancel") }}
        </button>
        <button
          @click="routeToReadyScreen"
          class="rounded-lg bg-sc-green px-6 py-2 font-bold text-sc-black hover:bg-sc-green-400"
        >
          {{ $t("join_room.confirmation_modal.yes") }}
        </button>
      </div>
    </div>
  </UModal>
</template>
