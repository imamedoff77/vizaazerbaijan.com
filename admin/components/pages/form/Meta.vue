<script setup>
defineProps({
  page: {
    type: Object,
    required: true
  },
  selectFile: {
    type: Function,
    required: true
  }
})
</script>
<template>
  <div>
    <div class="mt-3">
      <label for="list_title">List title</label>
      <input type="text" id="list_title" v-model="page.list_title" placeholder="List title" class="form-control"
             required>
    </div>
    <div class="mt-3">
      <label for="page_title">Page title</label>
      <input type="text" id="page_title" v-model="page.page_title" placeholder="Page title" class="form-control"
             required>
    </div>
    <div class="mt-3">
      <label for="slug">Slug</label>
      <input type="text" id="slug" v-model="page.slug" placeholder="Slug" class="form-control" required>
    </div>
    <div class="mt-3">
      <label for="description">Description</label>
      <textarea v-model="page.description" id="description" class="form-control" required></textarea>
    </div>
    <div class="mt-3">
      <label for="keywords">Keywords</label>
      <ClientOnly>
        <vue3-tags-input :tags="page.keywords" @on-tags-changed="keyword => page.keywords = keyword"
                         placeholder="Açar söz əlavə et"/>
      </ClientOnly>
    </div>
    <div class="mt-3">
      <div class="d-flex justify-content-between mb-3">
        <label for="og_image_file">Og image</label>
        <div v-if="!useEmpty(page.og_image)">
          Cari fayl
          <img class="preview-og-image" :src="page.og_image" alt="">
        </div>
      </div>
      <input type="file" id="og_image_file" @change="e => selectFile(e, 'og_image')" accept="image/*"
             class="form-control"
             required>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.preview-og-image {
  width: 100%;
  height: 100%;
  max-height: 150px;
  border-radius: 10px;
}
</style>