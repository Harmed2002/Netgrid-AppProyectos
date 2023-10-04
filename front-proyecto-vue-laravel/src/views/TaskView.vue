<template>
	<div class="grid">
		<!-- Card Proyectos -->
		<div class="col-5">
			<div class="card">
				<h3>Mis Proyectos</h3>
				<!-- {{ projects }} -->
				<DataTable
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
					<Column field="id" header="Id" :sortable="true" headerStyle="width:1%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.id }}
						</template>
					</Column>
					<Column field="title" header="Título" :sortable="true" headerStyle="width:29%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.title }}
						</template>
					</Column>
					<Column field="start_date" header="Inicia" :sortable="true" headerStyle="width:30%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.start_date }}
						</template>
					</Column>
					<Column field="end_date" header="Finaliza" :sortable="true" headerStyle="width:30%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.end_date }}
						</template>
					</Column>
					<Column header="Detalle" headerStyle="width:10%; min-width:5rem;">
						<template #body="slotProps">
							<Button icon="pi pi-eye" class="p-button-rounded mr-2" @click="showTasks(slotProps.data)" />
						</template>
					</Column>
				</DataTable>
			</div>
		</div>

		<!-- Card Tareas -->
		<div class="col-7">
			<div class="card">
				<h3>Detalle de Tareas {{ titleSelProject }}</h3>
		
				<Button label="Nuevo" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
		
				<!-- Modal Crear/Actualizar task -->
				<Dialog v-model:visible="visible" modal header="Tarea" :style="{ width: '30vw' }" class="p-fluid">
					<div class="formgrid grid">
						<div class="field col-12 md:col-2">
							<label for="project_id">Proyecto</label>
							<InputText id="project_id" v-model.trim="task.project_id" disabled/>
						</div>
						<div class="field col-12 md:col-10">
							<label for="title">Título</label>
							<InputText id="title" v-model.trim="task.title" required="true" autofocus :class="{ 'p-invalid': submitted && !task.title }" />
							<small class="p-invalid" v-if="submitted && !task.title">El título es requerido.</small>
						</div>
					</div>
		
					<div class="field">
						<label>Descripción</label>
						<Textarea v-model="task.description" rows="3" cols="30" />
					</div>
		
					<div class="field">
						<div>Seleccione el estado</div>
						<div class="flex flex-wrap gap-3">
							<div class="flex align-items-center">
								<RadioButton v-model="task.status" inputId="pending" name="status" value="PENDIENTE" />
								<label for="pending" class="ml-2">Pendiente</label>
							</div>
							<div class="flex align-items-center">
								<RadioButton v-model="task.status" inputId="inProgress" name="status" value="EN PROGRESO" />
								<label for="inProgress" class="ml-2">En Progreso</label>
							</div>
							<div class="flex align-items-center">
								<RadioButton v-model="task.status" inputId="completed" name="status" value="COMPLETADA" />
								<label for="completed" class="ml-2">Completada</label>
							</div>
						</div>
					</div>
		
					<template #footer>
						<Button label="Cancelar" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
						<Button label="Guardar" icon="pi pi-check" class="p-button-text" @click="saveTask" />
					</template>
				</Dialog>
		
				<!-- Modal Borrar proyecto -->
				<Dialog v-model:visible="deleteTaskDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
					<div class="flex align-items-center justify-content-center">
						<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
						<span v-if="task">¿Está seguro de eliminar la tarea <b>{{ task.title }}</b>?</span>
					</div>
					<template #footer>
						<Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteTaskDialog = false" />
						<Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteTask" />
					</template>
				</Dialog>
		
				<DataTable
					ref="dt"
					:value="tasks"
					:totalRecords="totalRecords"
					lazy
					:loading="loading"
					@page="onPage($event)"
					dataKey="id"
					:paginator="true"
					:rows="10"
					paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
					:rowsPerPageOptions="[3, 5, 10, 25]"
					currentPageReportTemplate="Mostrando {first} al {last} de {totalRecords} tareas"
					responsiveLayout="scroll"
				>
					<Column field="id" header="Id" :sortable="true" headerStyle="width:1%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.id }}
						</template>
					</Column>
					<Column field="title" header="Título" :sortable="true" headerStyle="width:30%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.title }}
						</template>
					</Column>
					<Column field="description" header="Descripción" :sortable="true" headerStyle="width:30%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.description }}
						</template>
					</Column>
					<!-- <Column field="status" header="Estado" :sortable="true" headerStyle="width:19%; min-width:5rem;">
						<template #body="slotProps">
							{{ slotProps.data.status }}
						</template>
					</Column> -->

					<Column field="status" header="Estado" :sortable="true" headerStyle="width:19%; min-width:5rem;">
						<template #body="slotProps">
							<Tag :value="slotProps.data.status" :severity="getSeverity(slotProps.data)" />
						</template>
					</Column>


					<Column header="Gestión" headerStyle="width:20%; min-width:5rem;">
						<template #body="slotProps">
							<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editTask(slotProps.data)" />
							<Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2" @click="confirmDeleteTask(slotProps.data)" />
						</template>
					</Column>
				</DataTable>
				<Toast />
			</div>

		</div>
	</div>
