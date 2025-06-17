// https://nuxt.com/docs/api/configuration/nuxt-config
const backendUrl = 'http://localhost:8000'
const frontUrl = 'http://localhost:3000'

export default defineNuxtConfig({
    compatibilityDate: '2024-11-01',
    devtools: {enabled: true},
    app: {
        head: {
            meta: [
                {name: 'viewport', content: 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'}
            ],
            title: 'Visa',
            link: [
                {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'},
                {
                    rel: 'stylesheet',
                    href: '/assets/common/nprogress/nprogress.min.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/common/sweetalert2/sweetalert2.min.css'
                },
                {
                    rel: 'stylesheet',
                    href: 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap'
                },
                {
                    rel: 'stylesheet',
                    href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/common/bootstrap/css/bootstrap.min.css'
                },
                {
                    rel: 'stylesheet',
                    href: '/assets/custom/css/style.css'
                }
            ],
            script: [
                {
                    src: '/assets/common/jquery/jquery-3.7.1.min.js'
                },
                {
                    src: '/assets/common/bootstrap/js/bootstrap.bundle.min.js'
                },
                {
                    src: '/assets/custom/js/temp.js'
                }
            ]
        }
    },
    modules: [
        '@pinia/nuxt',
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
                'tree',
                'carousel'
            ]
        }
    },
    runtimeConfig: {
        public: {
            frontUrl,
            backendUrl,
            baseURL: backendUrl + '/api/',
            apiUrl: backendUrl + '/api/',
            phone: '+994515772877',
            mail: 'applications@vizaazerbaijan.com',
            reCapthcaSiteKey: '6LeBwzQrAAAAAM30eekGH2q2KNK43ZKJGxgFdsgw'
        },
    },
    devServer: {
        port: 3000
    },
})