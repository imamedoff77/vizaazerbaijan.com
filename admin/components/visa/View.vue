<script setup>
import {useVisaStatuses} from "~/composables/common/CommonComposable.js";
import {useCountries} from "~/store/countries.js";

const props = defineProps({
  selectedVisa: {
    type: Object,
    required: true
  },
})

const {getStatus} = useVisaStatuses()
const config = useRuntimeConfig().public
</script>
<template>
  <div class="modal fade bd-example-modal-xl" id="view_visa_modal" tabindex="-1"
       role="dialog" aria-labelledby="view_visa_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title m-0" id="view_visa_modal_label">
            Ətraflı
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div><!--end modal-header-->
        <div v-if="!useEmpty(selectedVisa)" class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <tbody>
              <tr>
                <th>İd</th>
                <td>{{ selectedVisa.id }}</td>
              </tr>
              <tr>
                <th>App number</th>
                <td>
                  {{ selectedVisa.application_number }}
                  <button @click.prevent="useCopyText(selectedVisa.application_number)" type="button"
                          style="margin-left: 5px" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-copy"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <th>Servis</th>
                <td>{{ selectedVisa.service.title }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td :class="getStatus(selectedVisa.status)?.className">
                  {{ getStatus(selectedVisa.status).value }}
                </td>
              </tr>
              <tr v-if="!useEmpty(selectedVisa.rejected)">
                <th>Rədd mesajı</th>
                <td>
                  <span v-if="selectedVisa.rejected.message" v-html="selectedVisa.rejected.message"></span>
                  <span v-else>Yazılmayıb</span>
                </td>
              </tr>
              <tr v-if="!useEmpty(selectedVisa.rejected)">
                <th>Rədd tarixi</th>
                <td>
                  {{ useDateFormat(selectedVisa.rejected.created_at) }}
                </td>
              </tr>
              <tr>
                <th>Nationality</th>
                <td>{{ useCountries().getEligibleCountry(selectedVisa.nationality)?.name }}</td>
              </tr>
              <tr>
                <th>Travel Document</th>
                <td>{{ selectedVisa.travel_document }}</td>
              </tr>
              <tr>
                <th>Purpose</th>
                <td>{{ selectedVisa.purpose }}</td>
              </tr>
              <tr>
                <th>Arrival Date</th>
                <td>{{ selectedVisa.arrival_date }}</td>
              </tr>
              <tr>
                <th>Surname</th>
                <td>{{ selectedVisa.surname }}</td>
              </tr>
              <tr>
                <th>Name</th>
                <td>{{ selectedVisa.given_name }}</td>
              </tr>
              <tr>
                <th>Birthday</th>
                <td>{{ selectedVisa.birthday }}</td>
              </tr>
              <tr>
                <th>Country of birth</th>
                <td>{{ selectedVisa.country_of_birth }}</td>
              </tr>
              <tr>
                <th>Place of birth</th>
                <td>{{ selectedVisa.place_of_birth }}</td>
              </tr>
              <tr>
                <th>Sex</th>
                <td>{{ selectedVisa.sex }}</td>
              </tr>
              <tr>
                <th>Occupation</th>
                <td>{{ selectedVisa.occupation }}</td>
              </tr>
              <tr>
                <th>Phone number</th>
                <td>{{ selectedVisa.phone_number }}</td>
              </tr>
              <tr>
                <th>Address</th>
                <td>{{ selectedVisa.address }}</td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>{{ selectedVisa.email }}</td>
              </tr>
              <tr>
                <th>Passport</th>
                <td>
                  <div>
                    <img class="passport" :src="useFileUrl(selectedVisa.passport_file)" alt="">
                  </div>
                  <a target="_blank" :href="`${config.apiUrl}visa/${selectedVisa.id}/download`"
                     class="btn btn-sm btn-dark mt-3">
                    <i class="fas fa-file"></i> Yüklə
                  </a>
                </td>
              </tr>
              <tr>
                <th>Passport issue date</th>
                <td>{{ selectedVisa.passport_issue_date }}</td>
              </tr>
              <tr>
                <th>Passport expire date</th>
                <td>{{ selectedVisa.passport_expire_date }}</td>
              </tr>
              <tr>
                <th>Address in Azerbaijan</th>
                <td>{{ selectedVisa.address_in_azerbaijan }}</td>
              </tr>
              <tr>
                <th>Created at</th>
                <td>{{ useDateFormat(selectedVisa.created_at, true) }}</td>
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
.passport {
  width: auto;
  height: 200px;
}
</style>