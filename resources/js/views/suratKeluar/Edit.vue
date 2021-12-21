<template>
	<form-surat-keluar
		v-if="suratId && suratId.id && nomor && nomor.length > 0"
		title="Edit Surat Keluar"
		:nomor="nomor"
		:surat="suratId"
		:isEdit="true"
		button="Update surat"
		@submitValue="edit"
		:errorSuratKeluar="errorSuratKeluar"
	/>
	<div v-if="suratId && suratId.lampiran">
		<iframe
			:src="'/storage/suratKeluar/' + suratId.lampiran"
			style="width: 500px; height: 800px"
			frameborder="0"
		></iframe>
	</div>
</template>
<script>
import { computed, ref } from "vue";
import { useToast } from "primevue/usetoast";
import { useRoute } from "vue-router";
import FormSuratKeluar from "../../components/FormSuratKeluar.vue";
import { useSuratKeluar } from "../../store/suratKeluar";
import { useNomorSurat } from "../../store/nomorSurat";

export default {
	components: { FormSuratKeluar },
	setup() {
		const store = useSuratKeluar();
		const route = useRoute();
		const toast = useToast();
		const nomorStore = useNomorSurat();
		const id = route.params.id;
		const errorSuratKeluar = ref(null);

		store.getSuratId(id);
		nomorStore.getNomorSurat();

		const suratId = computed(() => store.suratId);
		const nomor = computed(() => nomorStore.nomorSurat);

		const edit = (value) => {
			let fixValue = value;

			if (fixValue.lampiran && !fixValue.lampiran.includes("base64")) {
				delete fixValue.lampiran;
			}

			store
				.updateSurat({ id: id, payload: fixValue })
				.then(() => {
					toast.add({
						severity: "success",
						summary: "Update surat keluar",
						detail: "Surat masuk berhasil diupdate!",
						group: "br",
						life: 3000,
					});

					setTimeout(() => {
						window.scrollTo(0, 0);
					}, 1000);
				})
				.catch((error) => {
					if (error.response && error.response.data) {
						errorSuratKeluar.value = error.response.data.id[0];
					}
				});
		};

		return { suratId, edit, nomor, errorSuratKeluar };
	},
};
</script>