import {usePageMeta} from "~/composables/common/CommonComposable.js";
import {useDynamicFetch} from "~/utils/custom.js";

export const useUserPage = () => {
    usePageMeta(
        'Adminlər'
    )
}

export const useUserList = () => {
    const users = ref({})
    const selectedUser = ref({})
    const freshUser = {
        name: null,
        surname: null,
        new_password: null,
        email: null,
        status: 'simple'
    }

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
                name: 'User',
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

    const selectUser = user => selectedUser.value = {...user}

    const getUsers = async () => {
        const data = await useDynamicFetch(fetchOptions)
        users.value = {...data?.users}
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

    watch(fetchOptions.models[0], () => getUsers(), {deep: true})

    onMounted(() => {
        if (process.client) {
            getUsers()
        }
    })

    const removeUser = userId => {
        const index = users.value.data.findIndex(v => v.id == userId)
        if (index > -1) {
            users.value.data.splice(index, 1)
        }
    }

    const askRemove = userId => {
        useSwal.fire({
            title: `Bu admini silmək istədiyinizə əminsiniz ?`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Bəli',
            denyButtonText: 'Xeyr',
            icon: 'warning'
        }).then(result => {
            if (result.isConfirmed) {
                useAxios()
                    .delete(`users/${userId}`)
                    .then(res => {
                        if (res.data.success) {
                            useSuccess(res.data.message)
                            removeUser(userId)
                        }
                    })
                    .catch(err => useErrors(err))
            }
        })
    }

    const updateUser = user => {
        const index = users.value.data.findIndex(u => u.id == user.id)
        if (index > -1) {
            users.value.data[index] = user
        }
    }

    const pushUser = user => users.value.data.unshift(user)

    const save = () => {
        useAxios()
            .post('users', selectedUser.value)
            .then(res => {
                if (res.data.success) {
                    useSuccess(res.data.message)
                    selectedUser.value?.id ? updateUser(res.data.user) : pushUser(res.data.user)
                    useModal('user_save_modal', false)
                }
            })
            .catch(err => useErrors(err))
    }


    return {
        users,
        filters,
        pagination,
        onSort,
        onPage,
        selectUser,
        selectedUser,
        askRemove,
        freshUser,
        save
    }
}