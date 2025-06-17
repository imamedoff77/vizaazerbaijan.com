export const useLogout = () => {
    const {signOut} = useAuth()

    const logout = async () => {
        useLoading()
        try {
            await signOut({callbackUrl: '/', redirect: true})
        } catch (e) {
            useErrors(e)
        } finally {
            useLoading(false)
        }
    }

    return {logout}
}