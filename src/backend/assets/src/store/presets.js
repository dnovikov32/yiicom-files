import Vue from 'vue';

export default {
    namespaced: true,

    state: {
        grid: null,
        model: {}
    },

    getters: {
        grid (state) {
            return state.grid;
        },
        model (state) {
            return state.model;
        }
    },

    mutations: {
        ['FETCH_ALL_SUCCESS'] (state, data) {
            state.grid = data;
        },
        ['FETCH_MODEL_SUCCESS'] (state, data) {
            state.model = data;
        },
        ['DELETE_MODEL_SUCCESS'] (state, data) {
            state.model = {};
        },
        ['DELETE_PRESET_FILES_SUCCESS'] (state, data) {

        }
    },

    actions: {
        all ({state, commit, rootState}, params) {
            return Vue.axios.get('/files/api/v1/preset/index', {params: params})
                .then(
                    response => commit('FETCH_ALL_SUCCESS', response.data),
                    error => {}
                )
        },

        find ({state, commit, rootState}, id) {
            return Vue.axios.get('/files/api/v1/preset/find', {params: {id: id}})
                .then(
                    response => commit('FETCH_MODEL_SUCCESS', response.data),
                    error => {}
                )
        },

        save ({state, commit, rootState}, model) {
            return Vue.axios.post('/files/api/v1/preset/save', model)
                .then(
                    response => commit('FETCH_MODEL_SUCCESS', response.data),
                    error => {}
                )
        },

        delete ({state, commit, rootState}, id) {
            return Vue.axios.post('/files/api/v1/preset/delete', { id: id })
                .then(
                    response => commit('DELETE_MODEL_SUCCESS', response.data),
                    error => {}
                )
        },

        deletePresetFiles ({state, commit, rootState}, ids) {
            return Vue.axios.post('/files/api/v1/preset/delete-preset-files', { ids: ids })
                .then(
                    response => commit('DELETE_PRESET_FILES_SUCCESS', response.data),
                    error => {}
                )
        }
    }
};