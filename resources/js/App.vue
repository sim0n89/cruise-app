
<template>
	<Primaryheader/>

	<main>
		<router-view />
	</main>

</template>

<script>
import Primaryheader from './components/primaryheader.vue';

export default { components: { Primaryheader } }
</script>