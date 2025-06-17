<script setup>
import {useLoadScripts} from "~/composables/common/TempComposable.js";

onMounted(() => {
  if (process.client) {
    useLoadScripts()
  }
})
</script>
<template>
  <ClientOnly>
    <ReusableLoading/>
  </ClientOnly>
  <!-- Top Bar Start -->
  <TempNavbar/>
  <!-- Top Bar End -->
  <!-- leftbar-tab-menu -->
  <TempSidebar/>
  <!-- end leftbar-tab-menu-->

  <div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content">
      <div class="container-fluid">
        <TempBreadcrumb/>
        <slot></slot>
      </div><!-- container -->
      <!--Start Footer-->
      <TempFooter/>
      <!--end footer-->
    </div>
    <!-- end page content -->
  </div>
  <!-- end page-wrapper -->
</template>
<style lang="scss">
.form-control {
  border-color: #ced4da;
  font-weight: 400;
}

form {
  label {
    margin-bottom: 7px;
    color: #333;
  }
}

.star {
  color: red;
}

.table {
  thead {
    td {
      font-weight: bolder;
      color: #333;
    }
  }
}

.vld-overlay {
  z-index: 9999999 !important;
}

.w-fit {
  width: fit-content !important;
}

.table-lang-flag {
  width: 28px;
  height: 18px;
}

.mr-5 {
  margin-right: 5px;
}

.table-filters {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;

  .p-multiselect-label {
    padding: 0.517rem 0.95rem;
  }
}
</style>