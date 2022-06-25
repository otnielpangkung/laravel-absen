<template>
	<div class="container align-items-center">
		<!-- <b-col> Haloo </b-col> -->
		<div class="col">
			<div class="row justify-content-center">
				<div class="col">
					<img src="../../public/logo.png" alt="" />
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col">
					<b-button @click.prevent="showAdd()" variant="primary">
						<h3>Kendaraan Masuk</h3>
					</b-button>
				</div>
			</div>
			<div class="row justify-content-center mt-3">
				<div class="col">
					<b-button @click.prevent="showOut" variant="success">
						<h3>Kendaraan Keluar</h3>
					</b-button>
				</div>
			</div>
		</div>
		<!-- Modal in -->
		<div
			class="modal fade"
			id="addIn"
			role="dialog"
			title="Tambahkan Kendaraan"
		>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Tambahkan Kendaraan</h2>
					</div>
					<div class="modal-body">
						<b-form @submit.prevent="addIn()">
							<b-form-group
								id="input-group-3"
								label="Jenis Kendaraan:"
								label-for="input-3"
							>
								<b-form-select
									v-model="type"
									:options="typeCar"
									required
								></b-form-select>
							</b-form-group>
							<b-form-group
								id="input-group-3"
								label="Status Kendaraan"
								label-for="input-3"
							>
								<b-form-select
									v-model="milik"
									:options="miliks"
									required
								></b-form-select>
							</b-form-group>
							<b-form-group
								id="input-group-3"
								label="Plat Kendaraan"
								label-for="input-3"
							>
								<b-form-input
									type="text"
									v-model="plat"
									required
								></b-form-input>
							</b-form-group>
							<b-button type="submit" variant="primary">Simpan</b-button>
						</b-form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Out -->
		<div
			class="modal fade"
			id="addOut"
			role="dialog"
			title="Tambahkan Kendaraan"
		>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Kendaraan Keluar</h2>
					</div>
					<div class="modal-body">
						<b-form @submit.prevent="addOut()">
							<div class="input-group">
								<select class="form-control" v-model="id" required>
									<option value="0" selected disabled>
										Pilih Kendaraan Keluar
									</option>
									<option
										v-for="stok in this.stok"
										:key="stok.id"
										:value="stok.id"
									>
										{{ stok.type }} - {{ stok.milik }} - {{ stok.plat }}
									</option>
								</select>
							</div>
							<b-button class="mt-3" type="submit" variant="primary"
								>Simpan</b-button
							>
						</b-form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from '../API/axios';
	import Swal from 'sweetalert2';
	export default {
		name: 'InOut',
		data() {
			return {
				id: 0,
				stok: [],
				type: '',
				milik: '',
				miliks: ['Pribadi', 'Kendaraan Dinas'],
				typeCar: ['Mobil', 'Motor', 'Pick Up', 'Truck'],
				plat: '',
				timeOut: '',
			};
		},
		created() {
			this.dataOut();
		},
		methods: {
			showAdd() {
				$('#addIn').modal('show');
			},
			showOut() {
				$('#addOut').modal('show');
				this.dataOut();
			},
			addOut(id) {
				console.log('Hhahahaha');
				return axios({
					url: 'data/out',
					method: 'patch',
					data: {
						id: this.id,
					},
				}).then((data) => {
					$('#addOut').modal('hide');
					Swal.fire('Terima Kasih', 'Data Berhasil Diubah', 'success');
					this.id = 0;
				});
			},
			dataOut() {
				return axios
					.get('/data/stock')
					.then((data) => {
						this.stok = data.data;
					})
					.catch((err) => {
						console.log(err);
					});
			},
			addIn() {
				let dataMasuk = {
					type: this.type,
					plat: this.plat,
					milik: this.milik,
				};
				return axios({
					url: 'data/in',
					method: 'post',
					data: dataMasuk,
				})
					.then((data) => {
						this.type = '';
						this.plat = '';
						Swal.fire('Terima Kasih', 'Data Berhasil Ditambahkan', 'success');
						$('#addIn').modal('hide');
					})
					.catch((err) => {
						console.log(err);
					});
			},
		},
	};
</script>

<style>
	.container {
		/* background-color: blueviolet; */
		min-height: 100vh;
	}
	img {
		max-width: 200px;
		margin-bottom: 10px;
	}
</style>
