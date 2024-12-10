<script setup></script>
<template>
  <div class="absolute top-10 w-full bg-sc-white px-4 lg:top-16 lg:px-[61px]">
    <SvgLegalNoticeBackground
      class="hidden h-full w-full sm:block"
      :fontControlled="false"
      filled
    />
  </div>
  <div class="relative h-full">
    <HomeHeader />
    <div class="flex min-h-full flex-col justify-around gap-[25rem]">
      <div
        class="mt-24 flex w-1/2 flex-col gap-2 self-center font-sans [&>div>h2]:font-heading [&>div>h2]:text-xl"
      >
        <h1
          class="my-4 self-center font-heading text-5xl font-medium text-sc-orange"
        >
          {{ $t("legal_notice.title") }}
        </h1>
        <div>
          <h2>{{ $t("legal_notice.media_proprietor") }}:</h2>
          <p>Felix Wollmann</p>
        </div>
        <div>
          <h2>{{ $t("legal_notice.business_purpose.title") }}:</h2>
          <p>{{ $t("legal_notice.business_purpose.content") }}</p>
        </div>
        <div>
          <h2>{{ $t("legal_notice.address.title") }}:</h2>
          <address>
            HTBLA Wien 3 Rennweg<br />
            Rennweg 89b<br />
            1030 {{ $t("legal_notice.address.vienna") }}
          </address>
        </div>
        <div>
          <h2>{{ $t("legal_notice.contact") }}:</h2>
          <p>
            <a
              href="mailto:felix.wollmann@scrumplicity.app"
              class="hover:underline"
              >felix.wollmann@scrumplicity.app</a
            >
          </p>
        </div>
        <div>
          <h2>{{ $t("legal_notice.editorial_policy.title") }}:</h2>
          <p>{{ $t("legal_notice.editorial_policy.content") }}</p>
        </div>
        <div>
          <h2>{{ $t("legal_notice.disclaimer.title") }}:</h2>
          <p>{{ $t("legal_notice.disclaimer.content") }}</p>
        </div>
      </div>
      <HomeFooter />
    </div>
  </div>
</template>
