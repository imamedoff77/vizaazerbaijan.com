<script setup>
import {usePageHeader} from "~/composables/common/StatesComposable.js";

const pageHeader = usePageHeader()
</script>
<template>
  <div class="row breadcrumb-container">
    <div class="col-sm-12">
      <div class="page-title-box d-lg-flex justify-content-lg-between align-items-center">
        <h4 v-if="pageHeader?.title" class="page-title" v-html="pageHeader.title"></h4>
        <div v-if="pageHeader?.links && !useEmpty(pageHeader.links)" class="">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <NuxtLink to="/">Panel</NuxtLink>
            </li><!--end nav-item-->
            <li v-for="(link, index) in pageHeader.links" :key="`linkIndex-${index}`" class="breadcrumb-item">
              <NuxtLink v-if="link?.link" :to="link.link">
                <span v-html="link.title"></span>
              </NuxtLink>
              <span v-else class="active" v-html="link.title"></span>
            </li>
          </ol>
        </div>
        <div v-else class="">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <NuxtLink to="/visa">Panel</NuxtLink>
            </li><!--end nav-item-->
          </ol>
        </div>
      </div><!--end page-title-box-->
    </div><!--end col-->
  </div><!--end row-->
</template>
