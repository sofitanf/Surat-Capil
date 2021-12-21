import axios from "axios";
import { defineStore } from "pinia";

export const useNomorSurat = defineStore({
    id: "nomorSurat",
    state: () => ({
        nomorSurat: [],
        nomorSuratId: {},
    }),
    actions: {
        async getNomorSurat() {
            let res = await axios.get("/api/nomor-surat");
            this.nomorSurat = res.data.data;
        },
        async createNomorSurat(payload) {
            let res = await axios.post("/api/nomor-surat", payload);
            this.nomorSurat.push(res.data.data);
        },
        async getNomorSuratId(id) {
            let res = await axios.get(`/api/nomor-surat/${id}`);
            this.nomorSuratId = res.data.data;
        },
        async updateNomorSuratId({ id, payload }) {
            let res = await axios.patch(`/api/nomor-surat/${id}`, payload);
            this.nomorSuratId = res.data.data;
        },
    },
});