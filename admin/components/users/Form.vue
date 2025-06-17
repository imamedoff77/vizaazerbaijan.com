<script setup>
defineProps({
  selectedUser: {
    type: Object,
    required: true
  },
  save: {
    type: Function,
    required: true
  }
})
</script>
<template>
  <div class="modal fade bd-example-modal-xl" id="user_save_modal" tabindex="-1"
       role="dialog" aria-labelledby="user_save_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title m-0" id="user_save_modal_label">
            İstifadəçi yadda saxla
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div><!--end modal-header-->
        <div v-if="!useEmpty(selectedUser)" class="modal-body">
          <form @submit.prevent="save">
            <div class="mt-3">
              <label for="name">Ad</label>
              <input type="text" id="name" v-model="selectedUser.name" placeholder="Ad" class="form-control" required>
            </div>
            <div class="mt-3">
              <label for="surname">Soyad</label>
              <input type="text" id="surname" v-model="selectedUser.surname" placeholder="Soyad" class="form-control"
                     required>
            </div>
            <div class="mt-3">
              <label for="email">E-mail</label>
              <input type="email" id="email" v-model="selectedUser.email" placeholder="E-mail" class="form-control"
                     required>
            </div>
            <div class="mt-3">
              <label for="new_password">Yeni Şifrə (<small>min. - 5, dəyişmək istəmirsinizsə, boş qoyun</small>)</label>
              <input type="text" id="new_password" v-model="selectedUser.new_password" placeholder="Yeni şifrə"
                     class="form-control">
            </div>
            <div class="mt-3">
              <label for="status">Status</label>
              <select v-model="selectedUser.status" class="form-select" id="status" required>
                <option value="simple">Adi</option>
                <option value="super">Super</option>
              </select>
            </div>
            <div class="mt-3 d-flex flex-row-reverse">
              <button type="submit" class="btn btn-sm btn-primary">
                Yadda saxla
              </button>
            </div>
          </form>
        </div><!--end modal-body-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm"
                  data-bs-dismiss="modal">Bağla
          </button>
        </div><!--end modal-footer-->
      </div><!--end modal-content-->
    </div><!--end modal-dialog-->
  </div><!--end modal-->
</template>
<style scoped>
.message {
  text-align: justify;
}
</style>