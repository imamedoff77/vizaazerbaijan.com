<script setup>
defineProps({
  pages: {
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
  askRemove: {
    type: Function,
    required: true
  },
})
</script>
<template>
  <DataTable :value="pages?.data"
             sortMode="single"
             :paginator="true"
             :rows="pagination.perPage"
             :first="(pagination.page - 1) * pagination.perPage"
             :totalRecords="pages?.total"
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
    <Column field="list_title" header="Title" sortable>
      <template #body="{data}">
        {{ data.list_title }}
      </template>
    </Column>
    <Column field="views" header="Baxış sayı" sortable>
      <template #body="{data}">
        {{ data.views }}
      </template>
    </Column>
    <Column field="created_at" header="Qeyd edilib" sortable>
      <template #body="{data}">
        {{ useDateFormat(data.created_at) }}
      </template>
    </Column>
    <Column field="action" header="Əməliyyat">
      <template #body="{data}">
        <div class="d-flex gap-2">
          <NuxtLink :to="`/pages/update/${data.id}`" class="btn btn-sm btn-success">
            Düzəliş
          </NuxtLink>
          <button @click.prevent="askRemove(data.id)" type="button" class="btn btn-sm btn-danger">
            Sil
          </button>
        </div>
      </template>
    </Column>
  </DataTable>
</template>