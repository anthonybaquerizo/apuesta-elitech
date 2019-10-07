export default {
    /**
     * Consulta los datos de un usuario
     */
    getAuth ({ commit }) {
        axios.get('api/get_auth', {})
            .then(({ data }) => {
                commit('setState', data)
            })
            .catch((error) => {
                alert('Error al consultar el usuario')
            })
    }
}