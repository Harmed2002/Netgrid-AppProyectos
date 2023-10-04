import axios from "axios";

const url_base = "http://127.0.0.1:8000/api";

export const http = () => {
    let token = localStorage.getItem("access_token");

    const api = axios.create({
        baseURL: url_base,
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    });

    // Interceptar errores 401, 403
    api.interceptors.response.use(
        (response) => {
            return response;
        },
        (error) => {
            if (error.response.status === 401) {            // Error Unauthorized
                localStorage.removeItem("access_token");    // Removemos el valor access_token
                window.location = "/login";                 // Redirecciono al login
            }

            if (error.response.status === 403) {    // error Forbidden
                // validar roles
            }

            return Promise.reject(error);   // Dejo que siga su camino con el mismo código de error que trae
        }
    )

    return api;
}