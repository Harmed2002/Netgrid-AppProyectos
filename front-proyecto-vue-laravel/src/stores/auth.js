import { ref, onMounted } from 'vue'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', () => {
	const auth = ref(false);
	const usuario = ref(null);

	onMounted(() => {
		if (!usuario.value) {
			usuario.value = localStorage.getItem("auth");
		}
	})

	const setUsuario = (name) => {
		usuario.value = name;
	}

	return { auth, usuario, setUsuario }
})
