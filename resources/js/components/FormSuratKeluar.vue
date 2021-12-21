<template>
	<div class="card grid p-fluid">
		<h4 class="col-12">{{ title }}</h4>
		<form class="col-12" @submit="onSubmit">
			<form-input v-model="id" name="Nomor Urut" :error="errors.id">
				<small v-if="errorSuratKeluar" class="p-error">{{
					errorSuratKeluar
				}}</small>
			</form-input>
			<select-input
				@selected="valueSelect($event, 'no_surat')"
				name="Nomor Surat"
				v-model="no_surat"
				:optionData="selectNomor"
				:error="errors.no_surat"
				:data="surat && surat.no_surat ? surat.no_surat : null"
			/>
			<form-calendar
				@clickDate="valueTglSurat"
				name="Tanggal Surat"
				:error="errors.tgl_surat"
				:data="surat && surat.tgl_surat ? surat.tgl_surat : null"
			/>
			<select-input
				@selected="valueSelect($event, 'kepada')"
				name="Dibuat"
				:optionData="optionData"
				v-model="kepada"
				:error="errors.kepada"
				:data="surat && surat.kepada ? surat.kepada : null"
			/>
			<form-input
				v-model="alamat_pengirim"
				name="Pengirim"
				:error="errors.alamat_pengirim"
			/>
			<text-input v-model="perihal" name="Perihal" :error="errors.perihal" />
			<file-upload @fileUpload="upload" />
			<Button
				type="submit"
				:label="button"
				class="p-button-raised w-10rem mt-5"
			/>
		</form>
	</div>
</template>
<script>
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
		nomor: {
			type: Array,
			required: true,
		},
		errorSuratKeluar: String,
	},

	setup(props, { emit }) {
		// const surat = props.surat.map((item) => {
		// 	item.toString();
		// });

		// for (const [key, value] of Object.entries(props.surat)) {
		// 	value.toString();
		// }
		const { handleSubmit, errors } = useForm({
			initialValues: props.surat,
		});
		const selectNomor = ref([]);

		const { value: id } = useField("id", "required");
		const { value: no_surat } = useField("no_surat", "required");
		const { value: tgl_surat } = useField("tgl_surat", "required");
		const { value: alamat_pengirim } = useField("alamat_pengirim", "required");
		const { value: perihal } = useField("perihal", "required");
		const { value: kepada } = useField("kepada", "required");
		const { value: lampiran } = useField("lampiran");

		const optionData = ref([
			{ name: "Sekretariat", code: "Sekretariat" },
			{
				name: "Kabid. Pelayanan Pendaftaran Penduduk",
				code: "Kabid. Pelayanan Pendaftaran Penduduk",
			},
			{
				name: "Kabid. Pelayanan Pencatatan Sipil",
				code: "Kabid. Pelayanan Pencatatan Sipil",
			},
			{
				name: "Kabid. PIAK dan Pemanfaatan Data",
				code: "Kabid. PIAK dan Pemanfaatan Data",
			},
		]);

		props.nomor.map((item) =>
			selectNomor.value.push({
				name: `${item.nomor_surat} - ${item.keterangan}`,
				code: item.nomor_surat,
			})
		);

		const valueTglSurat = (value) => {
			tgl_surat.value = value;
		};

		const valueSelect = (value, field) => {
			field === "no_surat" ? (no_surat.value = value) : (kepada.value = value);
		};

		const upload = (value) => {
			lampiran.value = value;
		};

		const onSubmit = handleSubmit((values) => {
			emit("submitValue", values);
		});

		return {
			selectNomor,
			id,
			no_surat,
			tgl_surat,
			alamat_pengirim,
			kepada,
			perihal,
			onSubmit,
			valueTglSurat,
			valueSelect,
			upload,
			errors,
			optionData,
			selectNomor,
		};
	},
};
</script>
