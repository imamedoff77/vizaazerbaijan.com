import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useCookiesMeta = () => {
    const title = `Cookie Policy: How We Use Cookies on Our Website`
    const description = `Learn about our cookie policy and how we use cookies to enhance your experience on our website. Understand the types of cookies we use and how you can manage your preferences.`

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
