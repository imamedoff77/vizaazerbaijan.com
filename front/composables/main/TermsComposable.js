import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useTermsComposable = () => {
    const title = `Azerbaijan Visa Terms and Conditions: Important Information`
    const description = `Review the terms and conditions for applying for an Azerbaijan visa. Understand the rules, policies, and responsibilities involved in your visa application process to ensure a smooth experience.`

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
                href: '/assets/custom/css/pages/terms-cookies.css'
            }
        ]
    })
}
