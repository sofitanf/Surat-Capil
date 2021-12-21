<template>
	<div class="mb-3">
		<label>{{ name }}</label>
		<textarea
			:value="modelValue"
			@change="$emit('update:modelValue', $event.target.value)"
			class="p-inputtext mt-3"
			:class="{ 'p-invalid p-component': error }"
		/>
		<small class="p-error">{{ error }}</small>
	</div>
</template>
<script>
export default {
	props: {
		name: {
			type: String,
			required: true,
		},
		error: String,
		modelValue: String,
	},
};
</script>
