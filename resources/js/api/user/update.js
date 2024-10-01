import ApiHanlder from '../handler';
const update = async (data) => {
    const url = 'api/me';
    let response = await ApiHanlder.put(url, data);
    
    if (response.statusCode == 200) {
        return {
            error: false,
            status: "success",
            data: response.data
        }
    }

    if (response.statusCode == 422) {
        return {
            error: true,
            status: "error",
            errors: response.data.errors
        }
    }

    if (response.statusCode == 401) {
        window.location.href = '/login';
        return;
    }

    return {
        error: true,
        status: "error",
        errors: response.data
    }
}

export default update;