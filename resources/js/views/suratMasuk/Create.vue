<template>
	<form-surat-masuk @submitValue="submit" />
</template>
<script>
import FormSuratMasuk from "../../components/FormSuratMasuk.vue";
import { useSuratMasuk } from "../../store/suratMasuk";
import { useRouter } from "vue-router";
export default {
	components: { FormSuratMasuk },
	setup() {
		const surat = useSuratMasuk();
		const router = useRouter();

		const submit = (value) => {
			surat
				.createSurat(value)
				.then((id) => router.push(`/admin/surat-masuk/edit/${id}`));
		};

		return { submit };
	},
};
</script>