export default defineNuxtRouteMiddleware(async () => {
    const {status, data} = useAuth()
    if (status.value !== 'authenticated' || data.value.status != 'super') {
        return navigateTo('/');
    }
});
