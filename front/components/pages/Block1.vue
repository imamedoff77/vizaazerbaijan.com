<script setup>
defineProps({
  block: {
    type: Object,
    required: true
  }
})
</script>
<template>
  <section class="block-1">
    <div class="container">
      <div class="top">
        <div class="left">
          <h3 class="title">{{ block.title }}</h3>
          <ul v-if="block.points.length > 0">
            <li v-for="(point, index) in block.points" :key="`block1-point-${index}`" v-html="point"></li>
          </ul>
        </div>
        <div class="right">
          <div class="img">
            <img :src="useFileUrl(block.image)" :alt="block.title">
          </div>
          <div class="figure">
            <div class="top">
              <div class="left">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
              <div class="right">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bottom">
              <div class="left">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
              <div class="right">
                <div class="p-32">
                  <div class="item">
                    <div class="inner"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>