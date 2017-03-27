import Vue from 'vue'
import VueRouter from 'vue-router'
import Routes from './routes'
import Element from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import VueI18n from 'vue-i18n'
import i18n from './i18n'

/*
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}
*/

Vue.use(VueRouter)
Vue.use(Element)
Vue.use(VueI18n)
Vue.config.lang = 'en'
Object.keys(i18n).forEach(function (lang) {
    Vue.locale(lang, i18n[lang])
})

const router = new VueRouter({
    mode: 'history',
    routes: Routes
})

new Vue({
    router,
    render: h => h('router-view')
}).$mount('#root')
