import {defineStore} from 'pinia'

export const usePages = defineStore('pages', {
    state: () => ({
        pages: []
    }),
    actions: {
        set(data) {
            this.pages = data
        }
    },
    getters: {
        all: state => state.pages,
        getBySlug: state => slug => state.pages.find(s => s.slug == slug),
    },
})