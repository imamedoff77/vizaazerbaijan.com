import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useContactMeta = () => {
    const title = `Contact Us: We're Here to Help with Your Azerbaijan Visa Needs`
    const description = `questions or need assistance? Get in touch with our team for support with your Azerbaijan visa application. We're here to help guide you through the process smoothly and efficiently.`

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
                href: '/assets/custom/css/pages/contact.css'
            }
        ]
    })
}


export const useContactForm = () => {
    const router = useRouter()
    const message = reactive({
        name: null,
        email: null,
        message: null,
        application_number: null,
        'g-recaptcha-response': null
    })

    const submit = () => {
        useAxios()
            .post('main/contact', message)
            .then(res => {
                if (res.data.success) {
                    router.push('/thank-you')
                }
            })
            .catch(err => useErrors(err))
    }

    const handleLoadCallback = token => message['g-recaptcha-response'] = token

    return {
        message,
        submit,
        handleLoadCallback
    }
}
