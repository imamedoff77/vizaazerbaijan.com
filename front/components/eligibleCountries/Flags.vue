<script setup>
import {useCountries} from "~/store/countries.js";

const eligibleCountries = useCountries().getEligibleCountries
</script>
<template>
  <section class="flags-section">
    <div class="container">
      <p>Nationals from the following countries (with a valid passport) are eligible to apply online for an Azerbaijan
        e-Visa.</p>
      <div class="flags">
        <div v-for="(country, index) in eligibleCountries" :key="`eligibleCountry-${index}`" class="flag">
          <img v-if="country.short_code == 'AD'" src="/assets/custom/images/flags/and.svg" :alt="country.name">
          <img v-else :src="`/assets/custom/images/flags/${country.short_code}.svg`" :alt="country.name">
          <span>{{ country.name }}</span>
        </div>
      </div>
    </div>
  </section>
</template>