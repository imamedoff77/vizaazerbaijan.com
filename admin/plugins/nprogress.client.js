import NProgress from 'nprogress';

export default defineNuxtPlugin((nuxtApp) => {
    const router = useRouter();

    router.beforeEach((to, from, next) => {
        NProgress.start();
        next();
    });

    router.afterEach(() => {
        NProgress.done();
    });
});
