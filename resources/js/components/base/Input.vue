<template>
	<div class="mb-3">
		<label>{{ name }}</label>
		<input
			:value="modelValue"
			@change="$emit('update:modelValue', $event.target.value)"
			class="p-inputtext"
			:class="{ 'p-invalid p-component': error }"
			:type="type"
		/>
		<small class="p-error">{{ error }}</small>
		<slot> </slot>
	</div>
</template>
<script>
export default {
	props: {
		name: {
			type: String,
			required: true,
		},
		error: {
			type: String,
		},
		modelValue: {
			required: true,
		},
		type: {
			type: String,
			default: "input",
		},
	},
};
</script>
