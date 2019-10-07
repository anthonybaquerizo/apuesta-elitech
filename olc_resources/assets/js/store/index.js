import Vue from 'vue'
import Vuex from 'vuex'

import user from '@store/modules/user/'
import match_response from '@store/modules/match_response/'
import match_day from '@store/modules/match_day/'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  getters: {},
  modules: {
    user,
    match_response,
    match_day
  }
})
