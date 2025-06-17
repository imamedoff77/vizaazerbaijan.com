import {string, object, array, mixed, number} from "yup";
import {SchemaValidate} from "~/validations/SchemaValidate.js";

const CreateSchema = () => {
    return object({
        list_title: string()
            .required('List title yazılmadı'),
        page_title: string()
            .required('Page title yazılmadı'),
        description: string()
            .required('Description yazılmadı'),
        keywords: array()
            .of(string())
            .min(1, 'Ən az 1 açar söz əlavə edilməlidir')
            .required(),
        slug: string()
            .required('Slug yazılmadı'),
        new_og_image: mixed()
            .required('Og image seçilmədi'),
        block1: object({
            title: string()
                .required('Blok 1 title yazılmadı'),
            new_image: mixed()
                .required('Blok 1 şəkli seçilmədi'),
            points: array()
                .of(string())
                .min(1, 'Blok 1 üçün ən az 1 point yazılmalıdır')
                .required()
        }),
        block2: object({
            title: string()
                .required('Blok 2 title yazılmadı'),
            new_image: mixed()
                .required('Blok 2 şəkli seçilmədi'),
            points: array()
                .of(string())
                .min(1, 'Blok 1 üçün ən az 1 point yazılmalıdır')
                .required()
        })
    })
}
const UpdateSchema = () => {
    return object({
        id: number()
            .required('İd göndərilməyib'),
        list_title: string()
            .required('List title yazılmadı'),
        page_title: string()
            .required('Page title yazılmadı'),
        description: string()
            .required('Description yazılmadı'),
        keywords: array()
            .of(string())
            .min(1, 'Ən az 1 açar söz əlavə edilməlidir'),
        slug: string()
            .required('Slug yazılmadı'),
        new_og_image: mixed()
            .notRequired(),
        block1: object({
            title: string()
                .required('Blok 1 title yazılmadı'),
            new_image: mixed()
                .notRequired(),
            points: array()
                .of(string())
                .min(1, 'Blok 1 üçün ən az 1 point yazılmalıdır')
        }),
        block2: object({
            title: string()
                .required('Blok 2 title yazılmadı'),
            new_image: mixed()
                .notRequired(),
            points: array()
                .of(string())
                .min(1, 'Blok 1 üçün ən az 1 point yazılmalıdır')
        })
    })
}


export const CreatePageValidation = async data => await SchemaValidate(CreateSchema, data)
export const UpdatePageValidation = async data => await SchemaValidate(UpdateSchema, data)
