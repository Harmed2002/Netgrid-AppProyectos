<template>
	<h1>Lista de Productos</h1>

	<DataTable :value="props.data">
		<Column field="id" header="Id"></Column>
		<Column field="nombre" header="Nombre"></Column>
		<Column field="precio" header="Precio"></Column>
		<Column field="stock" header="Stock"></Column>
		<Column headerStyle="min-width:2rem;">
			<template #body="slotProps">
				<Button icon="pi pi-cart-plus" class="p-button-rounded p-button-info mr-2"
					@click="agregar(slotProps.data)" 
				/>
			</template>
		</Column>
	</DataTable>

	<!-- <p>{{ props.data }}</p> -->
</template>

<script setup>
	// import DataTable from 'primevue/datatable';
	// import Column from 'primevue/column';

	const props = defineProps(['miTitulo', 'data']); // Obtiene los props enviados desde el Padre
	const emit = defineEmits(['funCarrito']); // Define la función que emite o pasa props desde el componente hijo al padre

	function agregar(prod) {
		emit('funCarrito', prod);
	}
</script>