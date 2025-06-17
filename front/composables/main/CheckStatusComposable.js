import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useCheckStatusMeta = () => {
    const title = 'Check Your Azerbaijan Visa Status: Fast & Easy Tracking'
    const description = 'Wondering about the status of your Azerbaijan visa? Easily track your visa application progress with our simple and quick status check tool. Stay updated on your visa approval.'

    useMetaData({
        title,
        description
    })

    useHead({
        bodyAttrs: {
            class: 'layout-2'
        },
        link: [
            {
                rel: 'stylesheet',
                href: '/assets/custom/css/pages/check-status.css'
            }
        ]
    })
}

export const useCheckStatusForm = () => {
    const visa = ref({})

    const request = reactive({
        application_number: null,
        email: null,
        'g-recaptcha-response': null
    })

    const submit = () => {
        useAxios()
            .post('main/visa/check-status', request)
            .then(res => {
                if (res.data.success) {
                    visa.value = res.data.visa
                    useModal('view-visa-modal')
                }
            })
            .catch(err => useErrors(err))
    }

    const handleLoadCallback = token => request['g-recaptcha-response'] = token


    return {
        visa,
        request,
        submit,
        handleLoadCallback
    }
}