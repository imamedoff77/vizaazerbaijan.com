<script setup>
import {useUpdatePage} from "~/composables/panel/PagesComposable.js";

const page = await useUpdatePage()
definePageMeta({
  middleware: 'super-admin'
})

</script>
<template>
  <AlertError v-if="useEmpty(page)" title="Səhifə">Səhifə tapılmadı</AlertError>
  <PagesFormContainer v-else :pageData="page"/>
</template>
