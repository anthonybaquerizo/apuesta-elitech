import Vue from 'vue'
import store from '@store/'
import router from '@route/'
import App from '@/App.vue'

import AlertMixin from '@mixin/Alert'

Vue.mixin(AlertMixin)

require('./bootstrap')

new Vue({
    store,
    router,
    render: h => h(App)
}).$mount('#app')
