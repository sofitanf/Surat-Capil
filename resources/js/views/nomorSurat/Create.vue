<template>
	<form-nomor-surat @submitValue="create" :errorNomorSurat="errorNomorSurat" />
</template>
<script>
import { ref } from "vue-demi";
import { useRouter } from "vue-router";
import FormNomorSurat from "../../components/FormNomor.vue";
import { useNomorSurat } from "../../store/nomorSurat";
export default {
	components: { FormNomorSurat },
	setup() {
		const store = useNomorSurat();
		const router = useRouter();
		const errorNomorSurat = ref(null);

		const create =  (value) => {
			 store
				.createNomorSurat(value)
				.then(() => router.push("/nomor-surat"))
				.catch((error) => {
					if (error.response && error.response.data) {
						errorNomorSurat.value = error.response.data.nomor_surat[0];
					}
				});
		};

		return { create, errorNomorSurat };
	},
};
</script>