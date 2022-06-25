<template>
	<div class="main">
        
    </div>
</template>

<script>
	import axios from '../API/axios';
	export default {
		name: 'Login',
		data() {
			return {
				username: '',
				password: '',
			};
		},
		methods: {
			login() {
				return axios
					.post('/login', {
						username: this.username,
						password: this.password,
					})
					.then((data) => {
						console.log(data);
					})
					.catch((err) => {
						console.log(err);
					});
			},
		},
	};
</script>

<style></style>
