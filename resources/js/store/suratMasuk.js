import axios from "axios";
import { defineStore } from "pinia";

export const useSuratMasuk = defineStore({
    id: "suratMasuk",
    state: () => ({
        surat: [],
        suratId: {},
    }),
    actions: {
        async getSurat() {
            let res = await axios.get("/api/surat-masuk");
            this.surat = res.data.data;
        },
        async createSurat(payload) {
            let res = await axios.post("/api/surat-masuk", payload);
            return res.data.id;
        },
        async getSuratId(id) {
            let res = await axios.get(`/api/surat-masuk/${id}`);
            this.suratId = res.data.data;
        },
        async updateSurat({ id, payload }) {
            let res = await axios.patch(`/api/surat-masuk/${id}`, payload);
            this.suratId = res.data.data;
        },
    },
});