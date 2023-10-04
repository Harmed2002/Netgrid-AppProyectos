// Los services conectan el frontend con los endpoints del backend Laravel
import { http } from "./Http.js";

export default {
    listar() {
        return http().get("/usuario");
    },

    guardar(datos) {
        return http().post("/usuario", datos);
    },

    mostrar(id) {
        return http().get(`/usuario/${id}`);
    },

    modificar(datos, id) {
        return http().put(`/usuario/${id}`, datos);
    },

    eliminar(id) {
        return http().delete(`/usuario/${id}`);
    }

}