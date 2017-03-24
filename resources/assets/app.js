import Vue from 'vue'
import VueRouter from 'vue-router'
import Element from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import Routes from './routes'
// import VueI18n from 'vue-i18n'

/*
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}
*/

Vue.use(VueRouter)
Vue.use(Element)
// Vue.use(VueI18n)

const router = new VueRouter({
    mode: 'history',
    routes: Routes
})

new Vue({
    router,
    render: h => h('router-view')
}).$mount('#root')
