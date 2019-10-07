import initState from './state'

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
    }
}