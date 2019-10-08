import defaultState from '@store/match_day/state'

export default {
    /**
     * Limpia los datos del state
     * @param {*} state 
     */
    clearState (state) {
        Object.assign(state, defaultState())
    },
    /**
     * Guarda los datos del state
     * @param {*} state 
     * @param {*} data 
     */
    setState (state, data) {
        Object.assign(state, data)
    }
}