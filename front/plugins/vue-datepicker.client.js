import VueDatePicker from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css'


export default defineNuxtPlugin(async (nuxtApp) => {
    nuxtApp.vueApp
        .component('VueDatePicker', VueDatePicker)
})