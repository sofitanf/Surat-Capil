<template>
	<router-view></router-view>
	<Toast position="bottom-right" group="br" />
</template>
<style>
.p-d-flex.p-jc-between {
	display: flex;
	justify-content: space-between;
	align-items: flex-end;
}
.aksi {
	display: flex;
	gap: 1rem;
}
</style>