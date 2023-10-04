<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    // {
    //     label: 'Home',
    //     items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/' }]
    // },
    {
        label: 'Administración',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/' },
            { label: 'Perfil', icon: 'pi pi-fw pi-id-card', to: '/about' }
        ]
    },
    {
        label: 'Gestión de Proyectos',
        items: [
            { label: 'Proyectos', icon: 'pi pi-fw pi-clone', to: '/project' },
            { label: 'Tareas', icon: 'pi pi-fw pi-box', to: '/task' },
        ]
    },
    {
        label: 'Gestión de Usuarios',
        items: [
            { label: 'Usuarios', icon: 'pi pi-fw pi-user', to: '/usuario' }
       ]
    }
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
