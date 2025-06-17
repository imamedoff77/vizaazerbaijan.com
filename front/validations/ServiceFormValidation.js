import {string, object, number, mixed} from "yup";
import {SchemaValidate} from "~/validations/SchemaValidate.js";

const serviceFormSchema = () => {
    return object({
        nationality: string()
            .required('Nationality is required'),
        travel_document: string()
            .required('Travel document is required'),
        purpose: string()
            .required('Purpose of visit is required'),
        arrival_date: mixed()
            .required('Arrival date is required'),
        surname: string()
            .notRequired(),
        given_name: string()
            .required('Given name is required'),
        birthday: mixed()
            .required('Date of birth is required'),
        country_of_birth: mixed()
            .required('Country of birth is required'),
        place_of_birth: mixed()
            .required('Place of birth is required'),
        sex: string()
            .required('Sex is required'),
        occupation: string()
            .required('Occupation is required'),
        phone_number: number()
            .typeError('Phone number must be a number')
            .required('Phone number is required'),
        address: string()
            .required('Address is required'),
        email: string()
            .email('Must be a valid email address')
            .required('Email is required'),
        passport_file: mixed()
            .required('Passport file is required'),
        passport_issue_date: mixed()
            .required('Passport issue date is required'),
        passport_expire_date: mixed()
            .required('Passport expiration date is required'),
        address_in_azerbaijan: string()
            .required('Address in Azerbaijan is required'),
    })
}


export const serviceFormValidation = async data => await SchemaValidate(serviceFormSchema, data)
