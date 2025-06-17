<script setup>
import {debounce} from 'lodash-es';;
import {useVisaStatuses} from "~/composables/common/CommonComposable.js";

const props = defineProps({
  filters: {
    type: Object,
    required: true
  },
})

const searchQuery = ref('')

watch(searchQuery, debounce(() => props.filters.search.query = searchQuery.value, 350))

const {statuses} = useVisaStatuses()

</script>
<template>
  <div class="table-filters">
    <div class="filter">
      <label>Axtarış</label>
      <div class="input-group">
        <select v-model="filters.search.for" class="form-control">
          <option value="id" selected="selected">Id</option>
          <option value="application_number">App number</option>
          <option value="given_name">Ad</option>
          <option value="created_at">Qeyd olma tarixi</option>
        </select>
        <input type="text" v-model="searchQuery" placeholder="Axtarış" class="form-control">
      </div>
    </div>
    <div class="filter">
      <label for="status">Status</label>
      <MultiSelect v-model="filters.statuses" :options="statuses" optionLabel="value" optionValue="key" filter
                   placeholder="Status"
                   :maxSelectedLabels="3" class="w-100"/>
    </div>
  </div>
</template>