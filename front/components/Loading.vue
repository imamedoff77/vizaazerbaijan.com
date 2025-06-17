<script setup>
import Loading from 'vue3-loading-overlay';
import 'vue3-loading-overlay/dist/vue3-loading-overlay.css';
import {usePageOverlay} from "~/composables/common/StatesComposable.js";

const pageOverlay = usePageOverlay()
</script>
<template>
  <div class="vld-parent">
    <loading :active="pageOverlay"
             :can-cancel="false"
             loader="bars"
             color="#8B6B44"
             :is-full-page="true"></loading>
  </div>
</template>