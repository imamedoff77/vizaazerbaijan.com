import {defineStore} from 'pinia'

export const useNotifications = defineStore('notifications', {
    state: () => ({
        unRead: 0
    }),
    actions: {
        setUnRead(data) {
            this.unRead = data
        },
        decUnRead() {
            this.unRead--
        }
    },
    getters: {
        getUnRead: state => state.unRead,
    },
})