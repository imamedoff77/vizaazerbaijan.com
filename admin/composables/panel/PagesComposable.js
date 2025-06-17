import {usePageMeta, useValidateFile} from "~/composables/common/CommonComposable.js";
import {useDynamicFetch} from "~/utils/custom.js";
import slugify from "slugify";
import {CreatePageValidation, UpdatePageValidation} from "~/validations/panel/PagesValidation.js";


// Pages
export const usePagesPage = () => {
    usePageMeta(
        'Səhifələr',
    )
}

export const useCreatePage = () => {
    usePageMeta(
        'Səhifə əlavə et',
        [
            {
                title: 'Səhifələr',
                link: '/pages'
            }
        ]
    )
}

export const useUpdatePage = async () => {
    const {id} = useRoute().params
    const {data} = await useAsyncData('get_page_detail', async () => await useAxios()
        .get('pages/' + id)
        .then(res => res.data?.page))
        .catch(err => useErrors(err))

    usePageMeta(
        'Səhifəyə düzəliş et',
        [
            {
                title: 'Səhifələr',
                link: '/pages'
            }
        ]
    )

    return data.value
}


// Functionality
export const usePageList = () => {
    const pages = ref({})

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
                name: 'Page',
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


    const getPages = async () => {
        const data = await useDynamicFetch(fetchOptions)
        pages.value = {...data?.pages}
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

    watch(fetchOptions.models[0], () => getPages(), {deep: true})

    onMounted(() => {
        if (process.client) {
            getPages()
        }
    })

    const removePage = pageId => {
        const index = pages.value.data.findIndex(v => v.id == pageId)
        if (index > -1) {
            pages.value.data.splice(index, 1)
        }
    }

    const askRemove = userId => {
        useSwal.fire({
            title: `Bu səhifəni silmək istədiyinizə əminsiniz ?`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Bəli',
            denyButtonText: 'Xeyr',
            icon: 'warning'
        }).then(result => {
            if (result.isConfirmed) {
                useAxios()
                    .delete(`pages/${userId}`)
                    .then(res => {
                        if (res.data.success) {
                            useSuccess(res.data.message)
                            removePage(userId)
                        }
                    })
                    .catch(err => useErrors(err))
            }
        })
    }


    return {
        pages,
        filters,
        pagination,
        onSort,
        onPage,
        askRemove,
    }
}

export const usePageForm = (pageData = {}) => {

    const page = ref({
        list_title: '',
        page_title: '',
        description: '',
        slug: '',
        keywords: [],
        new_og_image: null,
        og_image: null,
        block1: {
            title: null,
            image: null,
            new_image: null,
            points: ['']
        },
        block2: {
            title: null,
            image: null,
            new_image: null,
            points: ['']
        }
    })

    if (!useEmpty(pageData)) {
        page.value = {...pageData}
    }

    const activeTab = ref(0)
    const setActiveTab = index => activeTab.value = index

    const selectFile = (e, type) => {
        const file = e.target.files[0]
        const allowedContentTypes = ['png', 'webp', 'gif', 'jpg', 'jpeg']
        const maxFileSize = 10
        const {validate} = useValidateFile()

        if (validate(file, allowedContentTypes, maxFileSize)) {
            if (type == 'og_image') {
                const reader = new FileReader();
                reader.onload = e => page.value.og_image = e.target.result
                if (typeof file != "undefined") {
                    reader.readAsDataURL(file);
                }
                page.value.new_og_image = file
            } else if (type == 'block1_image') {
                const reader = new FileReader();
                reader.onload = e => page.value.block1.image = e.target.result
                if (typeof file != "undefined") {
                    reader.readAsDataURL(file);
                }
                page.value.block1.new_image = file
            } else if (type == 'block2_image') {
                const reader = new FileReader();
                reader.onload = e => page.value.block2.image = e.target.result
                if (typeof file != "undefined") {
                    reader.readAsDataURL(file);
                }
                page.value.block2.new_image = file
            }
        }
    }
    const submit = async () => {
        const validated = page.value?.id ? await UpdatePageValidation(page.value) : await CreatePageValidation(page.value)
        if (validated) {
            const formData = new FormData()
            if (page.value?.id) {
                formData.append('id', page.value.id)
            }
            formData.append('list_title', page.value.list_title)
            formData.append('page_title', page.value.page_title)
            formData.append('description', page.value.description)
            formData.append('slug', page.value.slug)
            formData.append('keywords', JSON.stringify(page.value.keywords))
            if (page.value?.new_og_image) {
                formData.append('new_og_image', page.value.new_og_image)
            }
            formData.append('block1_title', page.value.block1.title)
            formData.append('block1_points', JSON.stringify(page.value.block1.points))
            if (page.value.block1?.new_image) {
                formData.append('block1_image', page.value.block1.new_image)
            }
            formData.append('block2_title', page.value.block2.title)
            formData.append('block2_points', JSON.stringify(page.value.block2.points))
            if (page.value.block2?.new_image) {
                formData.append('block2_image', page.value.block2.new_image)
            }

            const postUrl = page.value?.id ? 'pages/' + page.value.id : 'pages'

            useAxios()
                .post(postUrl, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    if (res.data.success) {
                        useSuccess(res.data.message)
                    }
                })
                .catch(err => useErrors(err))
        }
    }

    watch(
        () => page.value.list_title,
        () => {
            page.value.slug = slugify(page.value.list_title, {
                lower: true
            })
        }
    )

    return {
        activeTab,
        setActiveTab,
        submit,
        page,
        selectFile
    }
}