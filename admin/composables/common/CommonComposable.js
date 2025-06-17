import {usePageHeader} from "~/composables/common/StatesComposable.js";

export const useValidateFile = () => {
    const validate = (file, types, fileMaxSize) => {
        const type = useFileExt(file.name)
        if (typeof file === 'undefined') {
            useErrors('Fayl seçilmədi')
        } else if (!types.includes(type)) {
            useErrors('Seçilən faylın yüklənməsinə icazə verilmir')
        } else if (file.size > fileMaxSize * 1024 * 1024) {
            useErrors('Fayl ölçüsü çox böyükdür')
        } else {
            useSuccess('Fayl seçildi')
            return true
        }
        return false
    }
    return {validate}
}
export const usePageMeta = (title, links) => {
    if (process.server) return
    useHead({
        title
    })

    const pageHeader = usePageHeader()
    pageHeader.value = {
        title,
        links
    }

    return {title}
}
export const useVisaStatuses = () => {
    const statuses = [
        {
            key: 1,
            case: 'PAYMENT_PENDING',
            value: 'Ödəniş gözləyir',
            className: 'text-secondary'
        },
        {
            key: 2,
            case: 'AWAITING_APPROVAL',
            value: 'Təsdiq gözləyir',
            className: 'text-warning'
        },
        {
            key: 3,
            case: 'CANCELLED',
            value: 'Rədd edilib',
            className: 'text-danger'
        },
        {
            key: 4,
            case: 'COMPLETED',
            value: 'Tamamlanıb',
            className: 'text-success'
        },
    ]

    const getStatus = key => statuses.find(t => t.key == key)

    const getStatusByCase = caseName => statuses.find(s => s.case == caseName)


    return {statuses, getStatusByCase, getStatus}
}
