import Vue from "vue";

import '@/plugins/vuex'

import { router } from '@/plugins/vue-router'
import App from '@/App.vue'
import store from '@/store'


new Vue({
    el: '#my-app',
    store,
    router,
    render: h => h(App)
});
