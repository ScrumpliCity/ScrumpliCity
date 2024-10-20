<script setup>
// const { locale } = useI18n();
const localeRoute = useLocaleRoute();

// Values to be used in the room creation form
let sprintCount = ref(0);
let sprintDuration = ref(0);
let roomName = ref("");

let isOpen = ref(true);

const createRoomFunction = () => {
    if (sprintCount.value > 0 && sprintDuration.value > 0) {
        console.log("Room created with " + sprintCount.value + " sprints of " + sprintDuration.value + " weeks each.");
    }
}
</script>

<template>
    <div class="flex items-center absolute justify-center h-screen w-screen bg-transparent">
        <div class="flex flex-col justify-center w-3/5 h-2/3 border rounded-2xl m-6 bg-sc-white drop-shadow-md">
            <div class="grid grid-cols-2 grid-flow-col-dense h-full">
                <div class="flex flex-col h-full gap-10 col-span-2 w-3/5 mt-12 ml-14">
                    <h1 class=" text-sc-orange  font-heading text-5xl text-center">
                        {{ $t("create_room_heading") }}</h1>
                    <div class="flex flex-col gap-10 items-center [&>*>label]:font-medium">
                        <div class="flex flex-col items-center gap-4">
                            <label for="room-name" class="text-2xl">{{ $t("roomname") }}</label>
                            <!-- TODO: check for uniqueness and profanity -->
                            <input type="text" id="room-name" v-model="roomName"
                                class="border rounded-lg drop-shadow-md p-2 w-80 text-center text-2xl" />
                        </div>

                        <div class="flex flex-col items-center gap-4">
                            <label for="sprints" class="block text-2xl">{{ $t("sprint_count") }}</label>
                            <div
                                class="flex  [&>*]:text-sc-black-400 first:rounded-l-md text-2xl [&>*]:border-sc-black-400 [&>*]:border [&>*]:border-collapse">
                                <Chooser :choices="[2, 3, 4, 5, 6]" @update:chosen-num="(n) => sprintCount = n" />
                            </div>
                        </div>
                        <div class="flex flex-col items-center gap-4">
                            <label for="sprints" class="block text-2xl">{{ $t("sprint_duration") }}</label>
                            <div
                                class="flex  [&>*]:text-sc-black-400 first:rounded-l-md text-2xl [&>*]:border-sc-black-400 [&>*]:border [&>*]:border-collapse">
                                <Chooser :choices="[2, 3, 5, 8, 10]" @update:chosen-num="(n) => sprintDuration = n" />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <UButton @click="isOpen = false; navigateTo(localeRoute('rooms', locale))"
                        class="text-2xl bg-transparent">
                        <SvgClose class="absolute right-7 top-7 w-72" />
                    </UButton>
                    <SvgBackgroundHouses25opacity class="absolute right-[60px] bottom-0 w-[349px] "
                        :fontControlled="false" />
                    <UButton @click="createRoomFunction"
                        class="absolute right-[145px] bottom-6 w-[179px] text-2xl h-[77px] bg-sc-black-400 text-white rounded-lg justify-center hover:bg-sc-black-400" 
                        :label="useNuxtApp().$i18n.t('create')" :class="{
                            'bg-sc-green text-sc-black hover:bg-sc-green-400': sprintCount > 0 && sprintDuration > 0,
                        }" />
                </div>

            </div>
        </div>
    </div>
</template>
