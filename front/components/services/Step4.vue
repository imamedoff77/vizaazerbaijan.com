<script setup>
import {RecaptchaV2} from "vue3-recaptcha-v2";

const props = defineProps({
  form: {
    type: Object,
    required: true
  }
})

const handleLoadCallback = token => props.form['g-recaptcha-response'] = token

</script>
<template>
  <div class="mt-3">
    <RecaptchaV2
        @load-callback="handleLoadCallback"
    />
  </div>
  <div class="mt-3 d-flex flex-row-reverse">
    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
  </div>
</template>
