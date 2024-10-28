<script setup>
const props = defineProps({
  choices: {
    type: Array,
    required: true,
  },
  max: {
    type: Number,
    default: 99,
  },
});

const emit = defineEmits(["update:chosenNum"]);
const toast = useToast();

let customValue = ref("");
let isEditing = ref(false);

let chosenNum = ref(0);

function addCustomValue() {
  // Throw an error toast if the custom value is higher than the max value
  if (customValue.value > props.max) {
    customValue.value = props.max;
    chosenNum.value = props.max;
    isEditing.value = false;
    toast.add({
      title: useNuxtApp().$i18n.t("max_value_reached"),
      variant: "error",
    });
    return;
  }

  if (customValue.value !== "") {
    customValue.value = Math.abs(Math.round(Number(customValue.value)));
    chosenNum.value = Number(customValue.value);

    // Switch to the field that equals the custom value and close the input field
    if (props.choices.includes(chosenNum.value) || chosenNum.value === 0) {
      customValue.value = "";
    }
    isEditing.value = false;
    return;
  }
}

// Emit the chosen number to the parent component
watch(chosenNum, (newVal) => {
  emit("update:chosenNum", newVal);
});

// If another field is chosen while editing the custom value, close the input field
watch(chosenNum, () => {
  if (props.choices.includes(chosenNum.value)) {
    isEditing.value = false;
  }
});

let edit = () => {
  if (customValue.value !== chosenNum.value) {
    chosenNum.value = 0;
  }
  customValue.value = "";
  isEditing.value = true;
  nextTick(() => {
    // If edit field is not open (isEditing) it can't be focused on and raises an error
    if (isEditing.value) document.getElementById("customAdd").focus();
  });
};

let chooseVal = (num) => {
  chosenNum.value = num;
  customValue.value = "";
};
</script>

<template>
  <div
    class="flex overflow-hidden rounded-lg border border-sc-black-400 bg-sc-white text-2xl font-semibold text-sc-black-400 drop-shadow-md"
  >
    <button
      v-for="count in choices"
      @click="chooseVal(count)"
      :key="count"
      class="h-10 w-10 border-r border-sc-black-400"
      :class="{
        'bg-sc-orange bg-opacity-50 text-sc-black': chosenNum === count,
      }"
    >
      {{ count }}
    </button>

    <!-- Position really off-->
    <!-- <UTooltip :text="useNuxtApp().$i18n.t('edit_number')" :popper="{ placement: 'top', offsetDistance: 0 }">-->
    <div
      v-if="isEditing"
      class="justify-centerborder-sc-black-400 flex h-10 w-10 flex-col"
    >
      <input
        id="customAdd"
        type="number"
        :max="max"
        v-model="customValue"
        @focusout="addCustomValue"
        @keydown.enter="addCustomValue"
        class="placeholder-style h-full w-full bg-sc-orange bg-opacity-50 text-center text-sc-black caret-transparent placeholder:text-sc-black focus:outline-none"
        placeholder="_"
      />
    </div>
    <button
      v-else
      class="flex h-10 w-10 flex-col justify-center"
      :class="{
        'bg-sc-orange bg-opacity-50 text-sc-black': chosenNum === customValue,
      }"
      @click="edit"
    >
      <p v-if="customValue" class="mx-auto w-fit">{{ customValue }}</p>
      <UIcon
        name="material-symbols:edit-outline-rounded"
        class="mx-auto"
        v-else
      />
    </button>
    <!--</UTooltip>-->
  </div>
  <UNotifications />
</template>

<style scoped>
.placeholder-style::placeholder {
  /* moves the placeholder a bit lower for better positioning*/
  padding: 5px 11px;
}
</style>
