<script setup>
import {useContactList} from "~/composables/panel/ContactComposable.js";

const contact = useContactList()
const {messages, selectedMessage, filters} = contact
</script>
<template>
  <ContactView :selectedMessage="selectedMessage"/>
  <div class="row">
    <div class="col-12">
      <ContactHeader :filters="filters"/>
      <ContactTable
          v-if="messages?.data && messages.data.length > 0"
          :contact="contact"
      />
    </div>
  </div>
</template>
