export const useDynamicFetchComposable = async (fetchOptions) => {
    return useAsyncData('get_dynamic_fetch_data', async () => {
        let fetchedData = {}
        await useAxios()
            .post('common/dynamic-fetch', fetchOptions)
            .then(res => fetchedData = res.data?.data)
            .catch(err => useErrors(err))
        return fetchedData
    })
}