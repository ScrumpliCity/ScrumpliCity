<script lang="ts" setup>
definePageMeta({
  layout: "generate-roomcode",
});

const client = useSanctumClient();
const route = useRoute();

const { data: roomcodeData } = await useAsyncData("roomcode", () =>
  client(`/api/rooms/${route.params.id}/roomcode`, {
    method: "POST",
  }),
);

const roomcode = computed(() => roomcodeData.value.roomcode || "");
</script>
<template>
  <div class="flex h-full flex-col items-center text-center">
    <h1 class="z-10 m-[1vw] font-heading text-6xl font-bold text-sc-orange">
      {{ $t("generate_room_code.title") }}
    </h1>
    <i18n-t
      keypath="generate_room_code.description"
      tag="p"
      class="z-10 text-5xl font-medium"
      scope="global"
    >
      <template #url>
        <b
          ><u>{{ $t("generate_room_code.url") }}</u></b
        >
      </template>
    </i18n-t>
    <div class="relative flex h-[25vw] w-full items-center justify-center">
      <SvgCraneHook class="h-full w-auto" :fontControlled="false" filled />
      <p class="absolute text-7xl font-bold">{{ roomcode }}</p>
    </div>
  </div>
</template>
