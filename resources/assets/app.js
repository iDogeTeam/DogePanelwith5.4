import Vue from 'vue'
import axios from 'axios'

axios.defaults.headers.common = {
//    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}

Vue.component('example', require('./components/Example.vue'))

const app = new Vue({
    el: '#app'
})