</template>

<script setup>
	// Importaciones
	import { ref, onMounted } from 'vue';
	import projectService from "../services/project.service";
	import taskService from "../services/task.service";
	import { useToast } from 'primevue/usetoast';

	// Variables o estados reactivos
	const tasks = ref([]);
	const task = ref({ project_id: '', title: '', description: '', status: '' });
	const visible = ref(false);
	const submitted = ref(false);
	const toast = useToast();
	const deleteTaskDialog = ref(false);
	const projects = ref([]);
	const totalRecords = ref(0);
	const dt = ref(null);
	const loading = ref(false) // gif de carga para lazy
	const lazyParams = ref({page: 0}); // Variable que escucha los cambios en la tabla
	const titleSelProject = ref('');
	const idSelProject = ref('');

	// Métodos o funciones
	onMounted(() => {
		getProjects();
	});

	// Esta función es para escuchar los cambios de la tabla y hacer carga perezosa
	const onPage = (event) => {
		lazyParams.value = event;
		// console.log("lazyParams", lazyParams.value);
		getProjects();
	};

	async function getProjects() {
		loading.value = true;
		let page = lazyParams.value.page + 1; // +1 x q comienza en page 0
		let limit = lazyParams.value.rows || 10; // Numero de registros por página

		const { data } = await projectService.index(page, limit);
		loading.value = false;
		projects.value = data.data;
		totalRecords.value = data.total;
	};

	// async function getTasks() {
	// 	const data = await taskService.index();

	// 	tasks.value = data.data;
	// };

	async function saveTask() {
		try {
			if (task.value.id) {
				// Si va a actualizar
				await taskService.update(task.value, task.value.id);

				toast.add({
					severity: 'success',
					summary: 'Tarea Modificada',
					detail: 'La tarea fue actualizada exitosamente',
					life: 3000
				});

			} else {
				// Si va a insertar
				await taskService.save(task.value);

				toast.add({
					severity: 'success',
					summary: 'Tarea Registrada',
					detail: 'La tarea fue grabada exitosamente',
					life: 3000
				});

			}

		} catch (error) {
			alert("error");
		}

		// Actualizo la lista de proyectos para incluir la tarea nueva en projects.tasks
		getProjects();
		tasks.value = [];
		titleSelProject.value = '';
		idSelProject.value = '';
		submitted.value = true;
		visible.value = false; // Escondo el modal
		task.value = { project_id: '', title: '', description: '', status: '' }; // Limpio los campos

	};

	const openNew = () => {
		task.value = { project_id: '', title: '', description: '', status: '' };
		if (idSelProject.value) {
			task.value.project_id = idSelProject.value;
			submitted.value = false;
			visible.value = true;
		} else {
			toast.add({
				severity: 'info',
				summary: 'SR. USUARIO',
				detail: '¡Debe seleccionar un proyecto!',
				life: 3000
			});
		}
	};

	function editTask(editTask) {
		task.value = editTask;
		visible.value = true;
	};

	const confirmDeleteTask = (editTask) => {
		task.value = editTask;
		deleteTaskDialog.value = true;
	};

	async function deleteTask() {
		await taskService.delete(task.value.id);

		deleteTaskDialog.value = false;
		task.value = { project_id: '', title: '', description: '', status: '' }; // Limpio los campos

		getTasks();

		toast.add({
			severity: 'success',
			summary: 'Tarea Eliminada',
			detail: 'La tarea fue eliminada exitosamente',
			life: 3000
		});

	};

	const hideDialog = () => {
		visible.value = false;
		submitted.value = false;
	};

	const showTasks = (selProj) => {
		tasks.value = selProj.tasks;
		titleSelProject.value = selProj.title;
		idSelProject.value = selProj.id;
	};

	const getSeverity = (task) => {
		switch (task.status) {
			case 'COMPLETADA':
				return 'success';

			case 'EN PROGRESO':
				return 'warning';

			case 'PENDIENTE':
				return 'danger';

			default:
				return null;
		}
	};
</script>