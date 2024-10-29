<script setup xmlns="http://www.w3.org/1999/html">
const {locale, setLocale} = useI18n();
const localeRoute = useLocaleRoute();

function switchLocale() {
  setLocale(locale.value === "de" ? "en" : "de");
}

//@TODO: get name from backend and store members
const roomCode = ref('TestCode');
const teamName = ref('Testteam');

const teamMembers = ref([{
  id: 0,
  name: 'Felix',
  role: 'Developer',
},
  {
    id: 1,
    name: 'Lisa-Marie Hörmann',
    role: 'Developer',
  },
  {
    id: 2,
    name: 'Sophie',
    role: 'Developer',
  },
  {
    id: 3,
    name: 'Marco',
    role: 'Developer',
  }
]);

const roles = [
  {
    label: 'Developer',
  },
  {label: 'Scrum Master'},
  {label: 'Product Owner'},
]

const newMember = ref('');

function deleteMember(memberId) {
  teamMembers.value = teamMembers.value.filter(member => member.id !== memberId);
}

function addMember() {
  teamMembers.value.push({
    id: teamMembers.value.length,
    name: newMember.value,
    role: 'Developer',
  });
  newMember.value = '';
}

const isRoleTaken = (role) => {
  if (role !== 'Developer') {
    return teamMembers.value.some(member => member.role === role);
  }
};

function updateRole(memberId, newRole) {
  const member = teamMembers.value.find(member => member.id === memberId);
  if (member) {
    member.role = newRole;
  }
}

function isReady() {
  const scrumMasters = teamMembers.value.filter(member => member.role === 'Scrum Master').length;
  const productOwners = teamMembers.value.filter(member => member.role === 'Product Owner').length;
  return scrumMasters === 1 && productOwners >= 1;
}

</script>
<template>
  <div
      class="flex flex-col w-full h-screen bg-[url('/assets/svg/join-room/add_team_members.svg')] bg-contain bg-no-repeat bg-bottom">
    <div class="flex w-full place-content-end pt-11 pr-11">
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
      <p class="text-3xl font-heading font-medium ml-[3%]"> {{ roomCode }}</p>
      <h1 class="font-heading text-6xl font-bold text-sc-orange mb-[5%] ml-[3%]">
        {{ teamName }} </h1>
      <div
          class="flex flex-col flex-grow-0 max-h-[43vh] justify-center border-2 border-sc-black-400 rounded-lg p-7 mb-4 bg-sc-white drop-shadow-sc-48025">
        <div class="flex overflow-y-scroll">
          <table class="w-full">
            <tbody>
            <tr v-for="member in teamMembers" :key="member.id" class="border-b-2 border-sc-black flex justify-between">
              <td class="text-3xl p-2 flex-grow">{{ member.name }}</td>
              <td class="flex items-center">
                <select
                    class="rounded-md p-1 mr-4"
                    v-model="member.role"
                    @change="updateRole(member.id, $event.target.value)">
                  <option v-for="role in roles" :key="role.label" :value="role.label"
                          :disabled="isRoleTaken(role.label)">
                    {{ role.label }}
                  </option>
                </select>
                <button @click="deleteMember(member.id)">
                  <UIcon name="mdi:trash-can-outline" class="text-sc-orange p-4"/>
                </button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- @submit.prevent is a workaround so the page isn't reloaded till the backend exists-->
        <form @submit.prevent>
          <input
              class="w-full rounded-lg bg-sc-yellow/70 drop-shadow-sc-48025 text-3xl font-bold p-1 mt-7 text-center placeholder:text-sc-black focus:placeholder:text-transparent"
              :placeholder="$t('join-room.add-team-member')"
              v-model="newMember"
          />
          <button @click="addMember()"/>
        </form>
      </div>
      <div class="w-full flex justify-end">
        <button
            :disabled="!isReady()"
            class="w-72 rounded-lg py-6 text-center text-4xl font-bold drop-shadow-sc-48025"
            :class="isReady() ? 'bg-sc-green text-sc-black hover:bg-sc-green-400' : 'text-sc-white bg-sc-black-400'"
        >
          {{ $t("join-room.add-members-ready") }}
        </button>
      </div>
    </div>
  </div>
</template>
