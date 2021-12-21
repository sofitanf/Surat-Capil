<template>
	<DateRange link="surat-keluar" />
	<DataSet :data="store.surat" :search="search" title="Surat Keluar">
		<template #header>
			<div class="flex justify-end">
				<router-link to="/surat-keluar/create">
					<Button label="Tambah Surat" class="p-button-info w-10rem" />
				</router-link>
			</div>
		</template>
		<template #column>
			<Column field="id" header="#" :sortable="true" />
			<Column field="no_surat" header="Nomor Surat" />
			<Column field="alamat_pengirim" header="Pengirim" />
			<Column field="tgl_surat" header="Tgl Surat" />
			<Column header="Nomor">
				<template #body="{ data }">
					<p>{{ data.no_surat }}/{{ data.id }}</p>
				</template>
			</Column>
			<Column field="perihal" header="Perihal" />
			<Column field="kepada" header="Kepada" />
			<Column class="opsi" header="Aksi">
				<template #body="{ data }">
					<div class="aksi">
						<router-link :to="{ name: 'suratKeluar', params: { id: data.id } }">
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
import { useSuratKeluar } from "../../store/suratKeluar";
export default {
	components: { DataSet, DateRange },
	setup() {
		const search = ref([
			"id",
			"no_surat",
			"tgl_surat",
			"tgl_diterima",
			"alamat_pengirim",
			"perihal",
			"kepada",
		]);
		const store = useSuratKeluar();

		onMounted(() => {
			store.getSurat();
		});

		return { store, search };
	},
};
</script>