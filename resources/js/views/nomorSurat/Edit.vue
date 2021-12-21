<template>
	<form-nomor-surat
		v-if="nomorSurat && nomorSurat.id"
		@submitValue="edit"
		:nomorSurat="nomorSurat"
		:errorNomorSurat="errorNomorSurat"
		title="Edit Nomor Surat"
		button="Update nomor surat"
	/>
</template>
<script>
import { computed, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import FormNomorSurat from "../../components/FormNomor.vue";
import { useNomorSurat } from "../../store/nomorSurat";
export default {
	components: { FormNomorSurat },
	setup() {
		const store = useNomorSurat();
		const router = useRouter();
		const route = useRoute();
		const errorNomorSurat = ref(null);

		const id = route.params.id;

		store.getNomorSuratId(id);

		const nomorSurat = computed(() => store.nomorSuratId);

		const edit = async (value) => {
			await store
				.updateNomorSuratId({ id: id, payload: value })
				.then(() => router.push("/nomor-surat"))
				.catch((error) => {
					if (error.response && error.response.data) {
						errorNomorSurat.value = error.response.data.nomor_surat[0];
					}
				});
		};

		return { edit, errorNomorSurat, nomorSurat };
	},
};
</script>