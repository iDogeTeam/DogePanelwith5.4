import Vue from 'vue'

import VueRouter from 'vue-router'
import Routes from './routes'

import Element from 'element-ui'
import 'element-ui/lib/theme-default/index.css'

import VueI18n from 'vue-i18n'
import i18n from './i18n'

// configure vue-router
Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'history',
    routes: Routes
})

// configure element-ui
Vue.use(Element)

// configure vue-i18n
Vue.use(VueI18n)
Vue.config.lang = 'en'
Vue.config.fallbackLang = 'en'
for (let lang in i18n) {
    Vue.locale(lang, i18n[lang])
}

// init vue and mount vue instance to real dom
new Vue({
    router,
    render: h => h('router-view')
}).$mount('#root')
