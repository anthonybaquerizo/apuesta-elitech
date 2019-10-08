import defaultState from '@store/match_response/state'

export default {
     /**
     * Limpia los datos del state
     * @param {*} state 
     */
    clearState (state) {
        Object.assign(state, defaultState())
    },
    /**
     * SET el id y name de partido a participar
     * @param {*} state 
     * @param {*} param1 
     */
    setMatchDay (state, { id, name }) {
        state.match_day_id = id
        state.match_day = name
    }
}