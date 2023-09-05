import profile from '../api/user/profile';
import update from '../api/user/update';
import { ref } from 'vue';

class User {
    static user = ref(null);

    static async isAuth() {
        let user = await User.getUser();
        return user !== null;
    }

    static getProfile(){
        let url = "api/me";
        var xhr = new XMLHttpRequest();

        xhr.open("GET", url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json");
        xhr.send();
 
        if (xhr.status === 200) {
            let res =  JSON.parse(xhr.responseText);
            console.log(res);
            return res;
        }else{
            window.location.href = '/login';
        }

        return null;
    }

    static async getUser() {
        if(User.user.value !== null) {
            return User.user.value;
        }

        let response = await profile();
        if(response.status === 200) {
            User.user.value = response.data;
            return User.user.value;
        }

        return null;
    }

    static async update(data) {
        let response = await update(data);
        if(response.status === 200) {
            User.user.value = response.data;
            return User.user.value;
        }

        if(response.status === 422) {


            return response.data;
        }


        return null;
    }

}

export default User;