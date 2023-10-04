<template>
	<div class="card" v-if="perfil">
		<h1>This is an about page</h1>
		<h2>CORREO: {{ perfil.email }}</h2>
		<h2>NOMBRE: {{ perfil.name }}</h2>
	</div>
</template>

<script setup>
	import { ref } from "vue";
	import authService from "../services/auth.service";

	const perfil = ref(null);

	// Obtenemos el perfil
	async function funPerfil() {
		const { data } = await authService.getPerfil();
		perfil.value = data;
	}

	funPerfil();
</script>

<style>
	@media (min-width: 1024px) {
		.about {
			min-height: 100vh;
			display: flex;
			align-items: center;
		}
	}
</style>
