<template>
	<div class="mb-3">
		<label>{{ name }}</label>
		<Dropdown
			class="mt-3"
			v-model="value"
			@change="update"
			:options="optionData"
			optionLabel="name"
			optionValue="code"
			placeholder="Pilih"
			:class="{ 'p-invalid p-component': error }"
		/>
		<small class="p-error">{{ error }}</small>
	</div>
</template>
<script>
import { ref } from "vue";
export default {
	props: {
		name: {
			type: String,
			required: true,
		},
		error: String,
		modelValue: {
			required: true,
		},
		optionData: {
			type: Array,
			required: true,
		},
		data: {
			required: true,
		},
	},
	setup(props, { emit }) {
		const value = ref(props.data);

		function update(e) {
			emit("selected", e.value);
		}

		return { update, value };
	},
};
</script>
