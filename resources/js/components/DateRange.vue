<template>
	<div class="col-6">
		<v-date-picker v-model="range" is-range locale="id">
			<template v-slot="{ inputValue, inputEvents }">
				<div class="flex align-items-center">
					<input
						:value="inputValue.start"
						v-on="inputEvents.start"
						class="p-inputtext"
					/>
					<i class="pi pi-arrow-right icon mx-2"></i>
					<input
						:value="inputValue.end"
						v-on="inputEvents.end"
						class="p-inputtext mr-3"
					/>
					<Button
						@click="cetaklaporan"
						label="Cetak Laporan"
						class="p-button-raised w-30rem"
					/>
				</div>
			</template>
		</v-date-picker>
	</div>
</template>
<script>
import { ref } from "vue";
import moment from "moment";
export default {
	props: {
		link: {
			type: String,
			required: true,
		},
	},
	setup(props) {
		const date = new Date();
		const range = ref({
			start: new Date(date.getFullYear(), date.getMonth(), 1),
			end: new Date(date.getFullYear(), date.getMonth() + 1, 0),
		});

		const cetaklaporan = () => {
			range.value.start = moment(range.value.start).format("YYYY-MM-DD");
			range.value.end = moment(range.value.end).format("YYYY-MM-DD");

			window.open(
				`/laporan/${props.link}/` + range.value.start + "+" + range.value.end,
				"_blank"
			);
		};

		return { range, cetaklaporan };
	},
};
</script>