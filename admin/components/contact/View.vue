<script setup>
defineProps({
  selectedMessage: {
    type: Object,
    required: true
  },
})
</script>
<template>
  <div class="modal fade bd-example-modal-xl" id="view_message_modal" tabindex="-1"
       role="dialog" aria-labelledby="view_message_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title m-0" id="view_message_modal_label">
            Ətraflı
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div><!--end modal-header-->
        <div v-if="!useEmpty(selectedMessage)" class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <tbody>
              <tr>
                <th>Ad</th>
                <td>{{ selectedMessage.name }}</td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>{{ selectedMessage.email }}
                  <button @click.prevent="useCopyText(selectedMessage.email)" type="button"
                          class="btn btn-sm btn-primary"><i class="fas fa-copy"></i></button>
                </td>
              </tr>
              <tr>
                <th>App number</th>
                <td>
                  {{ selectedMessage.application_number }}
                </td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <span v-if="selectedMessage.read_at" class="text-success">Oxunub</span>
                  <span v-else class="text-danger">Oxunmayıb</span>
                </td>
              </tr>
              <tr>
                <th>Mesaj</th>
                <td>
                  <div class="message">{{ selectedMessage.message }}</div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
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