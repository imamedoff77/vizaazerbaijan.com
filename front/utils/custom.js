import moment from 'moment'
import each from 'lodash/each'
import isEmpty from 'lodash/isEmpty'
import Swal from 'sweetalert2'
import {usePageOverlay} from "~/composables/common/StatesComposable.js";

const showNotification = (msg, duration = 2000, type) => {
    if (process.client) {
        Swal.fire({
            html: msg,
            icon: type
        })
    }
};
export const useSuccess = (msg, duration = 2000) => showNotification(msg, duration)
export const useErrors = (err, duration = 2000) => {
    let message = '';
    let errors = []
    if (typeof err === 'string') {
        message = err
    } else {
        if (err?.response?._data?.errors) {
            errors = err.response._data.errors
        } else if (err?.response?.data?.errors) {
            errors = err?.response?.data?.errors
        }
        if (err?.response?.data?.message) {
            message = err?.response?.data?.message
        } else if (!useEmpty(errors)) {
            let i = 0
            each(errors, error => {
                i++
                if (i != 1) message += '<br> '
                message += `${i}) ${error[0]}`
            })
        } else if (err?.response?._data?.error) {
            message = err?.response?._data?.message
        }
    }
    console.log('err msg', message)
    showNotification(message, duration, 'error')
}
export const useEmpty = val => isEmpty(val)
export const useLoading = (action = true) => {
    const pageOverlay = usePageOverlay()
    pageOverlay.value = action
}
export const useModal = (modalId, action = true) => {
    const el = document.getElementById(modalId)
    if (el) {
        if (action) {
            const modal = new bootstrap.Modal(el)
            modal.show()
        } else {
            const modal = bootstrap.Modal.getInstance(el)
            modal.hide()
        }
    }
}
export const useFileUrl = path => useRuntimeConfig().public.backendUrl + '/' + path
export const useDateFormat = (date, withTime = false) => {
    let format = 'DD-MM-YYYY'
    if (withTime) {
        format += ' HH:mm'
    }
    return moment(date).format(format)
}
export const useCopyText = async (text) => {
    try {
        await navigator.clipboard.writeText(text);
        useSuccess('Copied')
    } catch (error) {
        console.log('copy error', error)
        useErrors('An error occurred')
    }
}
export const useCustomLink = link => link.endsWith('/') ? link : link + '/'