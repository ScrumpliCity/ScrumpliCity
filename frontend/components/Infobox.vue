<script>
const title = "";
const description = "";
const actions = [];
const timeout = 0;

function addInfoBox(title, description, actions, timeout) {
  this.title = title;
  this.description = description;
  this.actions = actions;
  this.timeout = timeout;
  useToast();
  console.log("InfoBox added"); //wird ausgeführt, aber die Infobox wird noch nicht angezeigt
}

export default {
  addInfoBox,
};
</script>

<template>
  <UNotification
    icon="ic:outline-info"
    color="blue"
    actions="{{ actions }}"
    title="{{ title }}"
    description="{{ description }}"
    timeout="{{ timeout }}"
  />
</template>

<style scoped></style>
