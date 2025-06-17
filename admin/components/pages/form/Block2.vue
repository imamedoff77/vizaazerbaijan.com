<script setup>
const props = defineProps({
  page: {
    type: Object,
    required: true
  },
  selectFile: {
    type: Function,
    required: true
  }
})
const addPoint = () => props.page.block2.points.push('')

const removePoint = index => props.page.block2.points.splice(index, 1)
const getText = (index, text) => props.page.block2.points[index] = text
</script>
<template>
  <div class="block-2">
    <b>Blok 2</b>
    <div class="mt-3">
      <div class="d-flex justify-content-between mb-3">
        <label for="block-2-image">Blok şəkli</label>
        <div v-if="!useEmpty(page.block2.image)">
          Cari fayl
          <img class="preview-block-2-image" :src="page.block2.image" alt="">
        </div>
      </div>
      <input type="file" id="block-2-image" @change="e => selectFile(e, 'block2_image')" accept="image/*"
             class="form-control"
             required>
    </div>
    <div class="mt-3">
      <label for="block-2-title">Title</label>
      <input type="text" v-model="page.block2.title" id="block-2-title" placeholder="Title" class="form-control"
             required>
    </div>
    <div class="mt-3">
      <div class="points-container d-flex align-items-center justify-content-between">
        <label for="block-2-points">Points</label>
        <button @click.prevent="addPoint" type="button" class="btn btn-sm btn-success">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <div class="point" v-for="(point, index) in page.block2.points" :key="`point2-${index}`">
        <div class="mt-2 mb-1 d-flex align-items-center justify-content-between">
          <label>Point {{ parseInt(index) + 1 }}</label>
          <button @click.prevent="removePoint(index)" type="button" class="btn btn-sm btn-danger">
            <i class="fas fa-trash-alt"></i>
          </button>
        </div>
        <ClientOnly>
          <ReusableCkeditor :initialText="point" :getOutputText="text => getText(index, text)"/>
        </ClientOnly>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.preview-block-2-image {
  width: 100%;
  height: 100%;
  max-height: 150px;
  border-radius: 10px;
}

.points-container {
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
  margin-bottom: 10px;
}
</style>