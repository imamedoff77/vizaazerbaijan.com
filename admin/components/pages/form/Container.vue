<script setup>
import {usePageForm} from "~/composables/panel/PagesComposable.js";

const props = defineProps({
  pageData: {
    type: Object,
    required: false,
    default: {}
  }
})

const {
  activeTab,
  setActiveTab,
  submit,
  page,
  selectFile
} = usePageForm(props.pageData)
</script>
<template>
  <div class="pages-form">
    <PagesFormNav :activeTab="activeTab" :setActiveTab="setActiveTab"/>
    <div class="card mt-3">
      <div class="card-body">
        <form>
          <PagesFormMeta v-show="activeTab == 0" :selectFile="selectFile" :page="page"/>
          <PagesFormBlock1 v-show="activeTab == 1" :selectFile="selectFile" :page="page"/>
          <PagesFormBlock2 v-show="activeTab == 2" :selectFile="selectFile" :page="page"/>
          <div class="mt-3 d-flex flex-row-reverse">
            <button @click.prevent="submit" type="button" class="btn btn-sm btn-primary">Yadda saxla</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<style lang="scss">
.pages-form {
  nav {
    ul {
      padding: 0;
      margin: 0;
      list-style: none;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      border-bottom: 1px solid #eee;

      li {
        button {
          font-size: 14px;
        }

        &.active {
          border-bottom: 1px solid #0a7d63;

          button {
            color: #0a7d63;
          }
        }
      }
    }
  }
}
</style>