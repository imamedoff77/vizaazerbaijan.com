<script setup>
import {RecaptchaV2} from "vue3-recaptcha-v2";
import {useContactForm} from "~/composables/main/ContactComposable.js";

const config = useRuntimeConfig().public

const {
  message,
  submit,
  handleLoadCallback
} = useContactForm()
</script>
<template>
  <section class="contact-page">
    <div class="contact-container">
      <div class="top">
        <h2 class="title">
          Contact
        </h2>
        <p class="description">
          If you have any questions about your application, please reach out to us using the form or email us directly
          at:
          <a :href="`mailto:${config.mail}`">{{ config.mail }}</a>
        </p>
        <p>
          <b>We will respond as soon as possible.</b>
        </p>
      </div>
      <form @submit.prevent="submit" class="bottom">
        <div class="mb-3">
          <label for="name">
            First & Last Name *
          </label>
          <input type="text" id="name" v-model="message.name" placeholder="First & Last Name" class="form-control"
                 required>
        </div>
        <div class="mb-3">
          <label for="app_number">
            Application Number (if you already have)
          </label>
          <input type="number" id="app_number" v-model="message.application_number" placeholder="Application Number"
                 class="form-control">
        </div>
        <div class="mb-3">
          <label for="email">
            Email *
          </label>
          <input type="text" id="email" v-model="message.email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="message">
            Message *
          </label>
          <textarea v-model="message.message" id="message" class="form-control" placeholder="Your message"
                    required></textarea>
        </div>
        <div class="mb-3 d-flex justify-content-center">
          <ClientOnly>
            <RecaptchaV2
                @load-callback="handleLoadCallback"
            />
          </ClientOnly>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </section>
</template>