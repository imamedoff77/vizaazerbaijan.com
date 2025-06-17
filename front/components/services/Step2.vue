<script setup>
const props = defineProps({
  form: {
    type: Object,
    required: true
  },
  service: {
    type: Object,
    required: true
  },
})


const dates = reactive({
  start: null,
  end: null,
})

const today = new Date()
const minSelectableDate = new Date(today)
minSelectableDate.setDate(today.getDate() + 20)


const setTimes = newVal => {
  dates.start = new Date(newVal.arrival_date)
  dates.end = new Date(dates.start)
  dates.end.setDate(dates.start.getDate() + 90)
}
watch(props.form, newVal => setTimes(newVal), {deep: true})

onMounted(() => {
  if (props.form.arrival_date) {
    setTimes(props.form)
  }
})

</script>
<template>
  <div class="mb-3">
    <label for="purpose">
      Purpose of visit *
    </label>
    <small>
      Select purpose of your visit.
    </small>
    <select id="purpose" v-model="form.purpose" class="form-select" required>
      <option :value="null">Choose an option</option>
      <option value="Tourism">Tourism</option>
      <option value="Business trip">Business trip</option>
      <option value="Science">Science</option>
      <option value="Education">Education</option>
      <option value="Labour">Labour</option>
      <option value="Culture">Culture</option>
      <option value="Sports">Sports</option>
      <option value="Humanitarian">Humanitarian</option>
      <option value="Medical Treatment">Medical Treatment</option>
      <option value="Personal trip">Personal trip</option>
      <option value="Official trip">Official trip</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="arrival_date">
      Date of arrival in Azerbaijan *
    </label>
    <small>
      (dd-mm-yyyy)
    </small>
    <VueDatePicker placeholder="Select arrival date" v-model="form.arrival_date"
                   :min-date="minSelectableDate"
                   :required="true"></VueDatePicker>
  </div>
  <div v-if="form.arrival_date && dates.start && dates.end">
    <div class="mb-3">
      <div class="alert alert-info">
        Your e-Visa is valid from <b>{{ dates.start.toDateString() }}</b> to <b>{{
          dates.end.toDateString()
        }}</b> for a
        total period of 90 days. Your
        stay
        cannot exceed 30 days. If earliest date you want to choose is not available, you can apply for
        <NuxtLink
            to="/services/fast-service/"><b>Fast
          Service</b></NuxtLink>
        (10-12 hours) or
        <NuxtLink to="/services/emergency-service/"><b>Emergency Service</b></NuxtLink>
        (3-5 hours).
      </div>
    </div>
    <div v-if="dates.start && dates.end" class="mb-3">
      <div class="dates">
        <div class="box beginning">
          <span class="box-type">BEGINNING</span>
          <span class="week-day">{{ dates.start.toLocaleString('en-US', {weekday: 'long'}) }}</span>
          <span class="day">{{ dates.start.getDate() }}</span>
          <span class="month">{{ dates.start.toLocaleString('en-US', {month: 'long'}) }}</span>
          <span class="year">{{ dates.start.getFullYear() }}</span>
        </div>
        <div class="box end">
          <span class="box-type">END</span>
          <span class="week-day">{{ dates.end.toLocaleString('en-US', {weekday: 'long'}) }}</span>
          <span class="day">{{ dates.end.getDate() }}</span>
          <span class="month">{{ dates.end.toLocaleString('en-US', {month: 'long'}) }}</span>
          <span class="year">{{ dates.end.getFullYear() }}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-3">
    <div class="cost">
      <div class="left">
        Standard eVisa (within 3 to 5 days)
        <br>
        <span class="price">${{ service['price'].toFixed(2) }}</span>
        <span class="valyuta">
                    USD
                </span>
        <br>
        Visa fee
      </div>
      <div class="right">
        <img src="/assets/custom/images/paypal-payment.png" alt="">
      </div>
    </div>
  </div>
</template>
