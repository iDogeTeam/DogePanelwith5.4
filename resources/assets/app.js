import Vue from 'vue'
import app from './components/App'
import VueRouter from 'vue-router'
import routes from './routes'
import Element from 'element-ui'
import VueI18n from 'vue-i18n'
import messages from './i18n'

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
const i18n = new VueI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages
})

// init vue and mount vue instance to real dom
new Vue({
    router,
    i18n,
    el: '#root',
    render: h => h(app)
})
