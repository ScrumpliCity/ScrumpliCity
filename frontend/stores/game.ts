type Team = {
  id: string;
  created_at: string;
  updated_at: string;
  name: string | null;
  room_id: string;
  roomcode: string;
};

type RoomDetails = {
  number_of_sprints: number;
  sprint_duration: number;
  planning_duration: number;
  review_duration: number;
  roomcode: string;
};

export const useGameStore = defineStore("game", () => {
  const team: Ref<undefined | Team> = ref(undefined);
  const members: Ref<undefined | Object[]> = ref(undefined);
  const roomDetails: Ref<undefined | Object> = ref(undefined);

  const client = useSanctumClient();

  async function joinRoom(code: string) {
    const data: Team = await client(`/api/team/join`, {
      body: {
        code,
      },
      method: "POST",
    });
    const roomDetailsData: RoomDetails = await client(
      `/api/rooms/${data.room_id}/details`,
    );

    team.value = data;
    roomDetails.value = roomDetailsData;
    return data;
  }

  async function refresh() {
    const data = await client(`/api/team/me`);
    const roomDetailsData: RoomDetails = await client(
      `/api/rooms/${data.room_id}/details`,
    );

    team.value = data;
    roomDetails.value = roomDetailsData;
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

  async function addMembers(newMembers: Object[]) {
    const data = await client(`/api/team/${team.value?.id}/members`, {
      body: {
        newMembers,
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
    roomDetails,
    joinRoom,
    isInTeam,
    refresh,
    changeName,
    addMembers,
    getMembers,
  };
});
