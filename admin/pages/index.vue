<script setup>
import {useLoginMeta} from "~/composables/auth/LoginComposable.js";

definePageMeta({
  layout: 'auth',
  middleware: 'un-auth-only',
  unauthenticatedOnly: true,
  auth: false
})
useLoginMeta()
</script>
<template>
  <div class="container-xxl">
    <div class="row vh-100 d-flex justify-content-center">
      <div class="col-12 align-self-center">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 mx-auto">
              <div class="card">
                <div class="card-body p-0 bg-black auth-header-box rounded-top">
                  <div class="text-center p-3">
                    <NuxtLink to="/" class="logo logo-admin">
                      <img src="/assets/temp/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
                    </NuxtLink>
                    <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Admin panel</h4>
                    <p class="text-muted fw-medium mb-0">Giriş</p>
                  </div>
                </div>
                <div class="card-body pt-0">
                  <AuthLoginForm/>
                </div><!--end card-body-->
              </div><!--end card-->
            </div><!--end col-->
          </div><!--end row-->
        </div><!--end card-body-->
      </div><!--end col-->
    </div><!--end row-->
  </div><!-- container -->
</template>
