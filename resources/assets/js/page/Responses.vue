<template lang="pug" >
div.row
    div.col-12
        div.card
            div.card-header
                h3 Participaciones
            div.card-body
                div.row.row.justify-content-end
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
                                        th(style="min-width: 12rem") Partido
                                        th.text-center(style="width: 8rem; min-width: 8rem") Respuesta
                                tbody
                                    tr(
                                        v-for="(response, index) in responses",
                                        :key="index"
                                    )
                                        td.text-center {{ response.pivot.created_at | dateHuman }}
                                        td.text-left {{ response.name }}
                                        td.text-center {{ response.pivot.answer | textAnswer }}
                                        
</template>

<script>
export default {
    name: 'responses',
    data () {
        return {
            loading: false,
            q: '',
            responses: []
        }
    },
    mounted () {
        this.search()
    },
    filters: {
        textAnswer (value) {
            let textAnswer = ''
            switch(parseInt(value)) 
            {
                case 1:
                    textAnswer = 'Local'
                    break;
                case 2:
                    textAnswer = 'Empate'
                    break;
                case 3:
                    textAnswer = 'Visita'
                    break;
            }
            return textAnswer
        }
    },
    methods: {
        search () {
            this.loading = true
            axios.get('api/response/search', {
                params: {
                    q: this.q
                }
            })
                .then(({ data }) => {
                    this.responses = data
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