import {defineStore} from 'pinia'

export const useServices = defineStore('services', {
    state: () => ({
        services: []
    }),
    actions: {
        set(data) {
            this.services = data
        }
    },
    getters: {
        all: state => state.services,
        getBySlug: state => slug => state.services.find(s => s.slug == slug),
    },
})