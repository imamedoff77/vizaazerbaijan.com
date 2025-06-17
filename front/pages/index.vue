<script setup>
import {useHomeMeta} from "~/composables/main/HomeComposable.js";

useHomeMeta()

const meta = {
  title: 'We Handle All Your Travel Document Needs',
  description: 'Complete Your Application Online'
}

</script>
<template>
  <ReusableBanner :meta="meta"/>
  <HomeHowItWorks/>
  <HomeWhatIsPrice/>
  <HomePurposeOfVisit/>
  <HomeWhatSeeInAzerbaijan/>
</template>