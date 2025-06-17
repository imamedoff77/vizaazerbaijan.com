<script setup>
const props = defineProps({
  contact: {
    type: Object,
    required: true
  },
})

const {
  messages,
  pagination,
  onSort,
  onPage,
  selectMessage,
  askRemove,
  selectedMessages,
  askBulkRemove
} = props.contact

</script>
<template>
  <DataTable :value="messages?.data"
             sortMode="single"
             :paginator="true"
             :rows="pagination.perPage"
             :first="(pagination.page - 1) * pagination.perPage"
             :totalRecords="messages?.total"
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
          <input class="form-check-input" v-model="selectedMessages" type="checkbox" :value="data.id">
        </div>
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
    <Column field="read_at" header="Status" sortable>
      <template #body="{data}">
        <span v-if="data.read_at" class="text-success">Oxunub</span>
        <span v-else class="text-danger">Oxunmayıb</span>
      </template>
    </Column>
    <Column field="created_at" header="Göndərilib" sortable>
      <template #body="{data}">
        {{ useDateFormat(data.created_at) }}
      </template>
    </Column>
    <Column field="action" header="Əməliyyat">
      <template #body="{data}">
        <div class="d-flex gap-2">
          <button @click.prevent="selectMessage(data); useModal('view_message_modal')" type="button"
                  class="btn btn-sm btn-success">
            Bax
          </button>
          <button @click.prevent="askRemove(data.id)" type="button" class="btn btn-sm btn-danger">
            Sil
          </button>
        </div>
      </template>
    </Column>
  </DataTable>
  <div class="mt-3 d-flex flex-row-reverse">
    <button @click.prevent="askBulkRemove" :disabled="selectedMessages.length == 0"
            class="btn btn-sm btn-outline-danger">
      Seçilənləri sil
    </button>
  </div>
</template>