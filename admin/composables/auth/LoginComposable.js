import {LoginValidation} from "~/validations/auth/LoginValidation.js";

export const useLoginMeta = () => {

    const pageTitle = 'Admin panel | Giriş'

    useHead({
        bodyAttrs: {
            class: 'bg-auth'
        },
        title: pageTitle
    })

    return {pageTitle}
}

export const useLoginForm = () => {

    const {signIn} = useAuth()


    const user = reactive({
        email: null,
        password: null,
        is_admin: true
    })

    const login = async () => {
        const validateUser = await LoginValidation(user)
        if (validateUser) {
            useLoading()
            try {
                await signIn(user, {callbackUrl: '/visa', redirect: true})
            } catch (e) {
                useErrors(e)
            } finally {
                useLoading(false)
            }
        }
    }

    return {user, login}
}