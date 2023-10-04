// Los services conectan el frontend con los endpoints del backend Laravel
import { http } from "./Http.js";

export default {
	index() {
		return http().get("/task");
	},

	save(datos) {
		return http().post("/task", datos);
	},

	show(id) {
		return http().get(`/task/${id}`);
	},

	update(datos, id) {
		return http().put(`/task/${id}`, datos);
	},

	delete(id) {
		return http().delete(`/task/${id}`);
	}

}