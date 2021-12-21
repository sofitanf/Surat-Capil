<template>
	<div class="grid p-fluid dashboard">
		<card name="Surat Masuk" :data="total.surat_masuk" />
		<card
			name="Surat Keluar"
			:data="total.surat_keluar"
			color="bg-purple-500"
		/>
	</div>
</template>
<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import Card from "../components/Card.vue";
export default {
	components: { Card },
	setup() {
		const total = ref({});
		const getDashboard = async () => {
			let res = await axios.get("/api/dashboard");
			total.value = res.data;
		};

		onMounted(() => {
			getDashboard();
		});

		return { total };
	},
};
</script>