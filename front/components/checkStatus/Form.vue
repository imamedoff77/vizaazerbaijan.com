<script setup>
import {RecaptchaV2} from "vue3-recaptcha-v2";
import {useCheckStatusForm} from "~/composables/main/CheckStatusComposable.js";

const config = useRuntimeConfig().public

const {
  visa,
  request,
  submit,
  handleLoadCallback
} = useCheckStatusForm()
</script>
<template>
  <CheckStatusViewModal :visa="visa"/>
  <section class="check-status">
    <div class="container">
      <div class="top">
        <h2 class="title">
          Check Status
        </h2>
        <p class="description">
          Please enter your Application Number and Billing Email in the fields below, then click the "Check Status"
          button. You can find this information in the confirmation email you received.
        </p>
      </div>
      <form @submit.prevent="submit" class="middle">
        <div class="mb-3">
          <div class="row">
            <div class="col-12 col-sm-6">
              <label for="app_number">Application Number</label>
              <input v-model="request.application_number" type="number" id="app_number"
                     placeholder="Found in your order confirmation email"
                     class="form-control" required>
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
              <label for="billing_email">Billing email</label>
              <input v-model="request.email" type="email" id="billing_email"
                     placeholder="Email you used during checkout"
                     class="form-control" required>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <ClientOnly>
                  <RecaptchaV2
                      @load-callback="handleLoadCallback"
                  />
                </ClientOnly>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex flex-row-reverse">
          <button type="submit" class="btn btn-primary">Check Status</button>
        </div>
      </form>
      <div class="bottom">
        <p>
          The The decision on your application will be sent to you via email. If you have any questions about your
          application status, please contact us at <a
            :href="`mailto:${config.mail}`">{{ config.mail }}</a> .
        </p>
        <p>
          Please note the following processing times for eVisas:
        </p>
        <ul>
          <li>
            <b>Standard eVisa:</b> 3-5 working days.
          </li>
          <li>
            <b>Fast eVisa:</b> 10–12 hours (regardless of holidays)
          </li>
          <li>
            <b>Emergency eVisa:</b> 3–5 hours (regardless of holidays)
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>