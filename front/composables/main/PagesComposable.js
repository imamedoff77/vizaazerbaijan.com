export const usePageDetail = async () => {
    const route = useRoute()
    const {slug} = route.params

    const {data} = await useAsyncData('get_page_detail', async () => {
        return await useAxios()
            .get('main/pages/' + slug)
            .then(res => res.data.page)
            .catch(err => useErrors(err))
    })

    useHead({
        link: [
            {
                rel: 'stylesheet',
                href: '/assets/custom/css/pages/page.css'
            }
        ]
    })

    return data.value
}