<template>
    <div>
        <section class="section">
            <div class="section-header">
                <h1>Calendar</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Kegiatan</a></div>
                    <div class="breadcrumb-item">Kalender</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Buat acara baru</h2>
                <p class="section-lead">
                    Pada halaman ini anda bisa membuat acara baru dengan menekan salah satu tanggal pada kalender atau
                    tekan
                    tombol <span class="text-primary">Add Event</span> di bawah ini.
                </p>

                <div class="card shadow">
                    <div class="card-body">
                        <full-calendar ref="calendar" :config="config" @event-render="eventRender" :header="header"
                            @day-click="dayClick" @event-selected="eventClick" :events="events">
                        </full-calendar>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-add">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="!dayEdit" class="modal-title">Add Event</h5>
                        <h5 v-else class="modal-title">Update Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate="">
                        <div class="modal-body pb-0">
                            <div class="form-group row">
                                <label class="font-weight-bold col-md-3">Title</label>
                                <div class="col-md-9">
                                    <input placeholder="" name="title" type="text" class="form-control"
                                        :class="{ 'is-invalid': errors.has('title') }" v-model="event.title" autofocus>

                                    <span class="invalid-feedback"
                                        v-show="errors.has('title')">{{ errors.first('title') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="font-weight-bold col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea id="" v-model="event.description" name="desc" class="form-control"
                                        :class="{ 'is-invalid': errors.has('desc') }"></textarea>

                                    <span class="invalid-feedback"
                                        v-show="errors.has('desc')">{{ errors.first('desc') }}</span>
                                </div>
                            </div>

                            <div class="alert alert-info show fade">
                                <div class="alert-body">

                                    Pilih tanggal mulai dan selesai pada kalender!
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-8">
                                    <v-date-picker is-inline mode='range' v-model='selectedDate' show-caps
                                        :formats="formats" :select-attribute="attrs" :theme-styles='themeStyles'
                                        :pane-width="280" @dayclick="cek" :attributes='attributes'>
                                    </v-date-picker>
                                </div>
                                <div class="col-4 pl-0">
                                    <label class="font-weight-bold">Mulai</label>
                                    <ul class="list-group">
                                        <li class="list-group-item px-1 py-2 text-center">
                                            {{ moment(event.start).locale('id').format('dddd, D MMM YYYY') }}</li>
                                    </ul>

                                    <label class="font-weight-bold mt-3">Selesai</label>
                                    <ul class="list-group">
                                        <li class="list-group-item px-1 py-2 text-center">
                                            {{ moment(event.end).locale('id').format('dddd, D MMM YYYY') }}</li>
                                    </ul>

                                    <label class="form-label font-weight-bold mt-3">Event Color</label>
                                    <div class="row gutters-xs">
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input type="checkbox" checked value="primary" id="colorPrimary"
                                                    @click="colorChange('primary')" class="colorinput-input">
                                                <span class="colorinput-color bg-primary"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input type="checkbox" value="danger" id="colorDanger"
                                                    @click="colorChange('danger')" class="colorinput-input">
                                                <span class="colorinput-color bg-danger"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input type="checkbox" value="warning" id="colorWaring"
                                                    @click="colorChange('warning')" class="colorinput-input">
                                                <span class="colorinput-color bg-warning"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input type="checkbox" value="info" id="colorInfo"
                                                    @click="colorChange('info')" class="colorinput-input">
                                                <span class="colorinput-color bg-info"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input type="checkbox" value="success" id="colorSuccess"
                                                    @click="colorChange('success')" class="colorinput-input">
                                                <span class="colorinput-color bg-success"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                </div>
                                <input type="hidden" v-model="event.color">
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <div class="mr-auto" v-show="dayEdit">
                                <button class="btn btn-danger" @click.prevent="deleteEvent(event.id)"><i
                                        class="fas fa-trash"></i>
                                    Hapus</button>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-if="!dayEdit" type="button" class="btn btn-primary"
                                @click.prevent="addEvent">Submit</button>
                            <button v-else type="button" class="btn btn-success" @click.prevent="updateEvent">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        mounted() {
            if (this.events.length) {
                return;
            }
            this.$store.dispatch('getEvents');
            setTimeout(function () {
                location.reload();
            }, 900000)
        },
        data() {
            return {
                moment: moment,
                filter: '',
                config: {
                    contentHeight: 750,
                    selectable: true,
                    defaultView: 'month',
                    eventLimit: 3,
                    locale: 'id',
                    displayEventTime: false,
                    customButtons: {
                        add: {
                            text: 'Add Event',
                            click: () => {
                                this.openAddForm()
                            }
                        },
                    }

                },
                header: {
                    left: 'prev,next add',
                    center: 'title',
                    right: 'month'
                },

                event: {
                    id: '',
                    title: '',
                    description: '',
                    start: moment().format('YYYY-MM-DD'),
                    end: moment().add(2, 'days').format('YYYY-MM-DD'),
                    color: '#6777ef'
                },
                dayClicked: false,
                dayEdit: false,
                selectedDate: {
                    start: '',
                    end: ''
                },
                themeStyles: {
                    wrapper: {
                        backgroundColor: '#fff',
                        border: '1px solid rgba(0,0,0,.100)',
                        borderRadius: '4px',
                        fontFamily: '"Nunito", "Segoe UI", arial'
                    },
                    headerHorizontalDivider: {
                        borderTop: 'solid rgba(255, 255, 255, 0.2) 1px',
                        width: '80%',
                    },
                    header: {
                        padding: '15px',
                    },
                    weekdays: {
                        padding: '0 15px 0 15px'
                    },
                    weeks: {
                        padding: '15px',
                    },

                },
                attrs: {
                    highlight: {
                        backgroundColor: '#6777ef',

                    },
                    highlightCaps: {
                        backgroundColor: '#fff',
                        borderWidth: '2px',
                        borderColor: '#6777ef',
                        borderStyle: 'solid',
                    }
                },
                attributes: [{
                    highlight: {
                        backgroundColor: '#d2e3fc',
                    },
                    contentStyle: {
                        color: '#6777ef',
                    },
                    dates: [
                        new Date(Date.now())
                    ]
                }, ],
                formats: {
                    input: 'YYYY-MM-DD'
                }

            }
        },
        methods: {
            openList() {
                $('#modal-list').modal('show')
            },
            cek(day) {
                if (day.attributes[0] == undefined) {
                    this.event.start = moment(day.dateTime).format('ll');
                    this.event.end = moment(day.dateTime).format('ll');
                } else {
                    this.event.start = moment(day.attributes[0].dates[0].startTime).format('ll');
                    this.event.end = moment(day.attributes[0].dates[0].endTime).format('ll');
                }

            },
            eventRender(eventObj, element) {
                $(element).popover({
                    title: eventObj.title,
                    content: eventObj.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body'
                });
            },
            dayClick(date) {
                this.openAddForm();
                this.event.start = moment(date.format()).format('ll');
                this.event.end = moment(date.format()).format('ll');
                this.selectedDate = {
                    start: new Date(moment(date.format()).format("L")),
                    end: new Date(moment(date.format()).format("L"))
                };

            },
            eventClick(event) {
                this.openAddForm();
                this.dayEdit = true;
                this.event.id = event.id;
                this.event.title = event.title;
                this.event.description = event.description;
                this.event.color = event.color;
                if (event.start._i == undefined) {
                    this.event.start = event.start;
                    this.event.end = event.end;
                } else if (event.end == null) {
                    this.event.start = event.start._i;
                    this.event.end = event.start._i;

                } else {
                    this.event.start = event.start._i;
                    this.event.end = event.end._i;
                }
                this.selectedDate = {
                    start: new Date(moment(this.event.start).format("L")),
                    end: new Date(moment(this.event.end).format("L"))
                }
                // console.log(event.end)
                $(".colorinput-input").prop('checked', false);
                switch (event.color) {
                    case '#6777ef':
                        $("#colorPrimary").prop('checked', true);
                        break;
                    case '#fc544b':
                        $("#colorDanger").prop('checked', true);
                        break;
                    case '#3abaf4':
                        $("#colorInfo").prop('checked', true);
                        break;
                    case '#ffa426':
                        $("#colorWaring").prop('checked', true);
                        break;
                    case '#63ed7a':
                        $("#colorSuccess").prop('checked', true);
                        break;
                };


            },
            fresh() {
                this.errors.clear();
                this.event.id = '';
                this.event.title = '';
                this.event.description = '';
                this.dayClicked = false
                this.dayEdit = false

                $(".colorinput-input").prop('checked', false);
                $("#colorPrimary").prop('checked', true);
                this.event.color = '#6777ef'

            },
            refreshEvents() {
                this.$store.dispatch('getEvents');
                this.$refs.calendar.$emit('refetch-events')
            },
            openAddForm() {
                this.fresh();
                this.selectedDate = {
                    start: new Date(moment().format('L')),
                    end: new Date(moment().add(2, 'days').format('L'))
                };
                this.event.start = moment().format('ll');
                this.event.end = moment().format('ll');
                $('#modal-list').modal('hide');
                $('#modal-add').modal('show');
                $(".colorinput-input").change(function () {
                    $(".colorinput-input").prop('checked', false);
                    $(this).prop('checked', true);
                });
            },
            colorChange(color) {
                this.event.color = color
            },
            addEvent() {
                this.event.start = moment(this.event.start).format("YYYY-MM-DD");
                this.event.end = moment(this.event.end).format("YYYY-MM-DD");
                switch (this.event.color) {
                    case '#6777ef':
                        this.event.color = "primary"
                        break;
                    case '#fc544b':
                        this.event.color = "danger"                        
                        break;
                    case '#3abaf4':
                        this.event.color = "info"                        
                        break;
                    case '#ffa426':
                        this.event.color = "warning"                        
                        break;
                    case '#63ed7a':
                        this.event.color = "success"                        
                        break;
                };
                if (this.event.title == '') {
                    this.errors.add({
                        field: 'title',
                        msg: 'Harap isi title dahulu!'
                    })

                    if (this.event.description == '') {
                        this.errors.add({
                            field: 'desc',
                            msg: 'Harap isi deskripsi dahulu!'
                        })
                    }
                } else if (this.event.description == '') {

                    this.errors.add({
                        field: 'desc',
                        msg: 'Harap isi deskripsi dahulu!'
                    })
                } else {
                    axios.post('../api/event/insert', this.$data.event)
                        .then((response) => {
                            if (response.data.code == 200) {
                                $('#modal-add').modal('hide');
                                iziToast.success({
                                    title: 'Berhasil!',
                                    message: 'kegiatan berhasil ditambahkan',
                                    position: 'topRight'
                                });
                                this.refreshEvents();
                                this.fresh();

                            }
                        })

                }
            },
            updateEvent() {
                this.event.start = moment(this.event.start).format("YYYY-MM-DD");
                this.event.end = moment(this.event.end).format("YYYY-MM-DD");
                switch (this.event.color) {
                    case '#6777ef':
                        this.event.color = "primary"
                        break;
                    case '#fc544b':
                        this.event.color = "danger"                        
                        break;
                    case '#3abaf4':
                        this.event.color = "info"                        
                        break;
                    case '#ffa426':
                        this.event.color = "warning"                        
                        break;
                    case '#63ed7a':
                        this.event.color = "success"                        
                        break;
                };
                if (this.event.title == '') {
                    this.errors.add({
                        field: 'title',
                        msg: 'Harap isi title dahulu!'
                    })

                    if (this.event.description == '') {
                        this.errors.add({
                            field: 'desc',
                            msg: 'Harap isi deskripsi dahulu!'
                        })
                    }
                } else if (this.event.description == '') {
                    this.errors.add({
                        field: 'desc',
                        msg: 'Harap isi deskripsi dahulu!'
                    })
                } else {
                    axios.post('../api/event/update', this.$data.event)
                        .then((response) => {
                            if (response.data.code == 200) {
                                $('#modal-add').modal('hide');
                                iziToast.info({
                                    title: 'Berhasil!',
                                    message: 'kegiatan berhasil diupdate',
                                    position: 'topRight'
                                });
                                this.refreshEvents();
                                this.fresh();
                            }
                        })

                }
            },
            deleteEvent(id) {
                swal({
                        title: 'Hapus',
                        text: 'Yakin ingin menghapus event?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.delete('../api/event/delete/' + id)
                                .then((response) => {
                                    if (response.data.code == 200) {
                                        iziToast.success({
                                            title: 'Berhasil!',
                                            message: 'Event berhasil dihapus',
                                            position: 'bottomLeft'
                                        });
                                        $('#modal-add').modal('hide')
                                        this.refreshEvents();
                                    }
                                })
                        }
                    })
            }
        },

        computed: {
            events() {
                let data = this.$store.getters.events;
                if (data.length) {
                    for (var i = 0; i < data.length; i++) {
                        data[i].end += "T09:00"
                        switch (data[i].color) {
                            case 'primary':
                                data[i].color = "#6777ef"
                                break;
                            case 'danger':
                                data[i].color = "#fc544b"
                                break;
                            case 'info':
                                data[i].color = "#3abaf4"
                                break;
                            case 'warning':
                                data[i].color = "#ffa426"
                                break;
                            case 'success':
                                data[i].color = "#63ed7a"
                                $("#colorSuccess").prop('checked', true);
                                break;
                        };
                    }
                }
                return data;
            },
        }
    }

</script>
