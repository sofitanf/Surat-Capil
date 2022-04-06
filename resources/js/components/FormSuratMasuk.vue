<template>
	<div class="card grid p-fluid">
		<h4 class="col-12">{{ title }}</h4>
		<form class="col-12" @submit="onSubmit">
			<form-input
				v-model="no_surat"
				name="Nomor Surat"
				:error="errors.no_surat"
			/>
			<form-calendar
				@clickDate="valueTglSurat($event, 'tgl_surat')"
				name="Tanggal Surat"
				:error="errors.tgl_surat"
				:data="surat && surat.tgl_surat ? surat.tgl_surat : null"
			/>
			<form-calendar
				@clickDate="valueTglSurat($event, 'tgl_diterima')"
				name="Tanggal Diterima"
				:error="errors.tgl_diterima"
				:data="surat && surat.tgl_diterima ? surat.tgl_diterima : null"
			/>
			<select-input
				@selected="valueSifat"
				name="Sifat"
				v-model="sifat"
				:optionData="optionData"
				:error="errors.sifat"
				:data="surat && surat.sifat ? surat.sifat : null"
			/>
			<form-input v-model="pengirim" name="Pengirim" :error="errors.pengirim" />
			<text-input v-model="perihal" name="Perihal" :error="errors.perihal" />
			<div v-if="isEdit">
				<form-input v-model="pengolah" name="Pengolah" />
				<form-input v-model="kepada" name="Kepada" />
			</div>
			<file-upload @fileUpload="upload" />
			<Button
				type="submit"
				:label="button"
				class="p-button-raised w-10rem mt-5"
			/>
		</form>
	</div>
</template>
<script >
import { ref } from "vue";
import { useForm, useField } from "vee-validate";
import FormInput from "./base/Input.vue";
import FormCalendar from "./base/Calendar.vue";
import TextInput from "./base/TextArea.vue";
import SelectInput from "./base/Select.vue";
import FileUpload from "./base/FileUpload.vue";

export default {
	components: { FormInput, FormCalendar, TextInput, SelectInput, FileUpload },
	props: {
		title: {
			type: String,
			default: "Tambah Surat Masuk",
		},
		surat: Object,
		isEdit: {
			type: Boolean,
			default: false,
		},
		button: {
			type: String,
			default: "Simpan surat",
		},
	},

	setup(props, { emit }) {
		const { handleSubmit, errors } = useForm({
			initialValues: props.surat,
		});

		const { value: no_surat } = useField("no_surat", "required");
		const { value: tgl_surat } = useField("tgl_surat", "required");
		const { value: tgl_diterima } = useField("tgl_diterima", "required");
		const { value: sifat } = useField("sifat", "required");
		const { value: pengirim } = useField("pengirim", "required");
		const { value: perihal } = useField("perihal", "required");
		const { value: lampiran } = useField("lampiran");
		const { value: pengolah } = useField("pengolah");
		const { value: kepada } = useField("kepada");

		const optionData = ref([
			{ name: "Biasa", code: "Biasa" },
			{ name: "Segera", code: "Segera" },
			{ name: "Sangat Segera", code: "Sangat Segera" },
			{ name: "Rahasia", code: "Rahasia" },
		]);

		const valueTglSurat = (date, field) => {
			field === "tgl_surat"
				? (tgl_surat.value = date)
				: (tgl_diterima.value = date);
		};

		const valueSifat = (value) => {
			sifat.value = value;
		};

		const upload = (value) => {
			lampiran.value = value;
		};

		const onSubmit = handleSubmit((values) => {
			emit("submitValue", values);
		});

		return {
			tgl_surat,
			tgl_diterima,
			no_surat,
			sifat,
			pengirim,
			perihal,
			lampiran,
			pengolah,
			kepada,
			onSubmit,
			valueTglSurat,
			valueSifat,
			optionData,
			upload,
			errors,
		};
	},
};
</script>
