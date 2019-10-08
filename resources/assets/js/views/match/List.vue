<template lang="pug" >
div.row
    div.col-12
        div.card
            div.card-header
                h3 Lista de Partidos
            div.card-body
                div.row.row.justify-content-between
                    div.col-lg-4.col-md-5.col-sm-4.col-12.mb-lg-0.mb-md-0.mb-sm-0.mb-3
                        router-link.btn.btn-danger.btn-sm(
                            :to="{ name: 'path_match_create' }"
                        ) <i class="fa fa-plus" ></i> Crear nuevo partido
                    div.col-lg-4.col-md-5.col-sm-8.col-12
                        div.input-group.mb-3
                            input.form-control.form-control-sm(
                                type="text",
                                placeholder="Buscar...",
                                v-model="q",
                                :disabled="loading"
                                @keyup.enter="search()"
                            )
                            div.input-group-prepend
                                button.btn.btn-danger.btn-sm(
                                    type="button",
                                    @click="search()",
                                    :disabled="loading"
                                )
                                    div.spinner-border.spinner-border-sm.text-primary(
                                        role="status",
                                        v-if="loading"
                                    )
                                        span.sr-only Loading...
                                    i.fa.fa-search(v-else)
                div.row
                    div.col-12
                        div.table-responsive
                            table.table.table-bordered.table-hover
                                thead
                                    tr
                                        th.text-center(style="width: 8rem; min-width: 8rem") Fecha
                                        th(style="min-width: 12rem") Nombre
                                        th.text-center(style="width: 8rem; min-width: 8rem") Estado
                                        th(style="width: 5rem; min-width: 5rem")
                                tbody
                                    tr(
                                        v-for="(match, index) in matches",
                                        :key="index"
                                    )
                                        td.text-center {{ match.created_at | dateHuman }}
                                        td {{ match.name }}
                                        td.text-center {{ match.status | textStatus }}
                                        td
                                            div.btn-group(
                                                v-if="match.status === 2 || match.status === 3"
                                            )
                                                button.btn.btn-secondary.dropdown-toggle(
                                                    type="button",
                                                    data-toggle="dropdown",
                                                    aria-haspopup="true",
                                                    aria-expanded="false"
                                                ) <i class="fa fa-list" ></i>
                                                div.dropdown-menu.dropdown-menu-right
                                                    router-link.dropdown-item(
                                                        :to="{ name: 'path_match_edit', params: { id: match.id } }"
                                                    ) <i class="fa fa-edit" ></i> Editar
                                                    button.dropdown-item(
                                                        type="button",
                                                        v-if="match.status === 3",
                                                        @click="remove(match.id)"
                                                    ) <i class="fa fa-trash" ></i> Eliminar
</template>

<script>
export default {
    name: 'List',
    data () {
        return {
            loading: false,
            q: '',
            matches: []
        }
    },
    mounted () {
        if (typeof this.$route.params.type !== 'undefined') {
            this.$store.commit('addAlert', {
                type: this.$route.params.type,
                title: this.$route.params.title,
                messages: this.$route.params.messages,
            })
        }
        this.search()
    },
    filters: {
        textStatus (value) {
            let text = '---'
            switch(parseInt(value)) 
            {
                case 1:
                    text = 'Terminado'
                    break;
                case 2:
                    text = 'Publico'
                    break;
                case 3:
                    text = 'Borrador'
                    break;
            }
            return text
        }
    },
    methods: {
        search () {
            this.loading = true
            axios.get('api/match_day/search', {
                params: {
                    q: this.q
                }
            })
                .then(({ data }) => {
                    this.matches = data
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false  
                })
        },
        remove (id) {
            axios.delete('api/match_day/remove', {
                params: {
                    id: id
                }
            })
                .then(({ data }) => {
                    this.search()
                    this.$store.commit('addAlert', {
                        type: 'alert-success',
                        title: 'Eliminación',
                        messages: [[data.message]],
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
                    this.$store.dispatch('clearAlert')
                })
        }
    }
}
</script>

<style>

</style>