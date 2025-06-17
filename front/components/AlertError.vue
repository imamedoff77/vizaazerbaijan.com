<script setup>
defineProps({
  title: {
    type: String,
    required: false,
  }
})
</script>
<template>
  <div class="container mt-3 mb-3">
    <div class="card custom-card">
      <div v-if="title" class="card-header">
        <h4 class="page-title">{{ title }}</h4>
      </div>
      <div class="card-body">
        <div class="alert alert-danger">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>
