<script setup>
const currentYear = new Date().getFullYear()
const config = useRuntimeConfig().public
</script>
<template>
  <footer class="footer text-center text-sm-start d-print-none">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mb-0 rounded-bottom-0">
            <div class="card-body">
              <p class="text-muted mb-0">
                ©
                {{ currentYear }}
                <NuxtLink to="/">
                  {{ config.siteName }}
                </NuxtLink>
                <span class="text-muted d-none d-sm-inline-block float-end">
                  Hazırladı
                  <a href="tel: +994515772877">İbrahim Məmmədov</a></span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
