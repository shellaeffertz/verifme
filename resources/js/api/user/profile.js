import ApiHanlder from '../handler';
const profile = async () => {
    const url = 'api/me';
    let response = await ApiHanlder.get(url, null);
    if(response.status != "success") {
        window.location.href = '/login';
    }
    return response.data;
}


export default profile;