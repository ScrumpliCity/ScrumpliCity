<script setup xmlns="http://www.w3.org/1999/html">
import { ref } from "vue";
import Infobox from "~/components/Infobox.vue";

const { locale, setLocale } = useI18n();
const localeRoute = useLocaleRoute();
const { t } = useI18n();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}

//@TODO: get name from backend and store members
const roomCode = ref("TestCode");
const teamName = ref("Testteam");

const teamMembers = ref([
  {
    id: 0,
    name: "Felix",
    role: "Developer",
  },
  {
    id: 1,
    name: "Lisa-Marie Hörmann",
    role: "Developer",
  },
  {
    id: 2,
    name: "Sophie",
    role: "Developer",
  },
  {
    id: 3,
    name: "Marco",
    role: "Developer",
  },
]);

const roles = [
  {
    label: "Developer",
  },
  { label: "Scrum Master" },
  { label: "Product Owner" },
];

const newMember = ref("");

function deleteMember(memberId) {
  teamMembers.value = teamMembers.value.filter(
    (member) => member.id !== memberId,
  );
}

function addMember() {
  teamMembers.value.push({
    id: teamMembers.value.length,
    name: newMember.value,
    role: "Developer",
  });
  newMember.value = "";
  Infobox.addInfoBox(
    t("infobox.startup.title"),
    t("infobox.startup.description"),
    [
      {
        label: t("infobox.startup.button"),
        color: "blue",
      },
    ],
    "0",
  );
}

const isRoleTaken = (role) => {
  if (role !== "Developer") {
    return teamMembers.value.some((member) => member.role === role);
  }
};

function updateRole(memberId, newRole) {
  const member = teamMembers.value.find((member) => member.id === memberId);
  if (member) {
    member.role = newRole;
  }
}

function isReady() {
  const scrumMasters = teamMembers.value.filter(
    (member) => member.role === "Scrum Master",
  ).length;
  const productOwners = teamMembers.value.filter(
    (member) => member.role === "Product Owner",
  ).length;
  return scrumMasters === 1 && productOwners >= 1;
}
</script>
<template>
  <div
    class="flex h-screen w-full flex-col bg-[url('/assets/svg/join-room/add_team_members.svg')] bg-contain bg-bottom bg-no-repeat"
  >
    <div class="flex w-full place-content-end pr-11 pt-11">
      <UButton
        @click="switchLocale()"
        :padded="false"
        variant="ghost"
        class="hover:bg-transparent"
      >
        <template #leading>
          <LazySvgI18nDe
            v-if="locale === 'de'"
            :font-controlled="false"
            class="size-14"
            filled
          />
          <LazySvgI18nEn
            v-else
            :font-controlled="false"
            class="size-14"
            filled
          />
        </template>
      </UButton>
    </div>
    <div class="ml-[10%] mr-[40%]">
      <p class="ml-[3%] font-heading text-3xl font-medium">{{ roomCode }}</p>
      <h1
        class="mb-[5%] ml-[3%] font-heading text-6xl font-bold text-sc-orange"
      >
        {{ teamName }}
      </h1>
      <div
        class="mb-4 flex max-h-[43vh] flex-grow-0 flex-col justify-center rounded-lg border-2 border-sc-black-400 bg-sc-white p-7 drop-shadow-sc-48025"
      >
        <div class="flex overflow-y-scroll">
          <table class="w-full">
            <tbody>
              <tr
                v-for="member in teamMembers"
                :key="member.id"
                class="flex justify-between border-b-2 border-sc-black"
              >
                <td class="flex-grow p-2 text-3xl">{{ member.name }}</td>
                <td class="flex items-center">
                  <select
                    class="mr-4 rounded-md p-1"
                    v-model="member.role"
                    @change="updateRole(member.id, $event.target.value)"
                  >
                    <option
                      v-for="role in roles"
                      :key="role.label"
                      :value="role.label"
                      :disabled="isRoleTaken(role.label)"
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
        <!-- @submit.prevent is a workaround so the page isn't reloaded till the backend exists-->
        <form @submit.prevent>
          <input
            class="mt-7 w-full rounded-lg bg-sc-yellow/70 p-1 text-center text-3xl font-bold drop-shadow-sc-48025 placeholder:text-sc-black focus:placeholder:text-transparent"
            :placeholder="$t('join-room.add-team-member')"
            v-model="newMember"
          />
          <button @click="addMember()" />
        </form>
      </div>
      <div class="flex w-full justify-end">
        <button
          :disabled="!isReady()"
          class="w-72 rounded-lg py-6 text-center text-4xl font-bold drop-shadow-sc-48025"
          :class="
            isReady()
              ? 'bg-sc-green text-sc-black hover:bg-sc-green-400'
              : 'bg-sc-black-400 text-sc-white'
          "
        >
          {{ $t("join-room.add-members-ready") }}
        </button>
      </div>
    </div>
  </div>
</template>
