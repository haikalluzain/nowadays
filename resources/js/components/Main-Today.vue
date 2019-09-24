<template>
    <div>
        <h2 class="section-title">{{ moment().locale('id').format('DD MMMM YYYY') }}</h2>
        <p class="section-lead">Pada halaman ini anda bisa membuat daftar aktivitas pada hari ini.</p>
        <div class="row">
            <div class="col-12">
                <div class="activities">
                    <template v-if="!filtered.length">
                        <div class="alert alert-light ml-4">Belum ada jadwal untuk hari ini</div>
                    </template>

                    <template v-else>
                        <div class="activity" v-for="(today, index) in filtered" :key="today.id">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i style="font-style: normal;">{{ index + 1 }}</i>
                            </div>
                            <div class="activity-detail shadow-sm">
                                <template>
                                    <div class="mb-2">
                                        <span
                                            class="font-weight-bold text-primary h6">{{ today.start + ' - ' + today.end }}</span>
                                        <!-- <span class="bullet"></span>
                    <a class="text-job text-success h5" href="#">Sedang berlangsung</a>-->
                                        <div class="float-right dropdown ml-4">
                                            <a href="#" data-toggle="dropdown">
                                                <i class="fas fa-cog"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <div class="dropdown-title">Options</div>
                                                <a href="#"
                                                    @click.prevent="show_edit = index, edit.activity = today.activity, edit.start = today.start, edit.end = today.end, edit.id = today.id, errors_ = false"
                                                    class="dropdown-item has-icon">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item has-icon text-danger"
                                                    @click.prevent="hapus(today.id)">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="h6" v-if="show_edit != index">{{ today.activity }}</p>
                                </template>

                                <form @submit.prevent="update" v-show="show_edit == index">
                                    <div class="form-group mb-2">
                                        <label>Edit kegiatan</label>
                                        <textarea class="form-control" v-model="edit.activity" required
                                            autofocus></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Mulai - Selesai</label>
                                        <div class="input-group">
                                            <input type="time" class="form-control" v-model="edit.start" required />
                                            <input type="time" class="form-control" v-model="edit.end" required
                                                style="border-radius: 0px 5px 5px 0px" />
                                            <input type="hidden" class="form-control" v-model="edit.id" required />

                                            <div class="ml-2">
                                                <a href="#" class="btn btn-icon btn-danger" @click="show_edit = -1">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <button type="submit" class="btn btn-icon btn-success"
                                                    @click.prevent="update">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <template v-if="errors_">
                                        <div class="mt-3 mb-0 alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>×</span>
                                                </button>
                                                {{ er_message }}
                                            </div>
                                        </div>
                                    </template>
                                </form>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="col-md-12 mt-4 justify-content-center">
                    <div class="card shadow">
                        <div class="card-body">
                            <form @submit.prevent="add">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6">
                                        <label>Tambah kegiatan</label>
                                        <textarea class="form-control" v-model="today.activity" required
                                            autofocus></textarea>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label>Mulai - Selesai</label>
                                        <div class="input-group">
                                            <input type="time" class="form-control" v-model="today.start" required />
                                            <input type="time" class="form-control" v-model="today.end" required
                                                style="border-radius: 0px 5px 5px 0px" />
                                            <button type="submit" class="ml-4 btn btn-primary"
                                                @click.prevent="add">Tambah</button>
                                        </div>
                                    </div>
                                </div>

                                <template v-if="errors_ && show_edit == -1">
                                    <div class="mt-3 mb-0 alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>×</span>
                                            </button>
                                            {{ er_message }}
                                        </div>
                                    </div>
                                </template>
                            </form>
                        </div>
                    </div>

                    <!-- <button class="btn btn-primary" @click="add">Tambah</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require("moment");
    export default {
        mounted() {
            if (this.todays.length) {
                return;
            }
            this.$store.dispatch("getTodays");
        },
        data() {
            return {
                moment: moment,
                nowdate: moment().format("YYYY-MM-DD"),
                today: {
                    id: "",
                    activity: "",
                    start: "06:00",
                    end: "07:00"
                },
                edit: {
                    id: "",
                    activity: "",
                    start: "",
                    end: ""
                },
                errors_: false,
                er_message: "",
                show_edit: -1
            };
        },
        methods: {
            add() {
                this.errors_ = false;
                const {
                    activity,
                    start,
                    end
                } = this.$data.today;
                if (activity == "") {
                    this.errors_ = true;
                    this.er_message = "Harap isi kegiatan";
                } else if (start.valueOf() > end.valueOf()) {
                    this.errors_ = true;
                    this.er_message = "Waktu selesai tidak boleh sebelum dari waktu mulai";
                } else {
                    axios.post("../api/today/insert", this.$data.today).then(response => {
                        if (response.data.code == 200) {
                            iziToast.success({
                                title: "Berhasil!",
                                message: "kegiatan berhasil ditambahkan",
                                position: "topRight"
                            });
                            this.$store.dispatch("getTodays");
                            this.reset();
                        }
                    });
                }
            },
            reset() {
                this.today.activity = "";
                this.errors_ = false;
                this.show_edit = -1;
            },
            update() {
                const {
                    activity,
                    start,
                    end
                } = this.$data.edit;
                if (activity == "") {
                    this.errors_ = true;
                    this.er_message = "Harap isi kegiatan";
                } else if (start.valueOf() > end.valueOf()) {
                    this.errors_ = true;
                    this.er_message = "Waktu selesai tidak boleh sebelum dari waktu mulai";
                } else {
                    axios.post("../api/today/update", this.$data.edit).then(response => {
                        if (response.data.code == 200) {
                            iziToast.success({
                                title: "Berhasil!",
                                message: "kegiatan berhasil diubah",
                                position: "topRight"
                            });
                            this.$store.dispatch("getTodays");
                            this.reset();
                        }
                    });
                }
            },
            hapus(id) {
                swal({
                    title: "Hapus",
                    text: "Yakin ingin menghapus kegiatan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then(willDelete => {
                    if (willDelete) {
                        axios.delete("../api/today/delete/" + id).then(response => {
                            if (response.data.code == 200) {
                                iziToast.success({
                                    title: "Berhasil!",
                                    message: "kegiatan berhasil dihapus",
                                    position: "bottomLeft"
                                });
                                this.$store.dispatch("getTodays");
                                this.reset();
                            }
                        });
                    }
                });
            }
        },

        computed: {
            todays() {
                console.log(this.$store.getters.todays);
                return this.$store.getters.todays;
            },
            filtered() {
                return this.todays.filter(todays => {
                    return todays.date.match(this.nowdate);
                    // return console.log(this.redate)
                });
            }
        }
    };

</script>
