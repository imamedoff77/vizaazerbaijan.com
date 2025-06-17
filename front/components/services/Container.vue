<script setup>
import {useServiceForm} from "~/composables/main/ServiceComposable.js";

const props = defineProps({
  serviceData: {
    type: Object,
    required: true
  },
  countries: {
    type: Array,
    required: true
  },
  eligibleCountries: {
    type: Array,
    required: true
  }
})


const {
  steps,
  form,
  submit
} = useServiceForm(props.serviceData)

</script>
<template>
  <section class="services-page">
    <div class="contact-container">
      <div class="top">
        <h2 class="title">
          {{ serviceData.title }}
        </h2>
      </div>
      <div id="main-services">
        <div class="services-container">
          <ServicesSteps :currentStep="steps.current"/>
          <div class="card mt-3 mb-3">
            <div class="card-body">
              <ServicesForm
                  :form="form"
                  :currentStep="steps.current"
                  :countries="countries"
                  :eligibleCountries="eligibleCountries"
                  :service="serviceData"
                  :submit="submit"
              />
            </div>
          </div>
          <ServicesNav :form="form" :steps="steps"/>
        </div>
      </div>
    </div>
  </section>
</template>