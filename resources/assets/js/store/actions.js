export default {
    /**
     * Elimina la alerta despues de 5seg
     * @param {*} param0 
     */
    clearAlert ({ commit }) {
        setTimeout(() => {
            commit('clearAlert')
        }, 5000)
    }
}