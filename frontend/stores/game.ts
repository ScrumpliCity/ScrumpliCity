type Team = {
  id: string;
  created_at: string;
  updated_at: string;
  name: string | null;
  room_id: string;
};

export const useGameStore = defineStore("game", () => {
  const team: Ref<undefined | Team> = ref(undefined);
  const joinCode: Ref<undefined | string> = ref(undefined);

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

  const isInTeam = computed(() => !!team.value);
  return { team, joinCode, joinRoom, isInTeam, refresh, changeName };
});
