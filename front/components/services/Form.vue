<script setup>
defineProps({
  countries: {
    type: Array,
    required: true
  },
  eligibleCountries: {
    type: Array,
    required: true
  },
  currentStep: {
    type: Number,
    required: true
  },
  form: {
    type: Object,
    required: true
  },
  service: {
    type: Object,
    required: true
  },
  submit: {
    type: Function,
    required: true
  }
})


</script>
<template>
  <form @submit.prevent="submit">
    <ServicesStep1 :form="form" :eligibleCountries="eligibleCountries" v-if="currentStep == 1"/>
    <ServicesStep2 :service="service" :form="form" v-if="currentStep == 2"/>
    <ServicesStep3 :form="form" :countries="countries" v-if="currentStep == 3"/>
    <!--    <ServicesStep4 :form="form" v-if="currentStep == 4"/>-->
  </form>
</template>
