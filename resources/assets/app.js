import Vue from 'vue'
// import VueRouter from 'vue-router'
// import VueI18n from 'vue-i18n'

import { Rate } from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
// import enLocale from 'element-ui/lib/locale/lang/en'
// import zhLocale from 'element-ui/lib/locale/lang/zh-CN'

import axios from 'axios'
// import _ from 'lodash'

import example from './components/Example'

axios.defaults.headers.common = {
//    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}

// Vue.use(VueRouter)
// Vue.use(VueI18n)
Vue.use(Rate)

// Vue.config.lang = 'zh-cn'

// Vue.locale('zh-cn', zhLocale)
// Vue.locale('en', enLocale)

new Vue({
    el: '#root',
    render: h => h(example)
})
