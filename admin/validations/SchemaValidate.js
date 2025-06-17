export const SchemaValidate = async (schema, data) => {
    let errors = []

    try {
        await schema().validate(data)
    } catch (err) {
        errors = err.errors
        err.errors.forEach(e => useErrors(e))
    }
    return errors.length === 0
}