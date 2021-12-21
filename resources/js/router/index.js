import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";
import { useAuth } from "../store/auth";

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to) => {
    const auth = useAuth();
    if (to.matched.some((record) => record.meta.login && auth.isLoggedIn)) {
        return "/dashboard";
    }
    if (
        to.matched.some(
            (record) => record.meta.requiresAuth && !auth.isLoggedIn
        )
    ) {
        return "/";
    }
});

export default router;