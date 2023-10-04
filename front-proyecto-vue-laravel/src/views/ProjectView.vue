<template>
	<div class="card">
		<h1>Mis Proyectos</h1>

		<Button label="Nuevo" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />

		<!-- Modal Crear/Actualizar proyecto -->
		<Dialog v-model:visible="visible" modal header="Proyecto" :style="{ width: '30vw' }" class="p-fluid">
			<div class="field">
				<label for="title">Título</label>
				<InputText id="title" v-model.trim="project.title" required="true" autofocus :class="{ 'p-invalid': submitted && !project.title }" />
				<small class="p-invalid" v-if="submitted && !project.title">El título es requerido.</small>
			</div>

			<div class="field">
				<label>Descripción</label>
				<Textarea v-model="project.description" rows="3" cols="30" />
			</div>

			<div class="formgrid grid">
				<div class="field col">
					<label>Fecha Inicio</label>
					<Calendar v-model="project.start_date" dateFormat="yy-mm-dd" showIcon :class="{ 'p-invalid': submitted && !project.start_date }" />
					<small class="p-invalid" v-if="submitted && !project.start_date">La fecha de inicio es requerida.</small>
				</div>
				<div class="field col">
					<label>Fecha Fin</label>
					<Calendar v-model="project.end_date" dateFormat="yy-mm-dd" showIcon :class="{ 'p-invalid': submitted && !project.end_date }" />
					<small class="p-invalid" v-if="submitted && !project.end_date">La fecha de fin es requerida.</small>
				</div>
			</div>

			<template #footer>
				<Button label="Cancelar" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
				<Button label="Guardar" icon="pi pi-check" class="p-button-text" @click="saveProject" />
			</template>
		</Dialog>

		<!-- Modal Borrar proyecto -->
		<Dialog v-model:visible="deleteProjectDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
			<div class="flex align-items-center justify-content-center">
				<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
				<span v-if="project">¿Está seguro de eliminar el projecto <b>{{ project.title }}</b>?</span>
			</div>
			<template #footer>
				<Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProjectDialog = false" />
				<Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteProject" />
			</template>
		</Dialog>

		<!-- <DataTable :value="projects" sortMode="multiple" tableStyle="min-width: 50rem"> -->
		<DataTable
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
			<Column field="title" header="Título" sortable></Column>
			<Column field="description" header="Descripción"></Column>
			<Column field="start_date" header="Inicia" sortable></Column>
			<Column field="end_date" header="Finaliza" sortable></Column>
			<Column header="Gestión">
				<template #body="slotProps">
					<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editProject(slotProps.data)" />
					<Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2" @click="confirmDeleteProject(slotProps.data)" />
				</template>
			</Column>
		</DataTable>
		<Toast />
	</div>
</template>

<script setup>
	// Importaciones
	import { ref, onMounted } from 'vue';
	import projectService from "../services/project.service";
	import { useToast } from 'primevue/usetoast';

	// Variables o estados reactivos
	const projects = ref([]);
	const project = ref({title: '', description: '', start_date: '', end_date: '', user_id: ''});
	const visible = ref(false);
	const submitted = ref(false);
	const toast = useToast();
	const deleteProjectDialog = ref(false);
	const dt = ref(null);
	const loading = ref(false) // gif de carga para lazy
	const lazyParams = ref({page: 0}); // Variable que escucha los cambios en la tabla
	const totalRecords = ref(0);

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
	}

	async function saveProject() {
		try {
			if (project.value.id) {
				// Si va a actualizar
				await projectService.update(project.value, project.value.id);

				toast.add({
					severity: 'success', 
					summary: 'Proyecto Modificado', 
					detail: 'El proyecto fue actualizado exitosamente', 
					life: 3000
				});

			} else {
				// Si va a insertar
				await projectService.save(project.value);

				toast.add({
					severity: 'success', 
					summary: 'Proyecto Registrado', 
					detail: 'El proyecto fue grabado exitosamente', 
					life: 3000
				});

			}

		} catch (error) {
			alert("error1");
		}

		// Listo de nuevo los proyectos
		getProjects();
		submitted.value = true;
		visible.value = false; // Escondo el modal
		project.value = {title: '', description: '', start_date: '', end_date: '', user_id: ''}; // Limpio los campos

	}

	const openNew = () => {
		project.value = {title: '', description: '', start_date: '', end_date: '', user_id: ''};
		submitted.value = false;
		visible.value = true;
	};

	function editProject(proj) {
		project.value = proj;
		visible.value = true;
	}

	const confirmDeleteProject = (editProj) => {
		project.value = editProj;
		deleteProjectDialog.value = true;
	};

	async function deleteProject() {
		await projectService.delete(project.value.id);

		deleteProjectDialog.value = false;
		project.value = {title: '', description: '', start_date: '', end_date: '', user_id: ''}; // Limpio los campos

		getProjects();
		toast.add({
			severity: 'success', 
			summary: 'Proyecto Eliminado', 
			detail: 'El proyecto fue eliminado exitosamente', 
			life: 3000
		});

	}

	const hideDialog = () => {
		visible.value = false;
		submitted.value = false;
	};
</script>