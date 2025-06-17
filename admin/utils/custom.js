import moment from 'moment'
import each from 'lodash/each'
import isEmpty from 'lodash/isEmpty'
import Swal from 'sweetalert2'
import {usePageOverlay} from "~/composables/common/StatesComposable.js";
import DOMPurify from 'dompurify';


const showNotification = (msg, duration = 2000, type) => {
    if (process.client) {
        Swal.fire({
            text: msg,
            icon: type
        })
    }
};
export const useSuccess = (msg, duration = 2000) => showNotification(msg, duration)
export const useErrors = (err, duration = 2000) => {
    console.log('err', err)
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
    showNotification(message, duration, 'error')
}
export const useEmpty = val => isEmpty(val)
export const useSwal = Swal
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
export const useAvatar = () => '/assets/temp/images/users/avatar-6.jpg'
export const useFileSize = size => {
    if (size === 0) return "0 B";

    const units = ["B", "KB", "MB", "GB", "TB"];
    const index = Math.floor(Math.log(size) / Math.log(1024));
    const formattedSize = (size / Math.pow(1024, index)).toFixed(2);

    return `${formattedSize} ${units[index]}`;
}
export const useFileExt = name => name.split('.').pop().toLowerCase()
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
        useSuccess('Kopyalandı')
    } catch (error) {
        console.log('copy error', error)
        useErrors('Kopyalama zamanı xəta baş verdi')
    }
}
export const useTableIndex = (index = 0, {page = 1, perPage = 10}) => perPage * (page - 1) + parseInt(index) + 1
export const useCleanHtml = dirty => DOMPurify.sanitize(dirty)
export const stripTags = html => html.replace(/<\/?[^>]+(>|$)/g, "")
export const useDynamicFetch = async (fetchOptions) => {
    let fetchedData = {}
    await useAxios()
        .post('dynamic-fetch', fetchOptions)
        .then(res => fetchedData = res.data.data)
        .catch(err => useErrors(err))
    return fetchedData
}
export const useIsSuperAdmin = () => {
    const {status, data} = useAuth()
    if (status.value == 'authenticated' && data.value.status == 'super') {
        return true
    }
    return false
}