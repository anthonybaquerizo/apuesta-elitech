<template lang="pug" >
div.row.justify-content-center
    div.col-lg-6.col-md-6.col-sm-12.col-12
        div.card
            div.card-header
                h3 Editar Partido
            div.card-body
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="status"
                    ) Estado
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        select.custom-select.custom-select-sm#status(
                            v-model="$store.state.match_day.status"
                        )
                            option(value="1") Terminado
                            option(value="2") Publico
                            option(value="3") Borrador
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="name"
                    ) Nombre
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#name(
                            type="text",
                            maxlength="250",
                            v-model="$store.state.match_day.name",
                            @keyup.enter="save()"
                        )
            div.card-footer
                button.btn.btn-danger.btn-sm(
                    type="button",
                    @click="save()",
                    :disabled="loading"
                ) 
                    div.spinner-border.spinner-border-sm.text-primary(
                        role="status",
                        v-if="loading"
                    )
                        span.sr-only Loading...
                    i.fa.fa-save(v-else)
                    |  Guardar
                router-link.btn.btn-link.btn-sm(
                    :to="{ name: 'path_match_index' }"
                ) Cancelar
</template>

<script>
export default {
    name: 'Create',
    data () {
        return {
            loading: false
        }
    },
    mounted () {
        var id = this.$route.params.id
        axios.get('api/match_day/edit/' + id, {})
            .then(({ data }) => {
                this.$store.commit('match_day/setState', data)
            })
            .catch((error) => {
                console.log(error)
            })
    },
    methods: {
        save () {
            this.loading = true
            axios.put('api/match_day/update', {
                id: this.$store.state.match_day.id,
                name: this.$store.state.match_day.name,
                status: this.$store.state.match_day.status
            })
                .then(({ data }) => {
                    this.$store.commit('match_day/clearState')
                    this.$router.push({ name: 'path_match_index', params: {
                        type: 'alert-success',
                        title: 'Editado',
                        messages: [[data.message]]
                    }})
                })
                .catch((error) => {
                    const messages = this.catchError(error)
                    this.$store.commit('addAlert', {
                        type: 'alert-danger',
                        title: 'Cumpla lo siguiente',
                        messages: messages
                    })
                })
                .finally(() => {
                    this.loading = false
                    this.$store.dispatch('clearAlert')
                })
        }
    }
}
</script>

<style>

</style>