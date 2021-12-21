<template>
	<div class="col-12">
		<div class="card flex flex-column">
			<span class="text-2xl mb-3">{{ title }}</span>
			<DataTable
				responsiveLayout="scroll"
				:paginator="true"
				:rows="10"
				:value="data"
				dataKey="id"
				filterDisplay="menu"
				v-model:filters="filters"
				:globalFilterFields="search"
			>
				<template #header>
					<div class="p-d-flex p-jc-between">
						<span class="p-input-icon-left">
							<i class="pi pi-search" />
							<InputText
								v-model="filters['global'].value"
								placeholder="Keyword Search"
							/>
						</span>
						<slot name="header"> </slot>
					</div>
				</template>
				<template #loading> Loading data. Please wait. </template>
				<slot name="column"></slot>
			</DataTable>
		</div>
	</div>
</template>
<script>
import { ref } from "vue";
import { FilterMatchMode } from "primevue/api";
export default {
	props: {
		search: {
			type: Array,
			required: true,
		},
		data: {
			type: Array,
			required: true,
		},
		title: {
			type: String,
			required: true,
		},
	},
	setup() {
		const filters = ref({
			global: { value: null, matchMode: FilterMatchMode.CONTAINS },
		});

		return {
			filters,
		};
	},
};
</script>