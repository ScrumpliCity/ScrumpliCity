type Team = {
  id: string;
  created_at: string;
  updated_at: string;
  name: string | null;
  room_id: string;
  roomcode: string;
};

export const useGameStore = defineStore("game", () => {
  const team: Ref<undefined | Team> = ref(undefined);
  const joinCode: Ref<undefined | string> = ref(undefined);
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
    team.value = data;
    joinCode.value = code;
    roomDetails.value = await client(`/api/rooms/${data.room_id}/details`);
    return data;
  }

  async function refresh() {
    const data = await client(`/api/team/me`);
    const roomcodeData = await client(`/api/rooms/${data.room_id}/roomcode`);
    const roomDetailsData = await client(`/api/rooms/${data.room_id}/details`);

    team.value = data;
    joinCode.value = roomcodeData.roomcode;
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
    const data = await client(`/api/team/members`);
    members.value = data;
    return data;
  }

  async function showRoomDetails() {
    const data = await client(`/api/rooms/${team.value?.room_id}/details`);
    roomDetails.value = data;
    return data;
  }

  const isInTeam = computed(() => !!team.value);
  return {
    team,
    joinCode,
    joinRoom,
    isInTeam,
    refresh,
    changeName,
    addMembers,
    getMembers,
    showRoomDetails,
  };
});
