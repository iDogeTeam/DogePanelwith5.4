import Vue from 'vue'
import app from './components/app'
import VueRouter from 'vue-router'
import routes from './route'
import Element from 'element-ui'
import VueI18n from 'vue-i18n'
import messages from './i18n'
import {locale, fallbackLocale, routerMode} from './config'

// configure vue-router
Vue.use(VueRouter)
const router = new VueRouter({
    mode: routerMode,
    routes
})

// configure element-ui
Vue.use(Element)

// configure vue-i18n
Vue.use(VueI18n)
const i18n = new VueI18n({
    locale,
    fallbackLocale,
    messages
})

/* eslint-disable no-new */
new Vue({
    router,
    i18n,
    el: '#root',
    render: h => h(app)
})
