const routes = [{
        path: "/",
        component: () =>
            import ("../views/Login.vue"),
        meta: {
            login: true,
        },
    },
    {
        path: "/admin",
        component: () =>
            import ("../layouts/Admin.vue"),
        meta: {
            requiresAuth: true,
        },
        children: [{
                path: "/dashboard",
                component: () =>
                    import ("../views/Dashboard.vue"),
            },
            {
                path: "/surat-masuk",
                component: () =>
                    import ("../views/suratMasuk/Show.vue"),
            },
            {
                path: "/surat-masuk/create",
                component: () =>
                    import ("../views/suratMasuk/Create.vue"),
            },
            {
                path: "/surat-masuk/edit/:id",
                component: () =>
                    import ("../views/suratMasuk/Edit.vue"),
                name: "suratMasuk",
            },
            {
                path: "/surat-keluar",
                component: () =>
                    import ("../views/suratKeluar/Show.vue"),
            },
            {
                path: "/surat-keluar/create",
                component: () =>
                    import ("../views/suratKeluar/Create.vue"),
            },
            {
                path: "/surat-keluar/edit/:id",
                component: () =>
                    import ("../views/suratKeluar/Edit.vue"),
                name: "suratKeluar",
            },
            {
                path: "/nomor-surat",
                component: () =>
                    import ("../views/nomorSurat/Show.vue"),
            },
            {
                path: "/nomor-surat/create",
                component: () =>
                    import ("../views/nomorSurat/Create.vue"),
            },
            {
                path: "/nomor-surat/edit/:id",
                component: () =>
                    import ("../views/nomorSurat/Edit.vue"),
                name: "nomorSurat",
            },
        ],
    },
];

export default routes;