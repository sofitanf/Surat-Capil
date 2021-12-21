<template>
	<div class="mb-2">
		<h6>File Lampiran</h6>
		<input
			@change="myUploader"
			type="file"
			accept="application/pdf"
			id="actual-btn"
			hidden
		/>
		<label for="actual-btn">Chose File</label>
		<span id="file-chosen">{{ nameFile }}</span
		><br />
		<h6 class="p-error mt-3">{{ error }}</h6>
	</div>
</template>
<script>
import { ref } from "vue";
export default {
	emits: ["fileUpload"],
	setup(_, { emit }) {
		const error = ref("");
		const nameFile = ref("No file chosen");
		const myUploader = (e) => {
			let file = e.target.files[0];
			nameFile.value = file.name;
			if (file.type === "application/pdf") {
				error.value = "";

				let reader = new FileReader();
				reader.onload = (e) => {
					emit("fileUpload", e.target.result);
				};

				reader.readAsDataURL(file);
			} else {
				error.value = "File lampiran berupa ekstensi .pdf";
			}
		};

		return { nameFile, myUploader, error };
	},
};
</script>
<style scoped>
label {
	background-color: indigo;
	color: white;
	padding: 0.5rem;
	font-family: sans-serif;
	border-radius: 0.3rem;
	cursor: pointer;
	margin-top: 1rem;
}

#file-chosen {
	margin-left: 0.3rem;
	font-family: sans-serif;
}
</style>
