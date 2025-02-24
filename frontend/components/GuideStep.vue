<template>
  <!--breakpoint min-[1200px] is when image and text are side by side rather than below eachother -->
  <div
    class="flex flex-wrap items-center justify-center min-[1200px]:justify-between"
    :class="{
      'flex-row-reverse': isEven,
      'flex-row': !isEven,
    }"
  >
    <div
      class="ml-12 mr-12 flex h-auto w-[541px] flex-col"
      :class="{
        'min-[1200px]:ml-0': !isEven,
        'min-[1200px]:mr-0': isEven,
      }"
    >
      <img
        :src="'/png/step' + props.index + '.png'"
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
  </div>
</template>

<script setup lang="ts">
const { t } = useI18n();

const props = defineProps({
  index: {
    type: Number,
    required: true,
  },
});

//not reactive because index is not supposed to change
const isEven = props.index % 2 === 0;
</script>
