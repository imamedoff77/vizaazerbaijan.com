<script setup>
import {usePageDetail} from "~/composables/main/PagesComposable.js";
import {useMetaData} from "~/composables/common/CommonComposable.js";

const page = await usePageDetail()
if (!useEmpty(page)) {
  useMetaData({
    title: page.page_title,
    description: page.description,
    keywords: page.keywords
  })
}

</script>
<template>
  <AlertError v-if="useEmpty(page)" title="Page">
    Page not found
  </AlertError>
  <div v-else>
    <ReusableBanner :meta="{
      title: page.list_title,
      description: page.description
    }"/>
    <PagesBlock1 :block="page.block1"/>
    <PagesBlock2 :block="page.block2"/>
  </div>
</template>