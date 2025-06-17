import {useCountries} from "~/store/countries.js";
import {useNotifications} from "~/store/notifications.js";


export default defineNuxtPlugin(async (nuxtApp) => {
    const countryStore = useCountries()
    const notificationStore = useNotifications()
    const {status} = useAuth()


    if (process.server && status.value == 'authenticated') {
        const fetchOptions = {
            models: [
                {
                    name: 'Country',
                    fetchOptions: {
                        type: 'get'
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
                    name: 'ContactMessage',
                    fetchOptions: {
                        type: 'count'
                    },
                    query: {
                        where: [
                            {key: 'read_at', val: null},
                        ]
                    }
                }
            ]
        }


        const data = await useAxios()
            .post('dynamic-fetch', fetchOptions)
            .then(res => res.data.data)
            .catch(err => console.log('initial err', err))

        if (!data) {
            throw createError({
                statusCode: 500,
                statusMessage: 'Initial Data Error'
            })
        } else {
            if (data?.countries) {
                countryStore.setCountries(data.countries)
            }
            if (data?.eligible_countries) {
                countryStore.setEligibleCoutries(data.eligible_countries)
            }
            if (data?.contact_messages) {
                notificationStore.setUnRead(data.contact_messages)
            }
        }
    }
})