<template>
    <div>
        <h2 class="section-title">Daftar Seluruh Aktifitas</h2>
        <p class="section-lead">
            Pada halaman ini anda bisa melihat daftar sejarah aktivitas yang telah dibuat.
        </p>
        <div class="row">
            

            <div class="col-lg-4 mt-3 text-center">
                    
                <v-date-picker v-model="today.date" is-inline :formats="formats" :theme-styles='themeStyles' :pane-width="280" :select-attribute="attribute" :attributes="attrs" title-position="left" @dayclick="cek">
                </v-date-picker>
            </div>

            <div class="col-lg-8 mt-3 justify-content-center">
                <div class="card shadow">
                <div class="card-header">
                  <h4>Recent Activities</h4>
                  <div class="card-header-form">
                        <h4 v-if="showall">Semua</h4>
                        <h4 v-else>{{ moment(this.today.date).locale('id').format('dddd, DD MMMM YYYY') }}</h4>
                    </div>
                </div>
                <div class="card-body">             
                  <ul class="list-unstyled list-unstyled-border">
                    <template v-if="!filtered.length">
                        <div class="alert alert-light">
                           Tidak ada data
                        </div>
                    </template>

                    <template v-else>
                        <li class="media" v-for="today in filtered" :key="today.id">
                          <div class="media-body">
                            <div v-if="showall" class="float-right">{{ moment(today.date).locale('id').format('dddd, DD MMMM YYYY') }}</div>
                            <div class="media-title text-primary">{{ today.start }}</div>
                            <span class="text-muted">{{ today.activity }}</span>
                          </div>
                        </li>
                    </template>
                  </ul>
                  <div class="text-center pt-1 pb-1" v-if="this.today.date != ''">
                    <a href="#" class="btn btn-primary btn-round" @click.prevent="showAll">
                      View All
                    </a>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');

    export default {
        mounted() {
            if (this.todays.length) {
                return;
            }
            this.$store.dispatch('getTodays');
            this.showDate();

        },
        data(){
            return {
                
                moment:moment,
                showall:false,
                redate: moment().format('YYYY-MM-DD'),
                today: {
                    id: '',
                    activity: '',
                    start: '2019-01-25',
                    date: new Date(Date.now()),
                },

                errors_: false,
                er_message: '',
                show_edit: -1,
                mydate: new Date(),

                themeStyles: {
                    wrapper: {
                      backgroundColor: '#fff',
                      border: '0',
                      borderRadius: '4px',
                      boxShadow: '0 4px 8px rgba(0, 0, 0, 0.13)',
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
                attribute: {
                    contentStyle: {
                        backgroundColor: '#6777ef'
                    }
                },
                attrs: [
                    {
                        highlight: {
                            backgroundColor: '#d2e3fc',
                        },
                        contentStyle: {
                            color: '#6777ef',
                        },
                        dates: [
                            new Date(Date.now())
                        ]
                    },
                    {
                        dot: {
                            backgroundColor: "#ffc107",
                        },
                        dates: [
                            new Date(Date.now())
                            
                        ]
                    }
                ],
                formats: {input: 'YYYY-MM-DD'}
            };
        },
        methods: {
            showDate() {
                // console.log(this.what)
            },
            cek(day) {
                this.showall = false;
                this.redate = moment(day.dateTime).format('YYYY-MM-DD');
                // this.$forceUpdate();
                
            },
            showAll() {
                this.showall = true;
            }
        },

        computed: {
            todays() {
                return this.$store.getters.todays;
            },
            filtered() {
                return this.todays.filter((todays) => {
                    if (this.showall == true) {
                        return todays;
                    }
                    else{
                        return todays.date.match(this.redate)
                    }
                    
                });
            },
        }
    }
</script>
