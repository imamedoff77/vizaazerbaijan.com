<script setup>
import {useCountries} from "~/store/countries.js";
import {useVisaStatuses} from "~/composables/common/CommonComposable.js";
import {useIsSuperAdmin} from "~/utils/custom.js";

defineProps({
  requests: {
    type: Object,
    required: true
  },
  onSort: {
    type: Function,
    required: true
  },
  onPage: {
    type: Function,
    required: true
  },
  pagination: {
    type: Object,
    required: true
  },
  selectVisa: {
    type: Function,
    required: true
  },
  askRemove: {
    type: Function,
    required: true
  },
  selected: {
    type: Object,
    required: true
  }
})

const {getStatus} = useVisaStatuses()
const isSuperAdmin = useIsSuperAdmin()
</script>
<template>
  <DataTable :value="requests?.data"
             sortMode="single"
             :paginator="true"
             :rows="pagination.perPage"
             :first="(pagination.page - 1) * pagination.perPage"
             :totalRecords="requests?.total"
             :lazy="true"
             @page="onPage"
             stripedRows
             showGridlines
             :rowsPerPageOptions="[10, 20, 50, 100, 250, 500]"
             @sort="onSort" class="w-100">
    <Column field="index" header="№" sortable>
      <template #body="{index}">
        {{ useTableIndex(index, pagination) }}
      </template>
    </Column>
    <Column field="index" header="Seçim">
      <template #body="{data}">
        <div class="form-check">
          <input class="form-check-input" v-model="selected.requests" type="checkbox" :value="data.id">
        </div>
      </template>
    </Column>
    <Column field="service" header="Servis">
      <template #body="{data}">
        {{ data.service.title }}
      </template>
    </Column>
    <Column field="application_number" header="App Number" sortable>
      <template #body="{data}">
        {{ data.application_number }}
      </template>
    </Column>
    <Column field="status" header="Status">
      <template #body="{data}">
        <span :class="getStatus(data.status)?.className">
          {{ getStatus(data.status)?.value }}
        </span>
      </template>
    </Column>
    <Column field="given_name" header="Ad">
      <template #body="{data}">
        {{ data.given_name }}
      </template>
    </Column>
    <Column field="nationality" header="Ölkə">
      <template #body="{data}">
        {{ useCountries().getEligibleCountry(data.nationality)?.name }}
      </template>
    </Column>
    <Column field="created_at" header="Əlavə edilib" sortable>
      <template #body="{data}">
        {{ useDateFormat(data.created_at) }}
      </template>
    </Column>
    <Column field="action" header="Əməliyyat">
      <template #body="{data}">
        <div class="d-flex gap-2">
          <button @click.prevent="selectVisa(data); useModal('change_status_modal')" type="button"
                  class="btn btn-sm btn-warning">
            Status dəyiş
          </button>
          <button @click.prevent="selectVisa(data); useModal('view_visa_modal')" type="button"
                  class="btn btn-sm btn-success">
            Ətraflı
          </button>
          <button v-if="isSuperAdmin" @click.prevent="askRemove(data.id)" type="button" class="btn btn-sm btn-danger">
            Sil
          </button>
        </div>
      </template>
    </Column>
  </DataTable>
</template>