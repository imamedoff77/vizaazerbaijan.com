<script setup>
const props = defineProps({
    eligibleCountries: {
        type: Array,
        required: true
    },
    form: {
        type: Object,
        required: true
    }
})

</script>
<template>
    <div class="mb-3">
        <label for="nationality">
            Nationality / Citizenship *
        </label>
        <small>
            Select country as stated in your passport.
        </small>
        <select id="nationality" v-model="form.nationality" class="form-select" required>
            <option :value="null">Choose an option</option>
            <option v-for="country in eligibleCountries" :key="`country-${country.id}`" :value="country.id">
                {{ country.name }}
            </option>
        </select>
    </div>
    <div class="mb-3">
        <label for="travel_document">
            Travel Document *
        </label>
        <small>
            Select the type of your travel document.
        </small>
        <select id="travel_document" v-model="form.travel_document" class="form-select" required>
            <option :value="null">Choose an option</option>
            <option value="Ordinary Passport">Ordinary Passport</option>
            <option value="Diplomatic Passport">Diplomatic Passport</option>
            <option value="Service Passport">Service Passport</option>
            <option value="For stateless person">For stateless person</option>
            <option value="Special Passport">Special Passport</option>
            <option value="Official Passport">Official Passport</option>
            <option value="Refugee Passport">Refugee Passport</option>
        </select>
    </div>
</template>
