<template>
	<DataSet :data="store.nomorSurat" :search="search" title="Nomor Surat">
		<template #header>
			<div class="flex justify-end">
				<router-link to="/nomor-surat/create">
					<Button label="Tambah Nomor Surat" class="p-button-info w-15rem" />
				</router-link>
			</div>
		</template>
		<template #column>
			<Column field="id" header="#" :sortable="true" />
			<Column field="nomor_surat" header="Nomor Surat" />
			<Column field="keterangan" header="Keterangan" />
			<Column class="opsi" header="Aksi">
				<template #body="{ data }">
					<div class="aksi">
						<router-link :to="{ name: 'nomorSurat', params: { id: data.id } }">
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
import { ref } from "vue";
import DataSet from "../../components/DataTable.vue";
import { useNomorSurat } from "../../store/nomorSurat";
export default {
	components: { DataSet },
	setup() {
		const search = ref(["nomor_surat", "keterangan"]);
		const store = useNomorSurat();

		store.getNomorSurat();

		return { store, search };
	},
};
</script>