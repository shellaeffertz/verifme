class ApiHanlder {
    static async get(url, params) {
        if(params) {
            url += '?';
            for (const [key, value] of Object.entries(params)) {
                url += key + '=' + value + '&';
            }
        }

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json");

        xhr.send();
        let res =  JSON.parse(xhr.responseText);

        if (xhr.status === 200) {
            return {
                status: "success",
                statusCode: xhr.status,
                data: res
            }
        }
        return {
            status: "error",
            statusCode: xhr.status,
            data: res
        }
    }

    static async post(url, body) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json");
        xhr.send(JSON.stringify(body));
        let res =  JSON.parse(xhr.responseText);

        if (xhr.status === 200) {
            return {
                status: "success",
                statusCode: xhr.status,
                data: res
            }
        }

        return {
            status: "error",
            statusCode: xhr.status,
            data: res
        }
    }

    static async put(url, body) {
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json");
        xhr.send(JSON.stringify(body));
        let res =  JSON.parse(xhr.responseText);
        
        if (xhr.status === 200) {
            return {
                status: "success",
                statusCode: xhr.status,
                data: res
            }
        }

        return {
            status: "error",
            statusCode: xhr.status,
            data: res
        }
    }

    static async delete(url, body) {
        var xhr = new XMLHttpRequest();
        xhr.open("DELETE", url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json");
        xhr.send(JSON.stringify(body));
        let res =  JSON.parse(xhr.responseText);
        
        if (xhr.status === 200) {
            return {
                status: "success",
                statusCode: xhr.status,
                data: res
            }
        }

        return {
            status: "error",
            statusCode: xhr.status,
            data: res
        }
    }
}

export default ApiHanlder;