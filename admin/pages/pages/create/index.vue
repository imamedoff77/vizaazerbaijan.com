<script setup>
import {useCreatePage} from "~/composables/panel/PagesComposable.js";

definePageMeta({
  middleware: 'super-admin'
})

useCreatePage()

</script>
<template>
  <PagesFormContainer/>
</template>
