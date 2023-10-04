<template>
	<!-- {{ props.data }} -->

	<DataTable :value="props.data">
		<Column v-for="col in props.columns" :field="col.key" :header="col.label" :key="col.id"></Column>
		<!-- <Column headerStyle="min-width:2rem;">
			<template #body="slotProps">
				<Button icon="pi pi-cart-plus" class="p-button-rounded p-button-info mr-2"
					@click="agregar(slotProps.data)" 
				/>
			</template>
		</Column> -->
	</DataTable>
</template>

<script setup>
	const props = defineProps(['data', 'columns']);
</script>