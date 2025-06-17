import Vue3TagsInput from 'vue3-tags-input';

export default defineNuxtPlugin(async (nuxtApp) => {
    nuxtApp.vueApp
        .component('Vue3TagsInput', Vue3TagsInput)
})