import {string, object} from "yup";
import {SchemaValidate} from "~/validations/SchemaValidate.js";

const schema = () => {

    return object({
        email: string()
            .email('E-mail adresinizi düzgün yazın')
            .required('E-mail yazılmadı'),
        password: string()
            .required('Şifrə yazılmadı'),
    })
}

export const LoginValidation = async data => await SchemaValidate(schema, data)
