export const useVisaStatuses = () => {
    const statuses = [
        {
            key: 1,
            case: 'PAYMENT_PENDING',
            value: 'Pending payment',
            className: 'text-secondary'
        },
        {
            key: 2,
            case: 'AWAITING_APPROVAL',
            value: 'Awaiting approval',
            className: 'text-warning'
        },
        {
            key: 3,
            case: 'CANCELLED',
            value: 'Cancelled',
            className: 'text-danger'
        },
        {
            key: 4,
            case: 'COMPLETED',
            value: 'Completed',
            className: 'text-success'
        },
    ]

    const getStatus = key => statuses.find(t => t.key == key)

    const getStatusByCase = caseName => statuses.find(s => s.case == caseName)


    return {statuses, getStatusByCase, getStatus}
}

export const useMetaData = (data = {title: '', description: ''}) => {
    const config = useRuntimeConfig().public
    const route = useRoute()

    const metaData = {
        title: data.title,
        ogTitle: data.title,
        description: data.description,
        ogDescription: data.description,
        keywords: (data?.keywords && data.keywords.length > 0) ? [...data.keywords] : ['azerbaijan visit visa'],
        ogImage: '',
        ogType: 'website',
        ogSiteName: config.frontUrl + '/',
        twitterCard: 'summary_large_image',
        twitterSite: config.frontUrl + '/',
        twitterCreator: config.frontUrl + '/',
        canonical: config.frontUrl + route.fullPath,
    }


    metaData.keywords = metaData.keywords.length > 0 ? metaData.keywords.join(', ') : metaData.keywords = metaData.keywords[0]

    useSeoMeta(metaData)
}