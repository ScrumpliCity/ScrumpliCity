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
    current_phase: string;
    is_playing: boolean;
  };
  members: Array<Member>;
  sprints: Array<Sprint>;
};

type Member = {
  id?: string;
  name: string;
  role: string;
};

type UserStory = {
  id?: string;
  title: string;
  description: string;
  member_id?: string;
  completed: boolean;
  story_points?: number;
};

type Sprint = {
  id?: string;
  name: string;
  goal: string;
  sprint_number: number;
  velocity?: number;
  user_stories: Array<UserStory>;
};

export const useGameStore = defineStore("game", () => {
  const client = useSanctumClient();
  const echo = useEcho();
  const router = useRouter();
  const localeRoute = useLocaleRoute();

  const team: Ref<undefined | Team> = ref(undefined);
  const members: Ref<undefined | Member[]> = ref(undefined);

  const currentSprint = computed(() => {
    return team.value?.sprints.find(
      (v) => v.sprint_number === team.value!.room.current_sprint,
    );
  });

  const timerRemainingSeconds: Ref<undefined | number> = ref(undefined);
  const timerState: Ref<"running" | "stopped" | "paused"> = ref("stopped");
  const timerTotalSeconds: Ref<undefined | number> = ref(undefined);

  watch(
    // Timer:
    () => team.value?.room.id,
    (newValue, oldValue, onCleanup) => {
      if (!echo) return; // echo is undefined during SSR

      const oldChannel =
        oldValue == undefined ? undefined : `timer.${oldValue}`;
      const newChannel =
        newValue == undefined ? undefined : `timer.${newValue}`;

      if (newChannel) {
        echo
          .channel(newChannel)
          .listen("TimerUpdate", onTimerUpdate)
          .listen("TimerStateChange", onTimerStateChange)
          .error((e: object) => {
            console.error("Error listening to Timer: ", e);
          });
      }

      onCleanup(() => {
        if (oldChannel) echo.leaveChannel(oldChannel);
      });

      function onTimerUpdate({
        roomId,
        remainingSeconds,
      }: {
        roomId: string;
        remainingSeconds: number;
      }) {
        timerRemainingSeconds.value = remainingSeconds;
      }

      function onTimerStateChange({
        roomId,
        state,
        remainingSeconds,
        totalSeconds,
      }: {
        roomId: string;
        state: "running" | "stopped" | "paused";
        remainingSeconds: number;
        totalSeconds: number;
      }) {
        timerRemainingSeconds.value = remainingSeconds;
        timerTotalSeconds.value = totalSeconds;
        timerState.value = state;
        refresh();
      }
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

  async function createUserStory(): Promise<UserStory> {
    const story = await client(
      `/api/team/${team.value!.id}/sprints/${team.value!.room.current_sprint}/stories`,
      {
        method: "POST",
      },
    );

    return story as UserStory;
  }

  async function updateUserStory(userStory: UserStory): Promise<UserStory> {
    const story = await client(
      `/api/team/${team.value!.id}/sprints/${team.value!.room.current_sprint}/stories/${userStory.id}`,
      {
        method: "PATCH",
        body: {
          ...(userStory.title ? { title: userStory.title } : {}),
          ...(userStory.description
            ? { description: userStory.description }
            : {}),
          member_id: userStory.member_id,
          story_points: userStory.story_points,
        },
      },
    );

    return story as UserStory;
  }

  async function deleteUserStory(userStory: UserStory): Promise<void> {
    const response = await client(
      `/api/team/${team.value!.id}/sprints/${team.value!.room.current_sprint}/stories/${userStory.id}`,
      {
        method: "DELETE",
      },
    );
  }

  async function refresh(supressHandlingPhaseUpdate = false) {
    const data = await client(`/api/team/me`);
    team.value = data;
    if (!supressHandlingPhaseUpdate) _handlePhaseUpdate();
  }

  const correctRoute = computed(() => {
    if (!team.value) return undefined;

    const roomIsPaused = !team.value.room.is_playing;
    if (roomIsPaused) {
      return team.value.members.length > 0
        ? localeRoute("play-ready")
        : localeRoute("play-members");
    }

    const phases = {
      planning: "play-sprint-planning",
      build_phase: "play-sprint-build_phase",
      review: "play-sprint-review",
    };

    const currentPhase = team.value.room.current_phase;

    if (!(currentPhase in phases)) {
      console.error(`Current phase ${currentPhase} is not implemented yet.`);
      return undefined;
    }

    return localeRoute({
      name: phases[currentPhase as keyof typeof phases],
      params: { sprint: team.value.room.current_sprint },
    });
  });

  /** Check for a timer state change (pause/resume/phase change) & handle it accordingly */
  async function _handlePhaseUpdate() {
    if (!team.value) return; // no team yet so nothing to handle

    if (!correctRoute.value) return;
    if (
      correctRoute.value.name !== router.currentRoute.value.name ||
      correctRoute.value.params.sprint !==
        router.currentRoute.value.params.sprint
    )
      return navigateTo(correctRoute.value);

    if (
      // if sprint doesn't exist already
      !team.value.sprints.some(
        (v) => v.sprint_number === team.value!.room.current_sprint,
      )
    ) {
      // create sprint
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
    _handlePhaseUpdate,
    timerRemainingSeconds,
    timerState,
    timerTotalSeconds,
    correctRoute,
  };
});
