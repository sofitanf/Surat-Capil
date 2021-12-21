import axios from "axios";
import { defineStore } from "pinia";
import { setHeaderToken, removeHeaderToken } from "../plugins/auth";

export const useAuth = defineStore({
    id: "auth",
    state: () => ({
        isLoggedIn: false,
        user: {},
    }),
    actions: {
        login(payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/login", payload)
                    .then((res) => {
                        const token = res.data.token;
                        localStorage.setItem("token", token);
                        setHeaderToken(token);
                        this.getUser();
                        resolve(res);
                    })
                    .catch((err) => {
                        localStorage.removeItem("token");
                        this.user = null;
                        this.isLoggedIn = false;
                        reject(err);
                    });
            });
        },
        async getUser() {
            if (!localStorage.getItem("token")) {
                return;
            }

            try {
                let res = await axios.get("/api/userLogin");
                this.user = res.data.data;
                this.isLoggedIn = true;
            } catch (error) {
                this.user = null;
                this.isLoggedIn = false;
                localStorage.removeItem("token");
                removeHeaderToken();
                return error;
            }
        },
        logout() {
            return axios.post("/api/logout").then((res) => {
                this.user = null;
                this.isLoggedIn = false;
                localStorage.removeItem("token");
                removeHeaderToken();
            });
        },
    },
});