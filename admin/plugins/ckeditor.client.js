import CKEditor from "@ckeditor/ckeditor5-vue";
import FullFreeBuildEditor from '@blowstack/ckeditor5-full-free-build'

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.use(CKEditor);
    return {
        provide: {
            ckeditor: {
                customEditor: FullFreeBuildEditor,
            },
        },
    };
});