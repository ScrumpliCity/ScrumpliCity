type Team = {
  id: string;
  created_at: string;
  updated_at: string;
  name: string | null;
  active: boolean;
  room: {
    id: string;
    roomcode: string;
    number_of_sprints: number;
    sprint_duration: number;
    planning_duration: number;
    review_duration: number;
    last_play_start: Date | null;
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

  const echo = useEcho();

  watch(
    () => team.value?.id,
    (newValue, oldValue, onCleanup) => {
      if (!echo) return; // echo is undefined during SSR

      const oldChannel = oldValue == undefined ? undefined : `team.${oldValue}`;
      const newChannel = newValue == undefined ? undefined : `team.${newValue}`;

      console.log(echo);

      if (newChannel) {
        console.log("subscribing to " + newChannel);
        echo
          .channel(newChannel)
          .listen(".TeamUpdated", (e: object) => console.log(e))
          .error((e: object) => {
            console.error("Public channel error", e);
          });
      }

      onCleanup(() => {
        if (oldChannel) echo.leaveChannel(oldChannel);
      });
    },
  );

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

  //stopped here bc of confusion if I have to use this to get all teams of room or if I can make a direct api call
  async function getExistingTeams() {
    const data: Team = await client(`/api/rooms/${team.value?.room.id}/teams`, {
      method: "GET",
    });
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
    getExistingTeams,
    isInTeam,
    refresh,
    changeName,
    addMembers,
    getMembers,
  };
});
