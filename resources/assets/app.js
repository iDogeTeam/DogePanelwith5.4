import Vue from 'vue'
import app from './components/App'
import VueRouter from 'vue-router'
import routes from './routes'
import Element from 'element-ui'
import VueI18n from 'vue-i18n'
import i18n from './i18n'

// configure vue-router
Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'history',
    routes: routes
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
    el: '#root',
    render: h => h(app)
})
