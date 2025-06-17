<script setup>
import {debounce} from 'lodash-es';;

const props = defineProps({
  filters: {
    type: Object,
    required: true
  },
})

const searchQuery = ref('')

watch(searchQuery, debounce(() => props.filters.search.query = searchQuery.value, 350))

</script>
<template>
  <div class="table-filters">
    <div class="filter">
      <label>Axtarış</label>
      <div class="input-group">
        <select v-model="filters.search.for" class="form-control">
          <option value="id" selected="selected">Id</option>
          <option value="list_title">List title</option>
          <option value="page_title">page title</option>
          <option value="created_at">Əlavə olunma tarixi</option>
        </select>
        <input type="text" v-model="searchQuery" placeholder="Axtarış" class="form-control">
      </div>
    </div>
  </div>
</template>