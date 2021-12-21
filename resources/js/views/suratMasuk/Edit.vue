<template>
	<Button
		label="Cetak Disposisi"
		class="p-button-raised p-button-success mb-5"
		@click="cetakDisposisi"
	/>
	<form-surat-masuk
		v-if="suratId && suratId.no_surat"
		title="Edit Surat Masuk"
		:surat="suratId"
		:isEdit="true"
		button="Update surat"
		@submitValue="edit"
	/>
	<div v-if="suratId && suratId.lampiran">
		<iframe
			:src="'/storage/suratMasuk/' + suratId.lampiran"
			style="width: 500px; height: 800px"
			frameborder="0"
		></iframe>
	</div>
</template>
<script>
import { computed } from "vue";
import { useToast } from "primevue/usetoast";
import { useSuratMasuk } from "../../store/suratMasuk";
import { useRoute } from "vue-router";
import FormSuratMasuk from "../../components/FormSuratMasuk.vue";

export default {
	components: { FormSuratMasuk },
	setup() {
		const store = useSuratMasuk();
		const route = useRoute();
		const toast = useToast();
		const id = route.params.id;

		store.getSuratId(id);

		const suratId = computed(() => store.suratId);

		const edit = (value) => {
			let fixValue = value;

			if (fixValue.lampiran && !fixValue.lampiran.includes("base64")) {
				delete fixValue.lampiran;
			}

			store.updateSurat({ id: id, payload: fixValue }).then(() => {
				toast.add({
					severity: "success",
					summary: "Update surat masuk",
					detail: "Surat masuk berhasil diupdate!",
					group: "br",
					life: 3000,
				});

				setTimeout(() => {
					window.scrollTo(0, 0);
				}, 1000);
			});
		};

		const cetakDisposisi = () => {
			window.open(`/disposisi/${id}/cetak`, "_blank");
		};

		return { suratId, edit, cetakDisposisi };
	},
};
</script>