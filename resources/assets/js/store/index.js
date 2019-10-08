import Vue from 'vue'
import Vuex from 'vuex'

import state from '@store/state'
import mutations from '@store/mutations'
import getters from '@store/getters'
import actions from '@store/actions'

// User
import user from '@store/user/'
import match_day from '@store/match_day/'
import match_response from '@store/match_response/'

Vue.use(Vuex)

export default new Vuex.Store({
  state,
  mutations,
  actions,
  getters,
  modules: {
    user,
    match_day,
    match_response
  }
})
