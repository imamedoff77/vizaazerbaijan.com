import {defineStore} from 'pinia'

export const useCountries = defineStore('countries', {
    state: () => ({
        countries: [],
        eligibleCountries: []
    }),
    actions: {
        setCountries(data) {
            this.countries = data
        },
        setEligibleCoutries(data) {
            this.eligibleCountries = data
        }
    },
    getters: {
        getCountries: state => state.countries,
        getEligibleCountries: state => state.eligibleCountries,
        getCountry: state => id => state.countries.find(s => s.id == id),
        getEligibleCountry: state => id => state.eligibleCountries.find(s => s.id == id)
    },
})