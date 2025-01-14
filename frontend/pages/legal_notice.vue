<script setup></script>
<template>
  <HomeHeader />
  <div
    class="flex h-fit min-h-screen flex-col bg-[url('/assets/svg/LegalNoticeDesktopBackground.svg')] bg-cover bg-[bottom_2rem_left_2rem] bg-no-repeat"
  >
    <div
      class="mb-[10vh] mt-20 flex w-[65vw] flex-col gap-2 self-center bg-sc-white/70 font-sans [&>div>h2]:font-heading [&>div>h2]:text-xl"
    >
      <h1
        class="my-4 font-heading text-3xl font-bold text-sc-orange lg:self-center lg:text-5xl"
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
  </div>
</template>
