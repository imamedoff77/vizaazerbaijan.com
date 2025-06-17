<script setup>
import {RecaptchaV2} from "vue3-recaptcha-v2";

const props = defineProps({
  form: {
    type: Object,
    required: true
  },
  countries: {
    type: Array,
    required: true
  },
})

const maxSelectableDate = new Date()

const occupations = [
  "Agriculture",
  "Artist",
  "Communications",
  "Computer science",
  "Culinary/Food Services",
  "Driver",
  "Education",
  "Engineering",
  "Finance/Banking",
  "Government",
  "Healthcare",
  "Law-enforcement agencies",
  "Media representative",
  "Military",
  "Mining",
  "Natural sciences",
  "Non-governmental organizations",
  "Pensioner",
  "Physics",
  "Private sector",
  "Religious figure",
  "Researcher",
  "Schooler/Student",
  "Social sciences",
  "Sports",
  "Translator/ Interpreter",
  "Unemployed",
  "Other"
];

const selectFile = e => props.form.passport_file = e.target.files[0]
const handleLoadCallback = token => props.form['g-recaptcha-response'] = token

</script>
<template>
  <div class="mb-3">
    <label for="surname">Surname</label>
    <small>Type your surname exactly as it appears in your passport. If your travel document does not include a
      surname, you may leave this field blank.</small>
    <input type="text" id="surname" v-model="form.surname" class="form-control" placeholder="Surname" required>
  </div>
  <div class="mb-3">
    <label for="given_name">Other names / Given name(s) *</label>
    <small>Type your name as shown in your travel document.</small>
    <input type="text" id="given_name" v-model="form.given_name" class="form-control" placeholder="Given name(s)"
           required>
  </div>
  <div class="mb-3">
    <label for="birthday">Date of Birth *</label>
    <small>Enter your date of birth as stated in your travel document.</small>
    <VueDatePicker placeholder="Your birthday" v-model="form.birthday"
                   :max-date="maxSelectableDate"
                   :required="true"></VueDatePicker>
  </div>
  <div class="mb-3">
    <label for="country-of-birth">Country of birth *</label>
    <small>Enter your country of birth as stated in your passport.</small>
    <select id="country-of-birth" v-model="form.country_of_birth" class="form-select" required>
      <option :value="null">Choose an option</option>
      <option v-for="country in countries" :key="`country-birth-${country.id}`" :value="country.id">
        {{ country.name }}
      </option>
    </select>
  </div>
  <div class="mb-3">
    <label for="place-of-birth">Place of birth *</label>
    <small>Enter your place of birth as stated in your passport.</small>
    <input type="text" id="place-of-birth" v-model="form.place_of_birth" class="form-control"
           placeholder="Place of birth" required>
  </div>
  <div class="mb-3">
    <label for="sex">Sex *</label>
    <select id="sex" v-model="form.sex" class="form-select" required>
      <option :value="null">Choose an option</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="occupation">Occupation *</label>
    <select id="occupation" v-model="form.occupation" class="form-select" required>
      <option :value="null">Choose an option</option>
      <option v-for="(occupation, index) in occupations" :key="`occupation-${index}`" :value="occupation">
        {{ occupation }}
      </option>
    </select>
  </div>
  <div class="mb-3">
    <label for="phone_number">
      Mobile number *
    </label>
    <input type="number" v-model="form.phone_number" id="phone_number" class="form-control"
           placeholder="+994 XX XXX XX XX" required>
  </div>
  <div class="mb-3">
    <label for="address">Address *</label>
    <small>Enter your permanent residence address - city and exact street address.</small>
    <input type="text" id="address" v-model="form.address" placeholder="Address" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="email">E-mail address *</label>
    <small>Enter your email address</small>
    <input type="email" id="email" v-model="form.email" placeholder="E-mail" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="passport">Copy of the passport *</label>
    <small>Upload a copy of the photo page of the travel document. The file size must not exceed 6 MB and the format
      must be as .jpg / jpeg / png / pdf</small>
    <label for="passport-select">
            <span v-if="!form.passport_file" class="empty">
                Drag files here or <span style="text-decoration: underline">browse</span>
            </span>
      <span v-else>
                Selected file: {{ form.passport_file.name }}
            </span>
    </label>
    <input type="file" id="passport-select" accept=".jpg,.jpeg,.png,.pdf" class="d-none"
           @change="e => selectFile(e)" required>
    <p>Please attach main page coloured-copy of your travel document. Please ensure that all the text can be clearly
      read, as in the example below.</p>
    <img class="passport-example" src="/assets/custom/images/example-passport.jpg" alt="">
  </div>
  <div class="mb-3">
    <label for="passport-date">
      Passport issue date *
    </label>
    <VueDatePicker placeholder="Passport issue date" v-model="form.passport_issue_date"
                   :required="true"></VueDatePicker>
  </div>
  <div class="mb-3">
    <label for="passport-date">
      Passport expire date *
    </label>
    <VueDatePicker placeholder="Passport expire date" v-model="form.passport_expire_date"
                   :required="true"></VueDatePicker>
  </div>
  <div class="mb-3">
    <label for="address-in-az">
      Address in Azerbaijan *
    </label>
    <small>Enter the city and the exact street address in Azerbaijan (or hotel name). There's no need to book
      accommodation in advance.</small>
    <input type="text" id="address-in-az" v-model="form.address_in_azerbaijan" class="form-control"
           placeholder="Address in Azerbaijan" required>
  </div>
  <div class="mb-3">
    <p>Terms & Conditions *</p>
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" v-model="form.terms" :value="true" id="terms-conditions">
      <label class="form-check-label" for="terms-conditions">
        I have read and accept the conditions
      </label>
    </div>
    <a target="_blank" href="/terms-conditions">Read Terms and Conditions</a>
  </div>
  <div class="mt-3 d-flex justify-content-center">
    <RecaptchaV2
        @load-callback="handleLoadCallback"
    />
  </div>
  <div class="mt-3 d-flex flex-row-reverse">
    <button type="submit" class="btn btn-primary">Submit request</button>
  </div>
</template>
