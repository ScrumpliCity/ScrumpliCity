<script lang="ts" setup>
const props = defineProps({
  /**
   * Whether the Infobox should automatically close after a certain duration.
   */
  withTimeout: {
    type: Boolean,
    default: true,
  },
  /**
   * Duration the infobox should close after in seconds. Useless if `withTimeout` is `false`.
   */
  durationInS: {
    type: Number,
    default: 10,
  },
  /**
   * Whether the Infobox should start out open.
   */
  startOpen: {
    type: Boolean,
    default: true,
  },
  /**
   * Texts the infobox should display. Arrows for switching are shown if an array with multiple entries is given. Slots are ignored if array is given.
   */
  text: {
    type: Array,
    required: false,
  },
});
const infoboxIsOpen = ref(props.startOpen);

const showText = computed(() => props.text && props.text.length >= 1);

const showPagination = computed(
  () => showText.value && props.text && props.text.length >= 2,
);

const currentText = ref(0);

const lastTextIndex = computed(() => (props.text?.length ?? 0) - 1);

const timeoutId: Ref<ReturnType<typeof setTimeout> | undefined> = ref();

function toggleInfobox() {
  infoboxIsOpen.value = !infoboxIsOpen.value;

  if (!props.withTimeout) return;

  if (infoboxIsOpen.value) {
    restartTimer();
  } else {
    clearTimer();
  }
}

onMounted(() => {
  if (props.withTimeout && infoboxIsOpen.value) {
    restartTimer();
  }
});

onUnmounted(() => {
  clearTimer();
});

function clearTimer() {
  if (timeoutId.value == undefined) return;
  clearTimeout(timeoutId.value);
}

function restartTimer() {
  if (!props.withTimeout || !infoboxIsOpen.value) return;
  clearTimer();
  timeoutId.value = setTimeout(() => {
    toggleInfobox();
  }, props.durationInS * 1000);
}
</script>

<template>
  <div>
    <transition name="infobox">
      <div
        v-if="infoboxIsOpen"
        class="fixed bottom-10 right-10 h-fit max-w-[23vw] rounded-xl border-sc-black-200 bg-sc-blue-background p-4 drop-shadow-sc-shadow"
        @mouseover="restartTimer"
      >
        <div class="flex items-center pr-10">
          <UIcon name="ic:outline-info" class="mr-2 bg-sc-blue" size="3vw" />
          <slot name="title" v-if="!showText">
            <h2 class="font-heading text-2xl font-medium text-sc-black-900">
              {{ $t("join_room.infobox.welcome.title") }}
            </h2>
          </slot>
          <h2
            class="font-heading text-2xl font-medium text-sc-black-900"
            v-else
          >
            {{ (text as any[])[currentText].title }}
          </h2>
        </div>
        <div class="absolute right-4 top-4">
          <button @click="toggleInfobox" class="bg-transparent">
            <UIcon class="size-6" name="heroicons:x-mark-solid" />
          </button>
        </div>
        <slot name="content" v-if="!showText">
          <p class="my-2 text-sc-black-500">
            {{ $t("join_room.infobox.welcome.content") }}
          </p>
        </slot>
        <p class="my-2 text-sc-black-500" v-else>
          {{ (text as any[])[currentText].content }}
        </p>
        <div
          class="flex items-center justify-end gap-1 text-sc-black-800"
          v-if="showPagination"
        >
          <button
            class="flex items-center justify-center disabled:text-transparent"
            @click="currentText--"
            :disabled="currentText <= 0"
          >
            <UIcon name="heroicons:chevron-left" />
          </button>
          <span class="text-sm">{{
            $t("infobox.current_of_total", {
              current: currentText + 1,
              total: lastTextIndex + 1,
            })
          }}</span>
          <button
            class="flex items-center justify-center disabled:text-transparent"
            @click="currentText++"
            :disabled="currentText >= lastTextIndex"
          >
            <UIcon name="heroicons:chevron-right" />
          </button>
        </div>
        <div class="flex justify-end" v-if="!showText">
          <slot name="button" :close="toggleInfobox" />
        </div>
      </div>
    </transition>
    <div v-if="!infoboxIsOpen">
      <UButton
        class="fixed bottom-5 right-5 rounded-full bg-sc-blue-background p-0 drop-shadow-sc-shadow transition-colors hover:bg-sc-blue"
        @click="toggleInfobox"
      >
        <UIcon
          name="material-symbols-light:info-i"
          class="bg-sc-black"
          size="4.5vw"
        />
      </UButton>
    </div>
  </div>
</template>
<style scoped>
.infobox-enter-active,
.infobox-leave-active {
  transition:
    transform 0.5s,
    opacity 0.5s;
}

.infobox-enter-from,
.infobox-leave-to {
  transform: scale(0);
  opacity: 0.5;
  transform-origin: bottom right;
}

.infobox-enter-to,
.infobox-leave-from {
  transform: scale(1);
  opacity: 1;
  transform-origin: bottom right;
}
</style>
