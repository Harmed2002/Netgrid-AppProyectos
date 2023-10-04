// Los services conectan el frontend con los endpoints del backend Laravel
import { http } from "./Http.js";

export default {
    index(page = 1, limit = 10) {
        return http().get(`/project?page=${page}&limit=${limit}`);
    },
    // index() {
    //     return http().get("/project");
    // },

    save(datos) {
        return http().post("/project", datos);
    },

    show(id) {
        return http().get(`/project/${id}`);
    },

    update(datos, id) {
        return http().put(`/project/${id}`, datos);
    },

    delete(id) {
        return http().delete(`/project/${id}`);
    }

}