<script setup>
import {useRequirementsMeta} from "~/composables/main/RequirementsComposable.js";

useRequirementsMeta()

const meta = {
  title: 'Requirements',
  description: 'Get detailed  information about Azerbaijan Travel Requirements'
}
</script>
<template>
  <ReusableBanner :meta="meta"/>
  <RequirementsApplicationRequirements/>
  <RequirementsConsidirations/>
</template>