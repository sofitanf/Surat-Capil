<template>
	<div class="layout-profile">
		<div></div>
		<button class="p-link layout-profile-link">
			<span class="username">gary</span>
		</button>
		<transition name="layout-submenu-wrapper">
			<ul>
				<li>
					<button class="p-link" @click="logout">
						<i class="pi pi-fw pi-power-off"></i><span>Keluar</span>
					</button>
				</li>
			</ul>
		</transition>
	</div>
</template>

<script>
import { useRouter } from "vue-router";
import { useAuth } from "../../store/auth";
export default {
	setup() {
		const auth = useAuth();
		const router = useRouter();
		const logout = () => {
			auth.logout().then(() => router.push("/"));
		};

		return { logout };
	},
};
</script>

