<template>
	<div>
		<section class="section">
	        <div class="section-header">
	        	<h1>Admin</h1>
	        </div>

	        <div class="section-body">

	        	<h2 class="section-title">Daftar Admin</h2>
		        	<p class="section-lead">
		            	Pada halaman ini anda bisa menambah, mengubah atau bahkan menghapus admin. Akses ini hanya diberikan kepada <span class="font-weight-bold">Super Admin</span> 
		        	</p>

				<div class="card shadow">
		            <div class="card-header">
		                <h4>Table</h4>
		                <div class="card-header-form">
		                    <button class="btn btn-info" @click.prevent="show">Tambah</button>
		                </div>
		            </div>
		            <div class="card-body p-0">
		                <table class="table">
		                    <thead>
		                        <tr>
		                          	<th scope="col">#</th>
		                          	<th scope="col">Name</th>{{ name }}
		                          	<th scope="col">Email</th>
		                          	<th scope="col">Opsi</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	<template v-if="!admins.length">
		                    		<tr>
		                    			<td class="text-center font-weight-bold" colspan="4">Belum ada data</td>
		                    		</tr>
		                    	</template>
		                        <template v-else>
		                        	<tr v-for="(admin, index) in admins" :key="admin.id">
				                        <th scope="row">{{ index + 1 }}</th>
				                        <td>{{ admin.name }}</td>
				                        <td>{{ admin.email }}</td>
			                        	<td>
				                            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
				                            <a class="btn btn-danger btn-action trigger--fire-modal-1" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
				                        </td>
			                        </tr>
		                        </template>
		                    </tbody>
		                </table>
		            </div>
		        </div>
	        </div>
	    </section>

		

	    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	              	<div class="modal-header">
	                	<h5 class="modal-title">New Admin</h5>
	                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                  		<span aria-hidden="true">×</span>
	                	</button>
	              	</div>
	              	<form class="needs-validation" novalidate="">
		              	<div class="modal-body">
			              	<div class="form-group">
			                    <label>Name</label>
			                    <input v-validate="'required'" name="name" type="text" class="form-control" :class="{ 'is-invalid': errors.has('name') }" v-model="admin.name" autofocus>

								<span class="invalid-feedback" v-show="errors.has('name')">{{ errors.first('name') }}</span>
			                </div>
			                <div class="form-group">
			                    <label>Email</label>
			                    <input v-validate="'required|email'" name="email" type="email" class="form-control" v-model="admin.email" :class="{ 'is-invalid': errors.has('email') }">
			                    <span class="invalid-feedback" v-show="errors.has('email')">{{ errors.first('email') }}
			                    </span>
			                </div>
			                <div class="form-group">
			                    <label>Password</label>
			                    <input v-validate="'required|min:6'" name="password" type="password" class="form-control" :class="{ 'is-invalid': errors.has('password') }" v-model="admin.password" autofocus>
			                    				
								<span class="invalid-feedback" v-show="errors.has('password')">{{ errors.first('password') }}</span>
			                </div>
			          		<div class="form-group mb-0">
			            		<label>Confirm password</label>
			            		<input v-validate="'required'" name="confirm" v-model="admin.confirm" type="password" class="form-control" :class="{ 'is-invalid': errors.has('confirm') }" autofocus>
			                    				
								<span class="invalid-feedback" v-show="errors.has('confirm')">{{ errors.first('confirm') }}</span>
			          		</div>
			            </div>
		              	<div class="modal-footer bg-whitesmoke br">
		                	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                	<button type="button" class="btn btn-primary" @click.prevent="add">Save changes</button>
		              	</div>
		            </form>
	            </div>
	        </div>
	    </div>
	</div>
</template>

<script>
	export default {
		mounted() {
			if (this.admins.length) {
                return;
            }
            this.$store.dispatch('getAdmins');
		},
		data() {
			return {
				admin: {
					name: '',
					email: '',
					password: '',
					confirm: ''
				},

			}
		},
		methods: {
			show() {
				this.errors.clear();
				$('#modal').modal('show')
			},

			add() {
				this.$validator.validateAll().then((result) => {
					if (result) {
						if (this.admin.password != this.admin.confirm) {
							this.errors.add({
				                field: 'confirm',
				                msg: 'Konfirmasi password tidak cocok!'
				            })
						}else{
							axios.post('/nowadays/public/api/user/add-admin', this.$data.admin)
							.then((response) =>{
								if (response.data.code == 200) {
									$('#modal').modal('hide');
									this.$store.dispatch('getAdmins')
									swal('Berhasil','Admin berhasil ditambahkan','success');
									
								}else{
									this.errors.add({
						                field: 'email',
						                msg: 'email telah digunakan!'
						            })
								}
							})
						}
					}

				})
			}
		},

		computed: {
			admins() {
                return this.$store.getters.admins
            }
		}
 	}
</script>