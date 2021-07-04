import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './components/App'
import store from './store'
import BootstrapVue from 'bootstrap-vue'
import Notifications from 'vue-notification'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Employees from './components/Employees'

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(Notifications);

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {
            path: '/',
            redirect: { name: 'employees' }
        },
        {
            path: '/employees',
            component: Employees,
            name: 'employees'
        },
        {
            path: '/employees/:id',
            component: Employees,
            name: 'department'
        },
    ]
})

const app = new Vue({
    el: '#app',
    router,
    store,
    render: (h) => h(App),
})
