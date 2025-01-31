<template>
  <a
    href="/ScrumpliCity_crafting-templates.zip"
    download="ScrumpliCity_crafting-templates.zip"
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
