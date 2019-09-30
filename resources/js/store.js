export default {
    state: {
        todays: [],
        admins: [],
        events: []
    }, 
    getters: {
        todays(state) {
            return state.todays
        },
        admins(state) {
            return state.admins
        },
        events(state) {
            return state.events
        },
    },
    mutations: {
        updateTodays(state, payload) {
            state.todays = payload
        },
        updateAdmins(state, payload) {
            state.admins = payload
        },
        updateEvents(state, payload) {
            state.events = payload
        },
    },
    actions: {
        getTodays(context) {
            axios.get('../api/today/all')
                .then((response) => {
                    context.commit('updateTodays', response.data.todays);
                })
        },
        getAdmins(context) {
            axios.get('../api/user/show')
                .then((response) => {
                    context.commit('updateAdmins', response.data.data);
                })
        },
        getEvents(context) {
            axios.get('../api/event/all')
                .then((response) => {
                    context.commit('updateEvents', response.data.events);
                })
        },

    }
}
