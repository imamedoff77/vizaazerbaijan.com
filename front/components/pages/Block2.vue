<script setup>
defineProps({
  block: {
    type: Object,
    required: true
  }
})
</script>
<template>
  <section class="block-2">
    <div class="left">
      <img :src="useFileUrl(block.image)" :alt="block.title">
    </div>
    <div class="right">
      <h3 class="title">{{ block.title }}</h3>
      <ul v-if="block.points.length > 0">
        <li v-for="(point, index) in block.points" :key="`block1-point-${index}`" v-html="point"></li>
      </ul>
    </div>
  </section>
</template>