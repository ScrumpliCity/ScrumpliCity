<script lang="ts" setup>
const props = defineProps({
  remainingSeconds: {
    type: Number,
    required: true,
  },
  totalSeconds: {
    type: Number,
    required: true,
  },
  isControllable: {
    type: Boolean,
    default: false,
  },
  isPaused: {
    type: Boolean,
    default: false,
  },
  disableAction: {
    type: Boolean,
    default: false,
  },
  isDisabled: {
    type: Boolean,
    default: false,
  },
});

const remainingSeconds = ref(props.remainingSeconds);

let interval: ReturnType<typeof decrementTime>;

watch(
  () => props.remainingSeconds,
  (newValue) => {
    remainingSeconds.value = newValue;
    clearInterval(interval);
    interval = decrementTime();
  },
);

onMounted(() => {
  if (props.isPaused || props.isDisabled) {
    return;
  }
  interval = decrementTime();
  onBeforeUnmount(() => clearInterval(interval));
});

function decrementTime() {
  return setInterval(() => {
    if (remainingSeconds.value <= 0 || props.isDisabled || props.isPaused) {
      clearInterval(interval);
      return;
    }
    remainingSeconds.value = Math.max(remainingSeconds.value - 1, 0);
  }, 1000);
}

const emit = defineEmits(["toggle"]);

const pathLength = 890; // see path element

const text = computed(() => {
  if (props.isDisabled) {
    return "-- : --";
  }
  const ourSeconds = Math.max(remainingSeconds.value, 0);
  const minutes = Math.floor(ourSeconds / 60);
  const seconds = ourSeconds % 60;
  return `${`${minutes}`.padStart(2, "0")}:${`${seconds}`.padStart(2, "0")}`;
});

const offset = computed(() => {
  const ourSeconds = Math.max(remainingSeconds.value, 0);
  const fraction = ourSeconds / props.totalSeconds;
  return `-${pathLength - fraction * pathLength}`;
});
</script>
<template>
  <div>
    <div class="relative">
      <svg
        width="301"
        height="290"
        viewBox="0 0 301 290"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <!-- triangle at the top -->
        <path
          d="M149.232 88.5675C150.251 87.8745 151.589 87.8745 152.608 88.5675L207.344 125.812C209.785 127.474 208.609 131.293 205.656 131.293H96.1841C93.2306 131.293 92.0545 127.474 94.4964 125.812L149.232 88.5675Z"
          stroke="#888888"
          stroke-width="4"
        />
        <!-- mask for rounding the edges -->
        <mask id="rounded-edges" fill="white">
          <rect y="126" width="301" height="164" rx="7" />
        </mask>

        <!-- the two paths for the timer itself -->
        <!-- 890 is the lenght of the path exactly -->
        <path
          d="M 150 131 h 146 v 154 h -291 v -154 z"
          class="stroke-sc-black-400"
          stroke-width="10"
          stroke-linecap="round"
          stroke-dasharray="890"
          stroke-linejoin="round"
          mask="url(#rounded-edges)"
          stroke-dashoffset="0"
        />
        <path
          d="M 150 131 h 146 v 154 h -291 v -154 z"
          class="stroke-sc-orange transition-[stroke-dashoffset] duration-1000 ease-linear"
          stroke-width="10"
          stroke-linecap="round"
          stroke-dasharray="890"
          stroke-linejoin="round"
          mask="url(#rounded-edges)"
          :stroke-dashoffset="offset"
        />

        <text
          x="50%"
          text-anchor="middle"
          y="240px"
          class="fill-sc-orange font-sans text-[5.625rem] font-extrabold tabular-nums tracking-tighter"
        >
          {{ text }}
        </text>
        <!-- the hook -->
        <path
          d="M149.24 96.3309L149.24 96.3307C146.613 95.8971 142.209 94.8032 138.411 92.0531C134.591 89.2869 131.403 84.8546 131.243 77.8202L131.243 77.82C131.112 71.8753 132.394 67.9272 134.407 65.0057C136.391 62.1255 139.059 60.2882 141.608 58.532L141.669 58.4903C141.67 58.4896 141.671 58.489 141.672 58.4883C141.984 58.2671 142.302 58.0461 142.618 57.8268L142.619 57.826C142.936 57.6057 143.251 57.387 143.56 57.1686C146.003 55.4037 147.248 52.0796 147.869 49.0727C148.472 46.1478 148.459 43.6535 148.458 43.5204L148.458 43.5154V2.99996C148.458 2.15347 149.122 1.48828 149.969 1.48828C150.816 1.48828 151.48 2.15336 151.48 2.99996V43.4895C151.48 43.4974 151.48 43.5085 151.48 43.5228C151.482 43.9178 151.494 46.713 150.785 49.977C150.055 53.3394 148.535 57.3126 145.335 59.6152C144.682 60.086 144.029 60.5301 143.383 60.9699L143.382 60.9705C140.802 62.7432 138.492 64.3346 136.833 66.7706C135.185 69.1885 134.15 72.4892 134.265 77.7198C134.404 83.6527 137.111 87.3463 140.35 89.6657C143.611 92.0009 147.426 92.9499 149.737 93.3204C152.223 93.714 157.539 93.02 161.721 89.3402L161.721 89.34C165.627 85.9074 167.562 80.8528 167.333 74.2985L167.332 74.2897V74.281C167.332 73.4686 167.938 72.7434 168.818 72.7434H168.844C169.669 72.7434 170.316 73.4079 170.354 74.2053L170.355 74.2134C170.645 83.4807 166.916 88.8083 163.703 91.6218C159.801 95.0478 154.872 96.4605 151.188 96.4671L149.24 96.3309ZM149.24 96.3309L149.253 96.3328M149.24 96.3309L149.253 96.3328M149.253 96.3328C149.835 96.4122 150.472 96.4658 151.162 96.4671L149.253 96.3328Z"
          fill="#888888"
          stroke="#888888"
        />
      </svg>
      <!-- Tutor view: button for pausing & resume -->
      <UTooltip
        v-if="isControllable && !isDisabled"
        class="absolute bottom-3 right-3 z-20"
        :text="isPaused ? $t('timer.resume_timer') : $t('timer.pause_timer')"
        :prevent="disableAction"
      >
        <UButton
          variant="ghost"
          class="text-sc-black-500 disabled:opacity-100"
          :padded="false"
          @click="emit('toggle')"
          :class="{
            'animate-spin': disableAction,
          }"
          :icon="
            disableAction
              ? 'i-heroicons-arrow-path-16-solid'
              : isPaused
                ? 'material-symbols:play-arrow-outline-rounded'
                : 'humbleicons:pause'
          "
          :disabled="disableAction"
        ></UButton>
      </UTooltip>
      <!-- Student view: if the timer is paused, display a small icon with an explanatory tooltip -->
      <UTooltip
        class="absolute bottom-3 right-3"
        :text="$t('timer.paused_by_tutor')"
        v-if="isPaused && !isControllable"
      >
        <UIcon name="humbleicons:pause" class="text-sc-black-500"> </UIcon>
      </UTooltip>
    </div>
  </div>
</template>
