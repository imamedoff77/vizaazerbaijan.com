import {useServices} from "~/store/services.js";
import {serviceFormValidation} from "~/validations/ServiceFormValidation.js";
import {useCountries} from "~/store/countries.js";
import {useMetaData} from "~/composables/common/CommonComposable.js";

export const useServicePage = () => {
    const route = useRoute()
    const service = useServices().getBySlug(route.params.slug)
    if (!useEmpty(service)) {
        const description = 'Wondering about the status of your Azerbaijan visa? Easily track your visa application progress with our simple and quick status check tool. Stay updated on your visa approval.'

        useMetaData({
            title: service.title,
            description
        })
    }

    useHead({
        title: useEmpty(service) ? 'Service' : service.title,
        bodyAttrs: {
            class: 'layout-2'
        },
        link: [
            {
                rel: 'stylesheet',
                href: '/assets/custom/css/pages/services.css'
            }
        ]
    })

    return {
        service,
        countries: useCountries().getCountries,
        eligibleCountries: useCountries().getEligibleCountries
    }
}

export const useServiceForm = service => {
    const router = useRouter()

    const steps = reactive({
        current: 1,
        // total: 4,
        total: 3,
        next: () => {
            if (steps.current < steps.total) {
                steps.current++;
            }
        },
        prev: () => {
            if (steps.current > 1) {
                steps.current--;
            }
        }
    });

    const form = reactive({
        service_id: service.id,
        nationality: null,
        travel_document: null,
        purpose: null,
        arrival_date: null,
        surname: null,
        given_name: null,
        birthday: null,
        country_of_birth: null,
        place_of_birth: null,
        sex: null,
        occupation: null,
        phone_number: null,
        address: null,
        email: null,
        passport_file: null,
        passport_issue_date: null,
        passport_expire_date: null,
        address_in_azerbaijan: null,
        terms: false,
        'g-recaptcha-response': null
    })

    const submit = async () => {
        const validated = await serviceFormValidation(form)
        if (validated) {
            const formData = new FormData()

            formData.append('service_id', form.service_id)
            formData.append('nationality', form.nationality)
            formData.append('travel_document', form.travel_document)
            formData.append('purpose', form.purpose)
            formData.append('arrival_date', form.arrival_date.toISOString())
            formData.append('surname', form.surname)
            formData.append('given_name', form.given_name)
            formData.append('birthday', form.birthday.toISOString())
            formData.append('country_of_birth', form.country_of_birth)
            formData.append('place_of_birth', form.place_of_birth)
            formData.append('sex', form.sex)
            formData.append('occupation', form.occupation)
            formData.append('phone_number', form.phone_number)
            formData.append('address', form.address)
            formData.append('email', form.email)
            formData.append('passport_file', form.passport_file)
            formData.append('passport_issue_date', form.passport_issue_date.toISOString())
            formData.append('passport_expire_date', form.passport_expire_date.toISOString())
            formData.append('address_in_azerbaijan', form.address_in_azerbaijan)
            formData.append('g-recaptcha-response', form['g-recaptcha-response'])

            useAxios()
                .post('main/visa', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    if (res.data.success) {
                        router.push('/thank-you')
                    }
                })
                .catch(err => useErrors(err))
        }
    }

    return {
        steps,
        form,
        submit
    }
}