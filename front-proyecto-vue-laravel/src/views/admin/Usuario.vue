<template>
    <div class="card">
        <h1>Usuarios</h1>
        <DataTableComponent :data="usuarios" :columns="columnas" />
    </div>
    <!-- TODO: Terminar el crud -->
</template>

<script setup>
    import DataTableComponent from '../../components/admin/DataTableComponent.vue';
    import usuarioService from '../../services/usuario.service';
    import { ref, onMounted } from 'vue';

    const usuarios = ref([]);
    const columnas = [
        {"label": "Id", "key": "id"},
        {"label": "Nombre", "key": "name"},
        {"label": "Email", "key": "email"}
    ]

    onMounted(() => {
        listaUsuarios();
    })

    const listaUsuarios = async () => {
        const { data } = await usuarioService.listar();
        usuarios.value = data;
    }
</script>