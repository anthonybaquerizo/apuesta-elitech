<template lang="pug" >
div.row.justify-content-center
    div.col-lg-6.col-md-6.col-sm-12.col-12
        div.card
            div.card-header
                h3 Registro Gratis
            div.card-body
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="name"
                    ) Nombres
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#name(
                            type="text",
                            maxlength="250",
                            v-model="$store.state.user.name",
                            @keyup.enter="save()"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="last_name"
                    ) Apellidos
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#last_name(
                            type="text",
                            maxlength="250",
                            v-model="$store.state.user.last_name",
                            @keyup.enter="save()"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="phone"
                    ) Celular
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#phone(
                            type="text",
                            maxlength="100",
                            v-model="$store.state.user.phone",
                            @keyup.enter="save()"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="email"
                    ) Email (usuario)
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#email(
                            type="text",
                            maxlength="100",
                            v-model="$store.state.user.email",
                            @keyup.enter="save()"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="password"
                    ) Contraseña
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#password(
                            type="password",
                            maxlength="100",
                            v-model="$store.state.user.password",
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
                    :to="{ name: 'path_home' }"
                ) Cancelar

</template>

<script>
export default {
    name: 'register',
    data () {
        return {
            loading: false
        }
    },
    mounted () {
        this.$store.commit('user/clearState')
    },
    methods: {
        save () {
            this.loading = true
            axios.post('api/register', this.$store.state.user)
                .then(({ data }) => {
                    this.$store.commit('user/setState', data.data)
                    this.$router.push({ name: 'path_home', params: {
                        type: 'alert-success',
                        title: 'Registro',
                        messages: [['Su usario fue creado correctamente!']]
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