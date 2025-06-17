<script setup>
import {useEligibleCountriesMeta} from "~/composables/main/EligibleCountriesComposable.js";

useEligibleCountriesMeta()

const meta = {
  title: 'Eligible Countries',
}
</script>
<template>
  <ReusableServices :meta="meta"/>
  <EligibleCountriesFlags/>
</template>