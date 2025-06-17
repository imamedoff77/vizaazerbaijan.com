<script setup>
import {useLogout} from "~/composables/auth/LogoutComposable.js";
import {useAvatar} from "~/utils/custom.js";

const {data: user} = useAuth()
const {logout} = useLogout()
const config = useRuntimeConfig().public
</script>
<template>
  <div class="topbar d-print-none">
    <div class="container-fluid">
      <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
        <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
          <li>
            <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
              <i class="iconoir-menu"></i>
            </button>
          </li>
        </ul>
        <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
          <li class="topbar-item">
            <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
              <i class="iconoir-half-moon dark-mode"></i>
              <i class="iconoir-sun-light light-mode"></i>
            </a>
          </li>

          <li class="dropdown topbar-item">
            <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
               role="button"
               aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
              <img :src="useAvatar(user.avatar)" alt="" class="thumb-md rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0">
              <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                <div class="flex-shrink-0">
                  <img :src="useAvatar(user.avatar)" alt="" class="thumb-md rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                  <h6 class="my-0 fw-medium text-dark fs-13">{{ user.name }} {{ user.surname }}</h6>
                  <small
                      class="text-muted mb-0">Admin</small>
                </div><!--end media-body-->
              </div>
              <div class="dropdown-divider mt-0"></div>
              <NuxtLink to="/visa" class="dropdown-item text-success font-bold"><i
                  class="las la-user-lock fs-18 me-1 align-text-bottom"></i> Admin panel
              </NuxtLink>
              <a :href="config.frontUrl" class="dropdown-item"><i
                  class="las la-home fs-18 me-1 align-text-bottom"></i> Ana səhifə</a>
              <div class="dropdown-divider mb-0"></div>
              <a @click.prevent="logout" class="dropdown-item text-danger" href="#"><i
                  class="las la-power-off fs-18 me-1 align-text-bottom"></i> Çıxış</a>
            </div>
          </li>
        </ul><!--end topbar-nav-->
      </nav>
      <!-- end navbar-->
    </div>
  </div>
</template>
