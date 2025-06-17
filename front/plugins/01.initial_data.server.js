import {useServices} from "../store/services.js";
import {useCountries} from "~/store/countries.js";
import {usePages} from "~/store/pages.js";

export default defineNuxtPlugin(async (nuxtApp) => {
    const services = useServices()
    const countryStore = useCountries()
    const pagesStore = usePages()

    if (process.server && useEmpty(services.all)) {
        const fetchOptions = {
            models: [
                {
                    name: 'Service',
                    fetchOptions: {
                        type: 'get'
                    }
                },
                {
                    name: 'Country',
                    fetchOptions: {
                        type: 'get'
                    },
                    query: {
                        sort: {
                            field: 'name',
                            dir: 'asc'
                        }
                    }
                },
                {
                    name: 'EligibleCountry',
                    fetchOptions: {
                        type: 'get'
                    },
                    query: {
                        sort: {
                            field: 'name',
                            dir: 'asc'
                        }
                    }
                },
                {
                    name: 'Page',
                    fetchOptions: {
                        type: 'get'
                    },
                }
            ]
        }


        const data = await useAxios()
            .post('common/dynamic-fetch', fetchOptions)
            .then(res => res.data.data)
            .catch(err => console.log('initial err', err))

        if (!data) {
            throw createError({
                message: 'An Error Occured',
                statusCode: 404
            })
        } else {
            if (data?.services) {
                services.set(data.services)
            }
            if (data?.countries) {
                countryStore.setCountries(data.countries)
            }
            if (data?.eligible_countries) {
                countryStore.setEligibleCoutries(data.eligible_countries)
            }
            if (data?.pages) {
                pagesStore.set(data.pages)
            }
        }
    }
})