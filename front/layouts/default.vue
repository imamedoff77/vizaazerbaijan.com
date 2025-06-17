<template>
  <ClientOnly>
    <Loading/>
  </ClientOnly>
  <TempNavbar/>
  <slot></slot>
  <TempSlides/>
  <TempFooter/>
</template>
<style>
body {
  background: #F8F9FA !important;
}

@media only screen and (max-width: 768px) {
  .container {
    max-width: 700px;
  }
}
</style>