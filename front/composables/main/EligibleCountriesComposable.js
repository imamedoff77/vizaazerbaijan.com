import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useEligibleCountriesMeta = () => {
    const title = 'Eligible Countries for Azerbaijan Visa: See If You Qualify'
    const description = 'Find out if your country is eligible for an Azerbaijan visa. Explore our list of eligible countries and learn more about the visa requirements for travelers planning to visit Azerbaijan.'

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
                href: '/assets/custom/css/pages/eligible-countries.css'
            }
        ]
    })
}