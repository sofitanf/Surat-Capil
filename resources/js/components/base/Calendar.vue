<template>
	<div class="mb-3">
		<label>{{ name }}</label>
		<Calendar
			v-model="date"
			id="basic"
			autocomplete="off"
			:class="{ 'p-invalid p-component': error }"
		/>
		<small class="p-error">{{ error }}</small>
	</div>
</template>
<script>
import { ref, watch } from "vue";
import moment from "moment";
export default {
	props: {
		name: {
			type: String,
			required: true,
		},
		error: String,
		data: String,
	},
	setup(props, { emit }) {
		const date = ref(props.data);

		watch(date, () => {
			const fixDate = moment(date.value).format("YYYY-MM-DD");
			emit("clickDate", fixDate);
		});

		return { date };
	},
};
</script>
