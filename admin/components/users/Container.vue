<script setup>
import {useUserList} from "~/composables/panel/UsersComposable.js";

const {
  users,
  filters,
  pagination,
  onSort,
  onPage,
  selectUser,
  selectedUser,
  askRemove,
  freshUser,
  save
} = useUserList()
</script>
<template>
  <UsersForm :selectedUser="selectedUser" :save="save"/>
  <div class="row">
    <div class="col-12">
      <div class="d-flex flex-row-reverse">
        <button @click.prevent="selectUser(freshUser); useModal('user_save_modal');" type="button"
                class="btn btn-sm btn-primary">
          <i class="fas fa-plus"></i> Əlavə et
        </button>
      </div>
      <hr>
      <UsersHeader :filters="filters"/>
      <UsersTable
          v-if="users?.data && users.data.length > 0"
          :users="users"
          :onSort="onSort"
          :onPage="onPage"
          :selectUser="selectUser"
          :askRemove="askRemove"
          :pagination="pagination"
      />
    </div>
  </div>
</template>
