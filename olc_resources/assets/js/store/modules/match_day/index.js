import state from '@store/modules/match_day/state'
import getters from '@store/modules/match_day/getters'
import mutations from '@store/modules/match_day/mutations'
import actions from '@store/modules/match_day/actions'

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}