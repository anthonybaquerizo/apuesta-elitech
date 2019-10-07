import state from '@store/modules/user/state'
import mutations from '@store/modules/user/mutations'
import actions from '@store/modules/user/actions'
import getters from '@store/modules/user/getters'

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}