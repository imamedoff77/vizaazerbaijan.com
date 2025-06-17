<script setup>
import {usePageList} from "~/composables/panel/PagesComposable.js";

const {
  pages,
  filters,
  pagination,
  onSort,
  onPage,
  askRemove,
} = usePageList()
</script>
<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-row-reverse">
        <NuxtLink to="/pages/create" class="btn btn-sm btn-primary">
          <i class="fas fa-plus"></i> Əlavə et
        </NuxtLink>
      </div>
      <hr>
      <PagesListHeader :filters="filters"/>
      <PagesListTable
          v-if="pages?.data && pages.data.length > 0"
          :pages="pages"
          :onSort="onSort"
          :onPage="onPage"
          :askRemove="askRemove"
          :pagination="pagination"
      />
    </div>
  </div>
</template>
