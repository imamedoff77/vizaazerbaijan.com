import {install} from "vue3-recaptcha-v2";

export default defineNuxtPlugin((nuxtApp) => {
    const config = useRuntimeConfig().public
    nuxtApp.vueApp.use(install, {
        sitekey: config.reCapthcaSiteKey,
        cnDomains: false,
    });
});