<script setup>
defineProps({
  meta: {
    type: Object,
    required: true
  }
})
</script>
<template>
  <div class="banner">
    <div class="banner-img-container"></div>
    <div class="banner-content">
      <div class="container">
        <ReusableServices :meta="meta"/>
      </div>
    </div>
  </div>
  <div class="banner-overlay"></div>
</template>