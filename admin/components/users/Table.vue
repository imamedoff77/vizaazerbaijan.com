<script setup>
defineProps({
  users: {
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
  selectUser: {
    type: Function,
    required: true
  },
  askRemove: {
    type: Function,
    required: true
  },
})
</script>
<template>
  <DataTable :value="users?.data"
             sortMode="single"
             :paginator="true"
             :rows="pagination.perPage"
             :first="(pagination.page - 1) * pagination.perPage"
             :totalRecords="users?.total"
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
    <Column field="name" header="Ad" sortable>
      <template #body="{data}">
        {{ data.name }}
      </template>
    </Column>
    <Column field="email" header="E-mail" sortable>
      <template #body="{data}">
        {{ data.email }}
      </template>
    </Column>
    <Column field="status" header="Status" sortable>
      <template #body="{data}">
        <span class="text-success" v-if="data.status == 'super'">Super</span>
        <span v-else class="text-secondary">Simple</span>
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
          <button @click.prevent="selectUser(data); useModal('user_save_modal')" type="button"
                  class="btn btn-sm btn-success">
            Düzəliş
          </button>
          <button @click.prevent="askRemove(data.id)" type="button" class="btn btn-sm btn-danger">
            Sil
          </button>
        </div>
      </template>
    </Column>
  </DataTable>
</template>