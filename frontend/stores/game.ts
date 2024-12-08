type Team = {
  id: string;
  created_at: string;
  updated_at: string;
  name: string | null;
  room: {
    id: string;
    roomcode: string;
    number_of_sprints: number;
    sprint_duration: number;
    planning_duration: number;
    review_duration: number;
  };
};

type Member = {
  name: string;
  role: string;
};

export const useGameStore = defineStore("game", () => {
  const team: Ref<undefined | Team> = ref(undefined);
  const members: Ref<undefined | Member[]> = ref(undefined);

  const client = useSanctumClient();

  async function joinRoom(code: string) {
    const data: Team = await client(`/api/team/join`, {
      body: {
        code,
      },
      method: "POST",
    });

    team.value = data;
    return data;
  }

  async function refresh() {
    const data = await client(`/api/team/me`);
    team.value = data;
  }

  async function changeName(newName: string) {
    const data = await client(`/api/team/${team.value?.id}`, {
      body: {
        name: newName,
      },
      method: "POST",
    });
    team.value = data;
  }

  async function addMembers(new_members: Member[]) {
    const data = await client(`/api/team/${team.value?.id}/members`, {
      body: {
        new_members,
      },
      method: "POST",
    });
    team.value = data;
  }

  async function getMembers() {
    const data = await client(`/api/team/me/members`);
    members.value = data;
    return data;
  }

  const isInTeam = computed(() => !!team.value);
  return {
    team,
    joinRoom,
    isInTeam,
    refresh,
    changeName,
    addMembers,
    getMembers,
  };
});
