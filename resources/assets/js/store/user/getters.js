export default {
    /**
     * Verifica si el usuario es admin
     */
    isAdmin (state) {
        return state.user_type_id == 1
    }
}