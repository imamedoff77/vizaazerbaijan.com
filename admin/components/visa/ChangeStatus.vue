<script setup>
import {useVisaStatuses} from "~/composables/common/CommonComposable.js";

const props = defineProps({
  selectedVisa: {
    type: Object,
    required: true
  },
  changeStatus: {
    type: Function,
    required: true
  }
})

const {statuses, getStatusByCase} = useVisaStatuses()

const getOutputText = text => props.selectedVisa.message = text

const showMessageField = computed(
    () => props.selectedVisa.status == getStatusByCase('CANCELLED').key || props.selectedVisa.status == getStatusByCase('COMPLETED').key
)

</script>
<template>
  <div class="modal fade bd-example-modal-xl" id="change_status_modal" tabindex="-1"
       role="dialog" aria-labelledby="article_preview_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title m-0" id="change_status_modal_label">
            Status dəyiş
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div><!--end modal-header-->
        <div v-if="!useEmpty(selectedVisa)" class="modal-body">
          <form @submit.prevent="changeStatus">
            <div class="mt-3">
              <label for="visa-status">
                Status
              </label>
              <select v-model="selectedVisa.status" id="visa-status" class="form-select" required>
                <option v-for="status in statuses" :key="`visaStatus-${status.key}`" :value="status.key">{{
                    status.value
                  }}
                </option>
              </select>
            </div>
            <div
                v-if="showMessageField"
                class="mt-3">
              <label for="message">Mesajınız (optional)</label>
              <ClientOnly>
                <ReusableCkeditor :getOutputText="getOutputText"/>
              </ClientOnly>
            </div>
            <div class="mt-3 d-flex flex-row-reverse">
              <button type="submit" class="btn btn-sm btn-primary">Yadda saxla</button>
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
