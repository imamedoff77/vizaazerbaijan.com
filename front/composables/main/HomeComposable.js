import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useHomeMeta = () => {

    const title = 'Apply for an Azerbaijan Visit Visa: Simple and Quick Process'
    const description = 'Planning to visit Azerbaijan? Learn how to easily apply for an Azerbaijan visit visa. Our step-by-step guide ensures a smooth and efficient visa application process for travelers.'

    useMetaData({
        title,
        description
    })

    useHead({
        link: [
            {
                rel: 'stylesheet',
                href: '/assets/custom/css/pages/home.css'
            }
        ]
    })
}