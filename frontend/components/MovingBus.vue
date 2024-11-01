<template>
  <div class="absolute inset-0 -z-10 flex items-end">
    <SvgJoinRoomBgTreesHouses class="w-screen" :fontControlled="false" filled />
    <SvgJoinRoomBgBus
      id="bus"
      class="absolute bottom-[6.7%] w-[282px]"
      :fontControlled="false"
      filled
    />
  </div>
</template>
<script setup>
const props = defineProps({
  busStartingPosition: Number,
  busEndingPosition: Number,
  busSpeed: {
    type: Number,
    default: 2,
  },
});

let id = null;

function moveBus() {
  const elem = document.getElementById("bus");
  let pos = props.busStartingPosition;
  clearInterval(id);
  id = setInterval(frame, 10);

  function frame() {
    if (pos >= props.busEndingPosition) {
      clearInterval(id);
    } else {
      pos += props.busSpeed;
      elem.style.left = pos + "px";
    }
  }
}

onMounted(() => {
  moveBus();
});
</script>
