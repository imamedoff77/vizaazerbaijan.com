<script setup>
import {usePages} from "~/store/pages.js";

const pages = usePages().all

const responsiveOptions = ref([
  {
    breakpoint: '1400px',
    numVisible: 5,
    numScroll: 1
  },
  {
    breakpoint: '1199px',
    numVisible: 3,
    numScroll: 1
  },
  {
    breakpoint: '767px',
    numVisible: 3,
    numScroll: 1
  },
  {
    breakpoint: '575px',
    numVisible: 2,
    numScroll: 1
  }
]);
</script>
<template>
  <div v-if="pages.length > 0" class="footer-slides">
    <Carousel
        :value="pages"
        :numVisible="5"
        :autoplayInterval="3000"
        :responsiveOptions="responsiveOptions"
        :showNavigators="false"
        :showIndicators="false"
    >
      <template #item="slotProps">
        <div class="slide-container">
          <NuxtLink :to="`/pages/${slotProps.data.slug}/`" class="slide">
            {{ slotProps.data.list_title }}
          </NuxtLink>
        </div>
      </template>
    </Carousel>
  </div>
</template>