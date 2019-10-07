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
                div.h4.float-left Apuesta del día
                div.float-right
                    button.btn.btn-secondary(
                        @click="refreshMatches()", 
                        :disabled="loadingRefresh"
                    ) 
                        <span v-if="loadingRefresh" class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                        | <i class="fa fa-refresh"></i> Actualizar
                    router-link.btn.btn-primary.ml-1(
                        :to="{ name: 'match_day_create' }",
                        v-if="$store.state.user.user_type_id == 1"
                    ) <i class="fa fa-plus"></i> Crear nuevo
            div.card-body
                div.row
                    div.col-lg-7.col-md-7.col-sm-7.col-12
                        ul.list-group
                            li.list-group-item.list-group-item-action(
                                v-for="(match, index) in matches"
                                :key="index",
                                @click="selectedMatchDay(match)",
                                :class="{ 'active' : matchDay.id == match.id }"
                            )
                                div.d-flex.w-100.justify-content-between
                                    h5.mb-1 {{ match.name }}
                                    small {{ match.created_at | date }}
                    div.col-lg-5.col-md-5.col-sm-5.col-12
                        ul.list-group
                            li.list-group-item.list-group-item-action.h3.active {{ matchDay.name }}
                            li.list-group-item.list-group-item-action
                                div.custom-control.custom-radio
                                    input.custom-control-input#local(type="radio", v-model="answer", value="1")
                                    label.custom-control-label(for="local") Local
                                div.custom-control.custom-radio
                                    input.custom-control-input#Empate(type="radio", v-model="answer", value="2")
                                    label.custom-control-label(for="Empate") Empate
                                div.custom-control.custom-radio
                                    input.custom-control-input#Visita(type="radio", v-model="answer", value="3")
                                    label.custom-control-label(for="Visita") Visita
                                button.btn.btn-danger.mt-2(
                                    type="button"
                                    :disabled="loading",
                                    @click="saveMatchDat()"
                                ) 
                                    <span v-if="loading" class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                                    | <i class="fa fa-save" ></i> Participar
                                router-link.btn.btn-link(:to="{ name: 'home' }") Cancelar
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'participe',
    data () {
        return {
            loadingRefresh: false,
            matchDay: {},
            answer: null
        }
    },
    created() {
        this.$store.dispatch('user/getAuth')
    },
    mounted () {
        this.refreshMatches()
    },
    computed: {
        ...mapState('match_day', [
            'matches'
        ]),

    },
    methods: {
        refreshMatches () {
            this.loadingRefresh = true
            axios.get('api/get_match_day', {})
                .then(({ data }) => {
                    this.$store.commit('match_day/setMatches', data)
                    this.loadingRefresh = false
                })
                .catch((error) => {
                    alert('Error al cargar la apuesta del día')
                })
        },
        selectedMatchDay (value) {
            this.matchDay = value
        },
        saveMatchDat () {
            this.alert.messages = []
            if (typeof this.matchDay.id == "undefined") {
                this.alert.type = 'alert-warning'
                this.alert.messages.push(['Eliga un partido'])
            } else if (this.answer == null) {
                this.alert.type = 'alert-warning'
                this.alert.messages.push(['Eliga una respuesta'])
            } else {
                this.loading = true;
                axios.post('api/save_participate', {
                    match_day_id: this.matchDay.id,
                    answer: this.answer
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
            }
        }
    }
}
</script>