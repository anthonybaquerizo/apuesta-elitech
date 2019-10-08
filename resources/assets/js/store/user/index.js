import state from '@store/user/state'
import actions from '@store/user/actions'
import mutations from '@store/user/mutations'
import getters from '@store/user/getters'

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}