// https://nuxt.com/docs/api/configuration/nuxt-config
const backendUrl = 'http://127.0.0.1:8000'
const frontUrl = 'http://localhost:3000'
const adminUrl = 'http://localhost:3001'

export default defineNuxtConfig({
    compatibilityDate: '2024-11-01',
    devtools: {enabled: true},
    app: {
        head: {
            title: 'Visa | Admin Panel',
            htmlAttrs: {
                dir: 'ltr',
                'data-startbar': 'dark',
                'data-bs-theme': 'light'
            },
            link: [
                {
                    rel: 'stylesheet', href: '/assets/custom/css/nprogress.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/temp/css/sweetalert2.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/temp/css/bootstrap.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/temp/css/icons.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/temp/css/app.css'
                },
            ],
        }
    },
    modules: [
        '@pinia/nuxt',
        '@sidebase/nuxt-auth',
        '@primevue/nuxt-module'
    ],
    primevue: {
        autoImport: false,
        usePrimeVue: true,
        importTheme: {from: '~/public/assets/custom/primevue/theme.js'},
        components: {
            include: [
                'select',
                'multiselect',
                'datatable',
                'column',
                'columngroup',
                'row',
                'paginator',
            ]
        }
    },
    auth: {
        globalAppMiddleware: true,
        baseURL: backendUrl + '/api/auth',
        provider: {
            type: 'local',
            pages: {
                login: '/',
            },
            endpoints: {
                signIn: {path: '/admin', method: 'post'},
                signOut: {path: '/admin/logout', method: 'get'},
                getSession: {path: '/admin/check', method: 'get'}
            },
            token: {
                signInResponseTokenPointer: '/token',
                maxAgeInSeconds: 2592000 // 30 gun
            },
        },
    },
    runtimeConfig: {
        public: {
            backendUrl,
            frontUrl,
            adminUrl,
            baseURL: backendUrl + '/api/',
            apiUrl: backendUrl + '/api/admin/',
            siteName: 'Visa',
        },
    },
    devServer: {
        port: 3001
    },
    vite: {
        build: {
            sourcemap: false, // Sourcemap-ləri tamamilə deaktiv et
        },
        css: {
            devSourcemap: false, // CSS üçün source map-ləri deaktiv et
        },
    }
})
