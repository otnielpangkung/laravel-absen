<template>
	<div class="main">
		<div class="tableView">
			<div class="overflow-auto">
				<b-pagination
					v-model="currentPage"
					:total-rows="dataLength"
					:per-page="perPage"
					aria-controls="my-table"
				></b-pagination>

				<b-table
					id="my-table"
					:items="data"
					:per-page="perPage"
					:current-page="currentPage"
					:fields="fields"
					striped
					small
				>
					<template #cell(date)="row">
						{{ formatTanggal(row.item.timeIn) }}
					</template>
					<template #cell(kendaraan)="row">
						{{ row.item.type }} - {{ row.item.milik }}
					</template>
					<template #cell(checkIn)="row">
						{{ formatJam(row.item.timeIn) }}
					</template>
					<template #cell(checkOut)="row">
						<i v-if="row.item.timeOut">
							{{ formatJam(row.item.timeOut) }}
						</i>
					</template>
					<template #cell(delete)="row">
						<a @click.prevent="confirmDelete(row.item.id)">
							<b-button variant="outline-danger">Hapus</b-button>
						</a>
					</template>
				</b-table>
			</div>
		</div>
	</div>
</template>

<script>
	import axios from '../API/axios';
	import moment from 'moment';
	import Swal from 'sweetalert2';

	export default {
		name: 'Data',
		data() {
			return {
				currentPage: 1,
				perPage: 30,
				data: [],
				dataLength: 0,
				fields: [
					{ key: 'kendaraan', label: 'Kendaraan' },
					{ key: 'plat', label: 'Plat Nomor' },
					{
						key: 'date',
						label: 'Tanggal',
					},
					{
						key: 'checkIn',
						label: 'Jam Masuk',
					},
					{
						key: 'checkOut',
						label: 'Jam Keluar',
					},
					{
						key: 'delete',
						label: 'Hapus',
					},
				],
			};
		},
		created() {
			this.getData();
		},
		methods: {
			getData() {
				return axios({
					method: 'get',
					url: 'data',
					params: {
						page: this.currentPage,
						limit: this.perPage,
					},
				})
					.then((data) => {
						this.data = data.data.data2.result;
						this.dataLength = data.data.data2.dataLength;
					})
					.catch((err) => {
						console.log(err);
						alert('Periksa Kembali data anda');
					});
			},
			confirmDelete(id) {
				Swal.fire({
					title: 'Yakin?',
					text: 'Apakah Yakin ',
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Hapus!!',
				}).then((result) => {
					if (result.isConfirmed) {
						this.deleteData(id);
						this.$store.dispatch('getTransaksiUser');
						Swal.fire('Deleted!', 'Data Berhasil Dihapus', 'success');
						// this.$router.push("/report/transaksi");
					} else {
						Swal.fire('Ok', 'Proses anda berhasil dibatalkan', 'error');
					}
				});
			},
			deleteData(id) {
				return axios.delete(`data/${id}`).then((data) => {
					this.getData();
				});
			},
			formatTanggal(data) {
				let hasil = '';

				hasil = moment(data).format('DD-MM-YYYY');

				return hasil;
			},
			formatJam(data) {
				console.log(data, '=========');

				let hasil = moment(data).format('HH:mm:ss');

				return hasil;
			},
		},
	};
</script>

<style>
	table {
		font-size: 15px;
	}
	/* button {
		height: 30px;
	} */

	table template {
		max-height: 20px;
	}
</style>
