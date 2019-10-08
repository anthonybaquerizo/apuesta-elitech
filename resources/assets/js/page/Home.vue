<template lang="pug">
div.row
    div.col-lg-8.col-md-8.col-sm-8.col-12
        div.card
            div.card-header
                h3.float-left <i class="fa fa-life-saver" ></i> Partidos
                div.float-right
                    button.btn.btn-secondary.btn-sm(
                        type="button",
                        :disabled="loadingMatchDay",
                        @click="getMatchDay()"
                    ) 
                        div.spinner-border.spinner-border-sm.text-primary(
                            role="status",
                            v-if="loadingMatchDay"
                        )
                            span.sr-only Loading...
                        i.fa.fa-refresh(v-else)
                        |  Actualizar
            div.card-body
                div.table-responsive
                    table.table.table-bordered.table-hover
                        thead
                            tr
                                th(style="width: 1rem; min-width: 1rem") #
                                th(style="width: 8rem; min-width: 8rem") Publicado
                                th(style="min-width: 12rem") Partido del día
                                th(style="width: 7rem; min-width: 7rem")
                        tbody
                            tr(
                                v-for="(match, index) in matches",
                                :key="index"
                            )
                                td.text-center {{ index + 1 }}
                                td {{ match.updated_at | date }} 
                                th {{ match.name }}
                                td
                                    button.btn.btn-success.btn-sm(
                                        type="button",
                                        @click="participate(index)"
                                    ) <i class="fa fa-plus" ></i> Apostar
                            
    div.col-lg-4.col-md-4.col-sm-4.col-12
        div.card
            div.card-header
                h3 <i class="fa fa-calculator" ></i> Apuesta
            div.card-body
                div.h4.text-danger(v-if="$store.state.match_response.match_day_id") {{ $store.state.match_response.match_day }}
                div.h4.text-success(v-else) Eliga un partido
                div.custom-control.custom-radio
                    input.custom-control-input#local(
                        type="radio",
                        v-model="$store.state.match_response.answer",
                        value="1"
                    )
                    label.custom-control-label(
                        for="local"
                    ) Local
                div.custom-control.custom-radio
                    input.custom-control-input#empate(
                        type="radio",
                        v-model="$store.state.match_response.answer",
                        value="2"
                    )
                    label.custom-control-label(
                        for="empate"
                    ) Empate
                div.custom-control.custom-radio
                    input.custom-control-input#visita(
                        type="radio",
                        v-model="$store.state.match_response.answer",
                        value="3"
                    )
                    label.custom-control-label(
                        for="visita"
                    ) Visita
            div.card-footer.text-center(v-if="$store.state.match_response.match_day_id <= 0 || $store.state.user.id  <= 0")
                div.h4 Antes de participar debe ingresar con su usuario.
            div.card-footer.text-center(v-else-if="$store.state.match_response.match_day_id <= 0")
                div.h4 Debe elegir un partido.
            div.card-footer(v-else)
                button.btn.btn-danger.btn-sm(
                    type="button",
                    :disabled="loading",
                    @click="save()"
                )
                    div.spinner-border.spinner-border-sm.text-primary(
                            role="status",
                            v-if="loading"
                        )
                            span.sr-only Loading...
                    i.fa.fa-save(v-else)
                    |  Guardar
                button.btn.btn-link.btn-sm(
                    type="button",
                    @click="clear()"
                ) Cancelar
                
</template>

<script>
export default {
    name: 'Home',
    data () {
        return {
            loadingMatchDay: false,
            loading: false,
            matches: [],
            answer: 0
        }
    },
    created () {
        if (typeof this.$route.params.type !== 'undefined') {
            this.$store.commit('addAlert', {
                type: this.$route.params.type,
                title: this.$route.params.title,
                messages: this.$route.params.messages,
            })
        }
        this.$store.commit('match_response/clearState')
        this.getMatchDay()
    },
    methods: {
        getMatchDay () {
            this.loadingMatchDay = true
            axios.get('api/get_match_day', {})
                .then(({ data }) => {
                    this.matches = data
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    this.loadingMatchDay = false
                })
        },
        participate (index) {
            this.$store.commit('match_response/setMatchDay', {
                id: this.matches[index].id,
                name: this.matches[index].name
            })
        },
        clear () {
            this.$store.commit('match_response/clearState')
        },
        save () {
            this.loading = true
            axios.post('api/response/store', {
                match_day_id: this.$store.state.match_response.match_day_id,
                answer: this.$store.state.match_response.answer
            })
                .then(({ data }) => {
                    this.$store.commit('match_response/clearState')
                    this.$store.commit('addAlert', {
                        type: 'alert-success',
                        title: 'Participación',
                        messages: [[data.message]]
                    })
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