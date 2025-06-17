import {usePageMeta} from "~/composables/common/CommonComposable.js";
import {useDynamicFetch} from "~/utils/custom.js";
import {useNotifications} from "~/store/notifications.js";

export const useContactPage = () => {
    usePageMeta(
        'Contact messages'
    )
}

export const useContactList = () => {
    const messages = ref({})
    const selectedMessage = ref({})
    const selectedMessages = ref([])

    const filters = reactive({
        search: {
            query: '',
            for: 'id'
        },
    })

    const pagination = reactive({
        page: 1,
        perPage: 10,
        type: 'paginate',
    })

    const fetchOptions = reactive({
        models: [
            {
                name: 'ContactMessage',
                fetchOptions: {
                    ...pagination
                },
                query: {
                    sort: {
                        field: 'id',
                        dir: 'desc'
                    },
                }
            }
        ]
    })

    const selectMessage = message => {
        selectedMessage.value = {...message, read_at: new Date()}
        if (!message.read_at) {
            readMessage()
        }
    }

    const getMessages = async () => {
        const data = await useDynamicFetch(fetchOptions)
        messages.value = {...data?.contact_messages}
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

        fetchOptions.models[0].query.where = where
        if (pagination.page > 1) {
            pagination.page = 1
            fetchOptions.models[0].fetchOptions = {...pagination}
        }
    }, {deep: true})

    watch(fetchOptions.models[0], () => getMessages(), {deep: true})

    onMounted(() => {
        if (process.client) {
            getMessages()
        }
    })

    const updateRead = message => {
        const index = messages.value.data.findIndex(v => v.id == message.id)
        if (index > -1) {
            messages.value.data[index].read_at = message.read_at
            useNotifications().decUnRead()
        }
    }

    const readMessage = () => {
        useAxios(false)
            .post(`contact/${selectedMessage.value.id}`)
            .then(res => {
                if (res.data.success) {
                    updateRead(res.data.contact_message)
                }
            })
            .catch(err => useErrors(err))
    }

    const removeMessage = messageId => {
        const index = messages.value.data.findIndex(v => v.id == messageId)
        if (index > -1) {
            messages.value.data.splice(index, 1)
        }
    }

    const askRemove = messageId => {
        useSwal.fire({
            title: `Bu mesajı silmək istədiyinizə əminsiniz ?`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Bəli',
            denyButtonText: 'Xeyr',
            icon: 'warning'
        }).then(result => {
            if (result.isConfirmed) {
                useAxios()
                    .delete(`contact/${messageId}`)
                    .then(res => {
                        if (res.data.success) {
                            useSuccess(res.data.message)
                            removeMessage(messageId)
                        }
                    })
                    .catch(err => useErrors(err))
            }
        })
    }


    const askBulkRemove = () => {
        useSwal.fire({
            title: `Seçilən ${selectedMessages.value.length} mesajı silmək istədiyinizə əminsiniz ?`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Bəli',
            denyButtonText: 'Xeyr',
            icon: 'warning'
        }).then(result => {
            if (result.isConfirmed) {
                useAxios()
                    .post(`contact/bulk-delete`, {
                        messageList: selectedMessages.value
                    })
                    .then(res => {
                        if (res.data.success) {
                            useSuccess(res.data.message)
                            getMessages()
                            selectedMessages.value = []
                        }
                    })
                    .catch(err => useErrors(err))
            }
        })
    }

    return {
        messages,
        filters,
        pagination,
        onSort,
        onPage,
        selectMessage,
        selectedMessage,
        askRemove,
        selectedMessages,
        askBulkRemove
    }
}