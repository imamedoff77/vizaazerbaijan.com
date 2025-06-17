export const useGetCountries = async () => {
    const {data} = await useAsyncData('get_countries', async () => {
        let countries = []
        await useAxios().get(`common/countries`)
            .then(res => countries = res.data?.countries)
            .catch(err => useErrors(err))
        return countries
    })
    return data.value
}