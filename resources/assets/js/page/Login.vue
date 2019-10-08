<template lang="pug" >
div.row.justify-content-center
    div.col-lg-6.col-md-6.col-sm-12.col-12
        div.card
            div.card-header
                h3 Inicio de Sesión
            div.card-body
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="username"
                    ) Email (usuario)
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#username(
                            type="text",
                            maxlength="250",
                            v-model="username",
                            @keyup.enter="login()"
                        )
                div.row.form-group
                    label.col-lg-4.col-md-4.col-sm-4.col-12(
                        for="password"
                    ) Contraseña
                    div.col-lg-8.col-md-8.col-sm-8.col-12
                        input.form-control.form-control-sm#password(
                            type="password",
                            v-model="password",
                            @keyup.enter="login()"
                        )
            div.card-footer
                button.btn.btn-danger.btn-sm(
                    type="button",
                    @click="login()",
                    :disabled="loading"
                ) 
                    div.spinner-border.spinner-border-sm.text-primary(
                        role="status",
                        v-if="loading"
                    )
                        span.sr-only Loading...
                    i.fa.fa-sign-in(v-else)
                    |  Aceptar
                router-link.btn.btn-link.btn-sm(
                    :to="{ name: 'path_register' }"
                ) Registro gratis
</template>

<script>
export default {
    name: 'login',
    data () {
        return {
            loading: false,
            username: '',
            password: ''
        }
    },
    methods: {
        login () {
            this.loading = true
            axios.post('api/login', {
                username: this.username,
                password: this.password
            })
                .then(({ data }) => {
                    this.$store.commit('user/setState', data.data)
                    this.$router.push({ name: 'path_home', params: {
                        type: 'alert-success',
                        title: 'Inicio de Sesión',
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