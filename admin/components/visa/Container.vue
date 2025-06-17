<script setup>
import {useVisaList} from "~/composables/panel/VisaComposable.js";

const {
  requests,
  onSort,
  onPage,
  pagination,
  filters,
  selectVisa,
  selectedVisa,
  changeStatus,
  askRemove,
  selected,
  selectAll,
  unSelectAll,
  downloadExcel
} = useVisaList()
</script>
<template>
  <VisaChangeStatus :selectedVisa="selectedVisa" :changeStatus="changeStatus"/>
  <VisaView :selectedVisa="selectedVisa"/>
  <div class="row">
    <div class="col-12">
      <VisaHeader :filters="filters"/>
      <VisaTable
          v-if="requests?.data && requests.data.length > 0"
          :requests="requests"
          :onSort="onSort"
          :onPage="onPage"
          :pagination="pagination"
          :selectVisa="selectVisa"
          :askRemove="askRemove"
          :selected="selected"
      />
      <div class="d-flex flex-row-reverse gap-1 mt-3 mb-3">
        <button @click.prevent="downloadExcel" :disabled="selected.requests.length == 0" type="button"
                class="btn btn-sm btn-outline-success">
          <i class="fa-solid fa-file-excel"></i> Yüklə
        </button>
        <button @click.prevent="unSelectAll" type="button" class="btn btn-sm btn-outline-danger">
          <i class="fa-solid fa-xmark"></i>
          Hamısını burax
        </button>
        <button @click.prevent="selectAll" type="button" class="btn btn-sm btn-outline-info">
          <i class="fa-solid fa-check"></i>
          Hamısını seç
        </button>
      </div>
    </div>
  </div>
</template>
