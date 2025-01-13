<template>
  <a
    href="/ScrumpliCity-crafting-templates.zip"
    download="ScrumpliCity-crafting-templates.zip"
  >
    <UButton
      class="hover:bg-sc-black-100"
      variant="ghost"
      color="black"
      :padded="true"
      :ui="{
        padding: { sm: 'p-[0.15em]' },
        rounded: 'rounded-full',
      }"
    >
      <SvgDownload :font-controlled="false" class="h-10" />
    </UButton>
  </a>
</template>
