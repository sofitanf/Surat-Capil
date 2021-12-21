import axios from "axios";
import { defineStore } from "pinia";

export const useSuratKeluar = defineStore({
    id: "suratKeluar",
    state: () => ({
        surat: [],
        suratId: {},
    }),
    actions: {
        async getSurat() {
            let res = await axios.get("/api/surat-keluar");
            this.surat = res.data.data;
        },
        async createSurat(payload) {
            let res = await axios.post("/api/surat-keluar", payload);
            this.surat.push(res.data.data);
        },
        async getSuratId(id) {
            let res = await axios.get(`/api/surat-keluar/${id}`);
            this.suratId = res.data.data;
        },
        async updateSurat({ id, payload }) {
            let res = await axios.patch(`/api/surat-keluar/${id}`, payload);
            this.suratId = res.data.data;
        },
    },
});