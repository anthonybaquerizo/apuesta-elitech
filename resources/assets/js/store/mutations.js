export default {
    /**
     * Almacena una alerta a mostrar
     * @param {*} state 
     * @param {*} data 
     */
    addAlert (state, data) {
        state.alert.type = data.type || ''
        state.alert.title = data.title || ''
        state.alert.messages = data.messages || []
    },
    /**
     * Limpia la alerta
     * @param {*} state 
     */
    clearAlert (state) {
        state.alert.type = ''
        state.alert.title = ''
        state.alert.messages = []
    }
}