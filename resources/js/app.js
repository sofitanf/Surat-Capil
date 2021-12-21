import { createApp, reactive } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router";
import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import "primeflex/primeflex.css";
import PrimeVue from "primevue/config";
import Ripple from "primevue/ripple";
import ToastService from "primevue/toastservice";
import VCalendar from "v-calendar";
import ui from "./plugins/ui";
import validate from "./plugins/validate";
import { useAuth } from "./store/auth";
import { setHeaderToken } from "./plugins/auth";

const token = localStorage.getItem("token");
if (token) {
    setHeaderToken(token);
}

(async() => {
    const app = createApp(App);
    app.use(createPinia());
    const { getUser } = useAuth();
    await getUser();

    app.config.globalProperties.$appState = reactive({
        inputStyle: "outlined",
    });
    app.use(VCalendar, {});
    app.use(ui);
    app.use(validate);
    app.use(PrimeVue, { ripple: true });
    app.directive("ripple", Ripple);
    app.use(ToastService);
    app.use(router);
    app.mount("#app");
})();