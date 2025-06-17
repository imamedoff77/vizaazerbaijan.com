<script setup>
import {useVisaStatuses} from "~/composables/common/CommonComposable.js";

defineProps({
  visa: {
    type: Object,
    required: true
  },
})

const {getStatus} = useVisaStatuses()

</script>
<template>
  <div class="modal fade bd-example-modal-xl" id="view-visa-modal" tabindex="-1"
       role="dialog" aria-labelledby="view-visa-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title m-0" id="view-visa-modal-label">
            Your visa request
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div><!--end modal-header-->
        <div v-if="!useEmpty(visa)" class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <tbody>
              <tr>
                <th>Application number</th>
                <td>
                  {{ visa.application_number }}
                  <button @click.prevent="useCopyText(visa.application_number)" type="button"
                          style="margin-left: 5px" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-copy"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <th>Service</th>
                <td>{{ visa.service.title }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td :class="getStatus(visa.status)?.className">
                  {{ getStatus(visa.status).value }}
                </td>
              </tr>
              <tr>
                <th>Name</th>
                <td>{{ visa.given_name }}</td>
              </tr>
              <tr>
                <th>Submitted at</th>
                <td>{{ useDateFormat(visa.created_at, true) }}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div><!--end modal-body-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm"
                  data-bs-dismiss="modal">Close
          </button>
        </div><!--end modal-footer-->
      </div><!--end modal-content-->
    </div><!--end modal-dialog-->
  </div><!--end modal-->
</template>
<style scoped>
.passport {
  width: auto;
  height: 200px;
}
</style>