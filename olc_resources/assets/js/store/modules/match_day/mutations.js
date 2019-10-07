import initState from '@store/modules/match_day/state'

export default {
    /**
     * Almacena los datos al state
     * @param {*} state 
     * @param {Object} data 
     */
    setState (state, data) {
        Object.assign(state, data);
    },
    /**
     * Limpia el state con los datos iniciales
     */
    clearState (state) {
        Object.assign(state, initState())
    },
    /**
     * Almacena las apuesta del día
     */
    setMatches (state, data) {
        state.matches = data;
    }
}