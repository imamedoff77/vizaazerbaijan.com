import {usePageMeta, useVisaStatuses} from "~/composables/common/CommonComposable.js";
import {useDynamicFetch} from "~/utils/custom.js";

// Pages
export const useVisaPage = async () => {
    usePageMeta(
        'Visa istəkləri'
    )
}


// Functions
export const useVisaList = () => {
    const requests = ref({})
    const {statuses} = useVisaStatuses()
    const selectedVisa = ref({})
    const selected = reactive({
        requests: []
    })

    const filters = reactive({
        search: {
            query: '',
            for: 'id'
        },
        statuses: [...statuses.map(k => k.key)]
    })

    const pagination = reactive({
        page: 1,
        perPage: 10,
        type: 'paginate',
    })

    const fetchOptions = reactive({
        models: [
            {
                name: 'VisaRequest',
                fetchOptions: {
                    ...pagination
                },
                query: {
                    sort: {
                        field: 'id',
                        dir: 'desc'
                    },
                    with: [{name: 'service'}, {name: 'rejected'}]
                }
            }
        ]
    })

    const selectVisa = visa => selectedVisa.value = {...visa, message: ''}

    const getVisaRequests = async () => {
        const data = await useDynamicFetch(fetchOptions)
        requests.value = {...data?.visa_requests}
    }

    const onSort = e => {
        fetchOptions.models[0].query.sort.field = e.sortField === 'index' ? 'id' : e.sortField
        fetchOptions.models[0].query.sort.dir = e.sortOrder === 1 ? 'desc' : 'asc'
    }

    const onPage = e => {
        pagination.page = parseInt(e.page) + 1
        pagination.perPage = e.rows
        fetchOptions.models[0].fetchOptions = {...pagination}
    }

    watch(filters, (newVal) => {
        const where = [
            {
                key: newVal.search.for,
                operator: 'like',
                val: `%${newVal.search.query}%`
            }
        ]

        if (filters.statuses.length > 0) {
            where.push({key: 'status', val: filters.statuses})
        }

        fetchOptions.models[0].query.where = where
        if (pagination.page > 1) {
            pagination.page = 1
            fetchOptions.models[0].fetchOptions = {...pagination}
        }
    }, {deep: true})

    watch(fetchOptions.models[0], () => getVisaRequests(), {deep: true})

    onMounted(() => {
        if (process.client) {
            getVisaRequests()
        }
    })

    const updateStatus = visa => {
        const index = requests.value.data.findIndex(v => v.id == visa.id)
        if (index > -1) {
            requests.value.data[index].status = visa.status
            if (visa.rejected) {
                requests.value.data[index].rejected = visa.rejected
            }
        }
    }

    const changeStatus = () => {
        useAxios()
            .post(`visa/${selectedVisa.value.id}`, selectedVisa.value)
            .then(res => {
                if (res.data.success) {
                    useSuccess(res.data.message)
                    updateStatus(res.data.visa)
                    useModal('change_status_modal', false)
                }
            })
            .catch(err => useErrors(err))
    }

    const removeVisa = visaId => {
        const index = requests.value.data.findIndex(v => v.id == visaId)
        if (index > -1) {
            requests.value.data.splice(index, 1)
        }
    }

    const askRemove = (visaId) => {
        useSwal.fire({
            title: `Bu visa istəyini silmək istədiyinizə əminsiniz ?`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Bəli',
            denyButtonText: 'Xeyr',
            icon: 'warning'
        }).then(result => {
            if (result.isConfirmed) {
                useAxios()
                    .delete(`visa/${visaId}`)
                    .then(res => {
                        if (res.data.success) {
                            useSuccess(res.data.message)
                            removeVisa(visaId)
                        }
                    })
                    .catch(err => useErrors(err))
            }
        })
    }

    const selectAll = () => selected.requests = requests.value.data.map(r => r.id)

    const unSelectAll = () => selected.requests = []

    const downloadExcel = () => {
        useAxios()
            .post('visa/excel', {
                requests: selected.requests
            }, {
                responseType: 'blob',
            })
            .then(res => {
                const url = window.URL.createObjectURL(new Blob([res.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'visa_requests.xlsx')
                document.body.appendChild(link)
                link.click()
                document.body.removeChild(link)
                unSelectAll()
            })
            .catch(err => useErrors(err))
    }

    return {
        requests,
        filters,
        pagination,
        onSort,
        onPage,
        selectVisa,
        selectedVisa,
        changeStatus,
        askRemove,
        selected,
        selectAll,
        unSelectAll,
        downloadExcel
    }
}
