<template lang="pug" >
div.row
    div.col-12
        div.card
            div.card-header
                h3 Lista de Usuarios
            div.card-body
                div.row.justify-content-between
                    div.col-lg-4.col-md-5.col-sm-4.col-12.mb-lg-0.mb-md-0.mb-sm-0.mb-3
                        router-link.btn.btn-danger.btn-sm(
                            :to="{ name: 'path_register' }"
                        ) <i class="fa fa-plus" ></i> Crear nuevo usuario
                    
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
                                        th(style="min-width: 12rem") Nombre Completo
                                        th(style="width: 8rem; min-width: 8rem") Celular
                                        th(style="min-width: 12rem") Email
                                        th(style="width: 10rem; min-width: 10rem") Tipo
                                tbody
                                    tr(
                                        v-for="(user, index) in users",
                                        :key="index"
                                    )
                                        td.text-center {{ user.created_at | dateHuman }}
                                        td {{ user.name + ' ' + user.last_name }}
                                        td {{ user.phone }}
                                        td {{ user.email }}
                                        td {{ user.type.name }}
</template>

<script>
export default {
    name: 'list',
    data () {
        return {
            loading: false,
            q: '',
            users: []
        }
    },
    mounted () {
        this.search()
    },
    methods: {
        search () {
            this.loading = true
            axios.get('api/user/search', {
                params: {
                    q: this.q
                }
            })
                .then(({ data }) => {
                    this.users = data
                })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false  
                })
        }
    }
}
</script>

<style>

</style>