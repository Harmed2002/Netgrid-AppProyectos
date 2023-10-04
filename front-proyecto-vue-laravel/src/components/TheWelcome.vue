<template>
	<div class="card">
		<h1>Mis Proyectos</h1>

		<!-- <DataTable
			sortMode="multiple" 
			ref="dt"
			:value="projects"
			:totalRecords="totalRecords"
			lazy
			:loading="loading"
			@page="onPage($event)"
			dataKey="id"
			:paginator="true"
			:rows="10"
			paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
			:rowsPerPageOptions="[3, 5, 10, 25]"
			currentPageReportTemplate="Mostrando {first} al {last} de {totalRecords} proyectos"
			responsiveLayout="scroll"
		>
			<Column field="id" header="Id"></Column>
			<Column field="title" header="Título"></Column>
			<Column field="description" header="Descripción"></Column>
			<Column field="start_date" header="Inicia"></Column>
			<Column field="end_date" header="Finaliza"></Column>
		</DataTable> -->
		<DataTable
			v-model:expandedRows="expandedRows"
			@rowExpand="onRowExpand" 
			@rowCollapse="onRowCollapse" 
			sortMode="multiple" 
			ref="dt"
			:value="projects"
			:totalRecords="totalRecords"
			lazy
			:loading="loading"
			@page="onPage($event)"
			dataKey="id"
			:paginator="true"
			:rows="10"
			paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
			:rowsPerPageOptions="[3, 5, 10, 25]"
			currentPageReportTemplate="Mostrando {first} al {last} de {totalRecords} proyectos"
			responsiveLayout="scroll"
		>
			<template #header>
                <div class="flex flex-wrap justify-content-end gap-2">
                    <Button text icon="pi pi-plus" label="Expandir Todo" @click="expandAll" />
                    <Button text icon="pi pi-minus" label="Collapsar Todo" @click="collapseAll" />
                </div>
            </template>
			<Column expander style="width: 5rem" />
			<Column field="id" header="Id" sortable></Column>
			<Column field="title" header="Título" sortable></Column>
			<Column field="description" header="Descripción"></Column>
			<Column field="start_date" header="Inicia" sortable></Column>
			<Column field="end_date" header="Finaliza" sortable></Column>
			<!-- Detalle -->
			<template #expansion="slotProps">
                <div class="p-3">
                    <h5>Tareas de {{ slotProps.data.title }}</h5>
                    <DataTable :value="slotProps.data.tasks">
                        <Column field="id" header="Id" sortable></Column>
                        <Column field="title" header="Title" sortable></Column>
                        <Column field="description" header="Descripción"></Column>
                        <Column field="status" header="Status" sortable>
                            <template #body="slotProps">
                                <Tag :value="slotProps.data.status" :severity="getSeverity(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </template>
		</DataTable>
	</div>
</template>

<script setup>
	// Importaciones
	import { ref, onMounted } from 'vue';
	import projectService from "../services/project.service";
	import { useToast } from 'primevue/usetoast';

	// Variables o estados reactivos
	const projects = ref([]);
	const dt = ref(null);
	const loading = ref(false) // gif de carga para lazy
	const lazyParams = ref({page: 0}); // Variable que escucha los cambios en la tabla
	const totalRecords = ref(0);
	const expandedRows = ref([]);
	const toast = useToast();

	// Métodos o funciones
	onMounted(() => {
		getProjects();
	});

	async function getProjects() {
		loading.value = true;
		let page = lazyParams.value.page + 1; // +1 x q comienza en page 0
		let limit = lazyParams.value.rows || 10; // Numero de registros por página

		const { data } = await projectService.index(page, limit);
		loading.value = false;
		projects.value = data.data;
		totalRecords.value = data.total;
	};

	const onRowExpand = (event) => {
		toast.add({ severity: 'info', summary: 'Projecto Expandido', detail: event.data.name, life: 3000 });
	};

	const onRowCollapse = (event) => {
		toast.add({ severity: 'success', summary: 'Projecto Collapsado', detail: event.data.name, life: 3000 });
	};

	const expandAll = () => {
		expandedRows.value = projects.value.filter((p) => p.id);
	};

	const collapseAll = () => {
		expandedRows.value = null;
	};

	const getSeverity = (task) => {
		switch (task.status) {
			case 'COMPLETADA':
				return 'success';

			case 'EN PROGRESO':
				return 'warning';

			case 'PENDIENTE':
				return 'danger';

			// default:
			// 	return null;
    	}
	};
</script>