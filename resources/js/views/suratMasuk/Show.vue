<template>
	<DateRange link="surat-masuk" />
	<DataSet :data="store.surat" :search="search" title="Surat Masuk">
		<template #header>
			<div class="flex justify-end">
				<router-link to="/surat-masuk/create">
					<Button label="Tambah Surat" class="p-button-info w-10rem" />
				</router-link>
			</div>
		</template>
		<template #column>
			<Column field="id" header="#" :sortable="true" />
			<Column header="Nomor Surat">
				<template #body="{ data }">
					<p>{{ data.no_surat }} {{ data.tgl_surat }}</p>
				</template>
			</Column>
			<Column field="pengirim" header="Pengirim" />
			<Column field="tgl_diterima" header="Tgl Diterima" />
			<Column field="perihal" header="Perihal" />
			<Column field="sifat" header="Sifat" />
			<Column class="opsi" header="Aksi">
				<template #body="{ data }">
					<div class="aksi">
						<router-link :to="{ name: 'suratMasuk', params: { id: data.id } }">
							<Button
								type="button"
								icon="pi pi-pencil"
								class="p-button-warning"
							/>
						</router-link>
					</div>
				</template>
			</Column>
		</template>
	</DataSet>
</template>
<script>
import { onMounted, ref } from "vue";
import DataSet from "../../components/DataTable.vue";
import DateRange from "../../components/DateRange.vue";
import { useSuratMasuk } from "../../store/suratMasuk";
export default {
	components: { DataSet, DateRange },
	setup() {
		const search = ref([
			"id",
			"no_surat",
			"tgl_surat",
			"tgl_diterima",
			"pengirim",
			"perihal",
		]);
		const store = useSuratMasuk();

		onMounted(() => {
			store.getSurat();
		});

		return { store, search };
	},
};
</script>