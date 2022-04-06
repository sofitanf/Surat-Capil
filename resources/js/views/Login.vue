<template>
	<div class="flex align-items-center justify-content-center p-8">
		<div class="card grid p-fluid p-4 shadow-2 border-round w-full lg:w-4">
			<div class="text-center mb-3 col-12">
				<img src="images/pekalongan.png" alt="Image" height="60" class="mb-3" />
				<div class="text-900 text-3xl font-medium mb-3">Aplikasi Surat</div>
			</div>
			<form class="col-12" @submit="onSubmit">
				<form-input
					v-model="username"
					name="Username"
					:error="errors.username"
				/>
				<form-input
					v-model="password"
					name="Password"
					type="password"
					:error="errors.password"
				/>
				<Button
					type="submit"
					label="Login"
					class="p-button-raised w-full mt-5"
				/>
			</form>
		</div>
	</div>
</template>
<script>
import { useToast } from "primevue/usetoast";
import { defineComponent } from "vue";
import { useForm, useField } from "vee-validate";
import { useRouter } from "vue-router";
import { useAuth } from "../store/auth";
import FormInput from "../components/base/Input.vue";
export default defineComponent({
	components: { FormInput },
	setup() {
		const toast = useToast();
		const auth = useAuth();
		const router = useRouter();
		const { handleSubmit, errors } = useForm();
		const { value: username } = useField("username", "required");
		const { value: password } = useField("password", "required");

		const onSubmit = handleSubmit((values) => {
			auth
				.login(values)
				.then(() => router.go("/admin/dashboard"))
				.catch(() =>
					toast.add({
						severity: "error",
						summary: "Login Gagal",
						detail: "Username atau password salah",
						group: "br",
						life: 3000,
					})
				);
		});

		return { username, password, onSubmit, errors };
	},
});
</script>