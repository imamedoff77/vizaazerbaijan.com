<script setup>
import {useServicePage} from "~/composables/main/ServiceComposable.js";

const data = useServicePage()
</script>
<template>
  <AlertError v-if="useEmpty(data.service) || useEmpty(data.countries) || useEmpty(data.eligibleCountries)">
    Service not found
  </AlertError>
  <ServicesContainer v-else
                     :serviceData="data.service"
                     :countries="data.countries"
                     :eligibleCountries="data.eligibleCountries"/>
</template>