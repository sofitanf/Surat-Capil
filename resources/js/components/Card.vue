<template>
	<div class="col-12 lg:col-6">
		<div class="card flex justify-content-between align-items-start mb-0">
			<div>
				<span class="text-2xl">{{ name }}</span>
				<span class="p-text-secondary block mt-2">Jumlah Surat</span>
			</div>
			<span :class="color" class="text-white py-2 px-3 text-2xl border-round">{{
				data
			}}</span>
		</div>
	</div>
</template>
<script>
export default {
	props: {
		name: {
			type: String,
			required: true,
		},
		data: {
			required: true,
		},
		color: {
			type: String,
			default: "bg-green-500",
		},
	},
};
</script>