<template>
  <ClientOnly>
    <div
      :class="[
        'flex flex-row flex-wrap items-center justify-center min-[1200px]:justify-between',
        { 'flex-wrap-reverse': isEven },
      ]"
    >
      <div
        v-if="!isEven"
        class="ml-12 mr-12 flex h-auto w-[541px] flex-col min-[1200px]:ml-0"
      >
        <img
          :src="imageUrl"
          :alt="t('scrumplicity_guide.step_by_step.alt' + index)"
          class="mb-2 drop-shadow-sc-shadow"
        />
        <p
          class="text-left text-base font-medium text-sc-black-600 min-[1200px]:text-justify"
        >
          {{ t("scrumplicity_guide.step_by_step.caption" + index) }}
        </p>
      </div>
      <p
        class="flex-1 text-base font-medium max-lg:pr-5 sm:min-w-[330px] md:text-lg lg:mb-6"
      >
        <span
          class="font-heading text-3xl font-bold text-sc-orange md:text-4xl lg:text-5xl"
        >
          {{ index }}.
        </span>
        {{ t("scrumplicity_guide.step_by_step.description" + index) }}
      </p>
      <div
        v-if="isEven"
        class="ml-12 mr-12 flex h-auto w-[541px] flex-col min-[1200px]:mr-0"
      >
        <img
          :src="imageUrl"
          :alt="t('scrumplicity_guide.step_by_step.alt' + index)"
          class="mb-2 drop-shadow-sc-shadow"
        />
        <p
          class="text-left text-base font-medium text-sc-black-600 min-[1200px]:text-justify"
        >
          {{ t("scrumplicity_guide.step_by_step.caption" + index) }}
        </p>
      </div>
    </div></ClientOnly
  >
</template>

<script setup lang="ts">
import { defineProps } from "vue";

const { t } = useI18n();

const props = defineProps({
  index: {
    type: Number,
    required: true,
  },
});

const isEven = props.index % 2 === 0;
import { computed } from "vue";

const imageUrl = computed(
  () => new URL(`../assets/png/step${props.index}.png`, import.meta.url).href,
);
</script>
