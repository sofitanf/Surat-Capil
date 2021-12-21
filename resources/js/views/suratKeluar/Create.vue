<template>
	<form-surat-keluar
		v-if="nomorSurat.length > 0"
		@submitValue="submit"
		:nomor="nomorSurat"
		:errorSuratKeluar="errorSuratKeluar"
	/>
</template>
<script>
import FormSuratKeluar from "../../components/FormSuratKeluar.vue";
import { useNomorSurat } from "../../store/nomorSurat";
import { computed, ref } from "vue";
import { useSuratKeluar } from "../../store/suratKeluar";
import { useRouter } from "vue-router";
export default {
	components: { FormSuratKeluar },
	setup() {
		const nomor = useNomorSurat();
		const surat = useSuratKeluar();
		const router = useRouter();
		const errorSuratKeluar = ref(null);

		const submit = (value) => {
			surat
				.createSurat(value)
				.then(() => router.push("/surat-keluar"))
				.catch((error) => {
					if (error.response && error.response.data) {
						errorSuratKeluar.value = error.response.data.id[0];
					}
				});
		};

		nomor.getNomorSurat();

		const nomorSurat = computed(() => nomor.nomorSurat);

		return { submit, nomorSurat, errorSuratKeluar };
	},
};
</script>