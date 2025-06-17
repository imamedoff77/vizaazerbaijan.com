<script setup>
defineProps({
  meta: {
    type: Object,
    required: true
  }
})
</script>
<template>
  <section class="service-container">
    <div class="container">
      <div class="top">
        <h3>{{ meta.title }}</h3>
        <p v-if="meta.description">{{ meta.description }}</p>
      </div>
      <div class="bottom">
        <div class="services">
          <div class="service">
            <NuxtLink to="/services/standard-service/" class="btn btn-primary">
              Standard Service
            </NuxtLink>
            <p>
              3-5 Working Days
            </p>
          </div>
          <div class="service">
            <NuxtLink to="/services/fast-service/" class="btn btn-danger">
              Fast Service
            </NuxtLink>
            <p>
              10-12 Hours
            </p>
          </div>
          <div class="service">
            <NuxtLink to="/services/emergency-service/" class="btn btn-success">
              Emergency Service
            </NuxtLink>
            <p>
              3-5 Hours
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>