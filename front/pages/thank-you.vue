<script setup>
useHead({
  title: 'Thank you',
  bodyAttrs: {
    class: 'layout-2'
  },
  link: [
    {
      rel: 'stylesheet',
      href: '/assets/custom/css/pages/thank-you.css'
    }
  ]
})
</script>
<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-8 mx-auto">
        <div class="thank-you-wrapper">
          <div class="img">
            <img src="/assets/custom/images/thank_you.png" alt="">
          </div>
          <div style="display: grid; place-items: center; width: 100%;">
            <h2>Thank you</h2>
            <NuxtLink to="/" class="theme-btn">Back to Homepage</NuxtLink>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
