import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useRequirementsMeta = () => {

    const title = 'Azerbaijan Visa Requirements: Everything You Need to Know'
    const description = 'Discover the complete list of requirements for applying for an Azerbaijan visa. Get detailed information on documents, eligibility, and the steps to ensure a successful application.'

    useMetaData({
        title,
        description
    })

    useHead({
        link: [
            {
                rel: 'stylesheet',
                href: '/assets/custom/css/pages/requirements.css'
            }
        ]
    })
}