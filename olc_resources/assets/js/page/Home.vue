<template lang="pug" >
div.row
    div.col-12
        alert-message(
            :type-alert="alert.type",
            :title="alert.title",
            :messages="alert.messages"
        )
    div.col-lg-7.col-md-7.col-sm-5.col-12
        div.card
            div.card-header
                h1.h4 Perfil del Participante
            div.card-body
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-12.col-12(for="email") Email
                    div.col-lg-8.col-md-8.col-sm-12.col-12
                        input.form-control#email(
                            type="text",
                            disabled="true",
                            v-model="$store.state.user.email"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-12.col-12(for="name") Nombre
                    div.col-lg-8.col-md-8.col-sm-12.col-12
                        input.form-control#name(
                            type="text",
                            v-model="$store.state.user.name"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-12.col-12(for="last_name") Apellido
                    div.col-lg-8.col-md-8.col-sm-12.col-12
                        input.form-control#last_name(
                            type="text",
                            v-model="$store.state.user.last_name"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-12.col-12(for="phone") Celular
                    div.col-lg-8.col-md-8.col-sm-12.col-12
                        input.form-control#phone(
                            type="text",
                            v-model="$store.state.user.phone"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-12.col-12(for="phone") Nueva contraseña
                    div.col-lg-8.col-md-8.col-sm-12.col-12
                        input.form-control#password(
                            type="password",
                            v-model="$store.state.user.password"
                        )
            div.card-footer
                button.btn.btn-danger(
                    type="button",
                    @click="saveUser()"
                    :disabled="loading"
                ) 
                    <span v-if="loading" class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                    | <i class="fa fa-save" ></i> Gurdar cambios
    div.col-lg-5.col-md-5.col-sm-7.col-12
        div.card
            div.card-header
                div.h4.float-left Partidos jugados
                div.float-right
                    button.btn.btn-secondary(
                        @click="refreshResponses()", 
                        :disabled="loadingRefresh"
                    ) 
                        <span v-if="loadingRefresh" class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                        | <i class="fa fa-refresh"></i> Actualizar
            div.card-body
                router-link.btn.btn-primary(:to="{ name: 'match_day_participate' }") <i class="fa fa-plus" ></i> Participar
                ul.list-group.list-group-flush.mt-2
                    li.list-group-item.list-group-item-action(
                        v-for="(response, index) in responses",
                        :key="index"
                    )
                        div.d-flex.w-100.justify-content-between
                            h5.mb-1 {{ response.name }}
                            small(style="width: 10rem; text-align: right;") {{ response.pivot.created_at | date }}
                        p.mb-1 {{ response.pivot.answer | textAnswer }}

</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'Home',
    data () {
        return {
            loadingRefresh: false   
        }
    },
    mounted () {
        this.$store.dispatch('user/getAuth')
        this.refreshResponses()
    },
    computed: {
        ...mapState('match_response', [
            'responses'
        ])
    },
    filters: {
        textAnswer (value) {
            let text = '---'
            switch(parseInt(value))
            {
                case 1: 
                    text = 'Local'
                    break
                case 2: 
                    text = 'Empate'
                    break
                case 3: 
                    text = 'Visita'
                    break
            }
            return text
        }
    },
    methods: {
        saveUser () {
            this.loading = true
            axios.put('api/save_user', {
                id: this.$store.state.user.id,
                email: this.$store.state.user.email,
                name: this.$store.state.user.name,
                last_name: this.$store.state.user.last_name,
                phone: this.$store.state.user.phone,
                password: this.$store.state.user.password
            })
                .then(({ data }) => {
                    this.alert.type = 'alert-success'
                    this.alert.title = ''
                    this.alert.messages.push([data.message])
                })
                .catch((error) => {
                    const response = this.catchError(error)
                    this.alert.type = 'alert-danger'
                    this.alert.title = 'Cumpla lo siguiente:'
                    this.alert.messages = response
                })
                .finally(() => {
                    this.loading = false
                    this.closeAlert()
                })
        },
        refreshResponses () {
            this.loadingRefresh = true
            axios.get('api/get_match_responses', {})
                .then(({ data }) => {
                    this.loadingRefresh = false
                    this.$store.commit('match_response/setResponses', data)
                })
                .catch((error) => {
                    alert('Error en consultar los partidos jugados')
                })
        }
    }
}
</script>