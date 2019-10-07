<template lang="pug">
    div.row
        div.col-12
            alert-message(
                :type-alert="alert.type",
                :title="alert.title",
                :messages="alert.messages"
            )
        div.col-12
            div.card
                div.card-header
                    h1.h4 Crear nuevo partido
                div.card-body
                    div.row.form-group
                        label.col-lg-4.col-md-4.col-sm-12.col-12(for="status") Estado
                        div.col-lg-4.col-md-4.col-sm-12.col-12
                            select.custom.custom-select#status(
                                v-model="$store.state.match_day.status"
                            )
                                option(value="2") Publico
                                option(value="3") Borrador
                    div.row.form-group
                        label.col-lg-4.col-md-4.col-sm-12.col-12(for="name") Partido
                        div.col-lg-8.col-md-8.col-sm-12.col-12
                            input.form-control#name(
                                type="text",
                                v-model="$store.state.match_day.name"
                            )
                div.card-footer
                    button.btn.btn-danger(
                        type="button",
                        @click="save()"
                        :disabled="loading"
                    ) 
                        <span v-if="loading" class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                        | <i class="fa fa-save" ></i> Gurdar
                    router-link.btn.btn-link(:to="{ name: 'home' }") Cancelar

</template>

<script>
export default {
    name: 'Create',
    methods: {
        save () {
            this.loading = true
            axios.post('api/store_match_day', {
                name: this.$store.state.match_day.name,
                status: this.$store.state.match_day.status
            })
                .then(({ data }) => {
                    this.alert.type = 'alert-success'
                    this.alert.title = ''
                    this.alert.messages.push([data.message])
                    this.$store.commit('match_day/clearState')
                })
                .catch((error) => {
                    const response = this.catchError(error)
                    console.log(response)
                    this.alert.type = 'alert-danger'
                    this.alert.title = 'Cumpla lo siguiente:'
                    this.alert.messages = response
                })
                .finally(() => {
                    this.loading = false
                    this.closeAlert()
                })
        }
    }
}
</script>