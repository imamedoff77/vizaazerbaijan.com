<script setup>
import {useLogout} from "~/composables/auth/LogoutComposable.js";
import {useNotifications} from "~/store/notifications.js";
import {useIsSuperAdmin} from "~/utils/custom.js";

const {logout} = useLogout()

const unReadCount = computed(() => useNotifications().getUnRead)
const isSuperAdmin = useIsSuperAdmin()
</script>
<template>
  <div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
      <NuxtLink to="/visa" class="logo w-100">
        <div class="d-flex justify-content-center">
          <span class="logo-sm">
            Visa
          </span>
        </div>
        <div class="d-flex justify-content-center">
          <span class="logo-lg">
            VisaAzerbaijan
          </span>
        </div>
      </NuxtLink>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu">
      <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
        <div class="d-flex align-items-start flex-column w-100">
          <!-- Navigation -->
          <ul class="navbar-nav mb-auto w-100">
            <li class="menu-label mt-2">
              <span>Menyu</span>
            </li>
            <li class="nav-item">
              <NuxtLink to="/visa" class="nav-link">
                <i class="iconoir-task-list menu-icon"></i>
                <span>Visa istəkləri</span>
              </NuxtLink>
            </li><!--end nav-item-->
            <li class="nav-item">
              <NuxtLink to="/contact" class="nav-link">
                <i class="iconoir-message menu-icon"></i>
                <span>Contact mesajları</span>
                <span v-if="unReadCount > 0" class="badge text-bg-danger ms-auto">
                  {{ unReadCount }}
                </span>
              </NuxtLink>
            </li><!--end nav-item-->
            <li v-if="isSuperAdmin" class="nav-item">
              <NuxtLink to="/pages" class="nav-link">
                <i class="iconoir-journal-page menu-icon"></i>
                <span>Səhifələr</span>
              </NuxtLink>
            </li><!--end nav-item-->
            <li v-if="isSuperAdmin" class="nav-item">
              <NuxtLink to="/users" class="nav-link">
                <i class="iconoir-user menu-icon"></i>
                <span>Adminlər</span>
              </NuxtLink>
            </li><!--end nav-item-->
            <li class="nav-item">
              <a @click.prevent="logout" href="#" class="nav-link">
                <i class="iconoir-log-out menu-icon"></i>
                <span>Çıxış</span>
              </a>
            </li><!--end nav-item-->

          </ul><!--end navbar-nav--->
        </div>
      </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
  </div><!--end startbar-->
  <div class="startbar-overlay d-print-none"></div>
</template>
<style lang="scss" scoped>
.menu-icon {
  width: 20px;
  height: 20px;
}

.nav-link {
  &.active, &:hover {
    color: #8B6B44 !important;

    i {
      color: #8B6B44 !important;
    }
  }
}


.logo-lg {
  color: #8b6b44;
  font-size: 16px;
  font-weight: 700
}

.logo-sm {
  color: #8b6b44;
  font-size: 14px;
  font-weight: 600
}

body[data-sidebar-size="default"] {
  .logo-lg {
    display: block;
  }

  .logo-sm {
    display: none;
  }
}

body[data-sidebar-size="collapsed"] {
  .logo-lg {
    display: none;
  }

  .logo-sm {
    display: block;
  }
}

</style>
