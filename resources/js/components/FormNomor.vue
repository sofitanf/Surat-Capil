<template>
	<div class="card grid p-fluid">
		<h4 class="col-12">{{ title }}</h4>
		<form class="col-12" @submit="onSubmit">
			<form-input
				v-model="nomor_surat"
				name="Nomor Surat"
				:error="errors.nomor_surat"
			>
				<small v-if="errorNomorSurat" class="p-error">{{
					errorNomorSurat
				}}</small>
			</form-input>
			<form-input
				v-model="keterangan"
				name="Keterangan"
				:error="errors.keterangan"
			/>
			<Button
				type="submit"
				:label="button"
				class="p-button-raised w-12rem mt-5 btn"
			/>
		</form>
	</div>
</template>
<script>
import { useForm, useField } from "vee-validate";
import FormInput from "./base/Input.vue";

export default {
	components: { FormInput },
	props: {
		title: {
			type: String,
			default: "Tambah Nomor Surat",
		},
		nomorSurat: Object,
		isEdit: {
			type: Boolean,
			default: false,
		},
		button: {
			type: String,
			default: "Simpan nomor surat",
		},
		errorNomorSurat: String,
	},

	setup(props, { emit }) {
		const { handleSubmit, errors } = useForm({
			initialValues: props.nomorSurat,
		});

		const { value: nomor_surat } = useField("nomor_surat", "required");
		const { value: keterangan } = useField("keterangan", "required");

		const onSubmit = handleSubmit((values) => {
			emit("submitValue", values);
		});

		return {
			nomor_surat,
			keterangan,
			onSubmit,
			errors,
		};
	},
};
</script>
<style scoped>
.w-10rem {
	width: -1rem !important;
}
</style>
