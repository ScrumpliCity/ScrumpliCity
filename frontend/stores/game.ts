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
    current_sprint: number;
  };
  sprints: Array<Sprint>;
};

type Member = {
  name: string;
  role: string;
};

type UserStory = {
  id: string | undefined;
  title: string;
  description: string;
  member_id: string | undefined;
  completed: boolean;
};

type Sprint = {
  id: string | undefined;
  name: string;
  goal: string;
  sprint_number: number;
  velocity: number | undefined;
  user_stories: Array<UserStory>;
};

export const useGameStore = defineStore("game", () => {
  const team: Ref<undefined | Team> = ref(undefined);
  const members: Ref<undefined | Member[]> = ref(undefined);

  const client = useSanctumClient();

  const echo = useEcho();

  const currentSprint = computed(() => {
    return team.value?.sprints.find(
      (v) => v.sprint_number === team.value!.room.current_sprint,
    );
  });

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

  async function setSprintGoal(sprintGoal: string): Promise<void> {
    if (!team.value) return;
    const sprint = await client(
      `/api/team/${team.value.id}/sprints/${team.value.room.current_sprint}`,
      {
        method: "PATCH",
        body: {
          goal: sprintGoal,
        },
      },
    );
    refresh();
  }
  async function setSprintName(sprintName: string): Promise<void> {
    if (!team.value) return;
    const sprint = await client(
      `/api/team/${team.value.id}/sprints/${team.value.room.current_sprint}`,
      {
        method: "PATCH",
        body: {
          name: sprintName,
        },
      },
    );
    refresh();
  }
  async function createUserStory(userStory: UserStory): Promise<void> {}
  async function updateUserStory(userStories: UserStory): Promise<void> {}
  async function deleteUserStory(userStories: UserStory): Promise<void> {}

  async function refresh() {
    const data = await client(`/api/team/me`);
    team.value = data;

    if (!team.value) return;

    // todo: get phase from room & navigate to the correct page
    // for now we assume the phase is sprint planning as this is the only phase

    if (
      !team.value.sprints.some(
        (v) => v.sprint_number === team.value!.room.current_sprint,
      )
    ) {
      // create sprint if it isn't created already
      await client(
        `/api/team/${team.value?.id}/sprints/${team.value.room.current_sprint}`,
        { method: "POST" },
      );
      refresh();
    }
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
    setSprintGoal,
    setSprintName,
    createUserStory,
    updateUserStory,
    deleteUserStory,
    currentSprint,
  };
});
