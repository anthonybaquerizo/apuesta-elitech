<template lang="pug">
div.container
  nav.navbar.navbar-expand-lg.navbar-dark.bg-dark
    router-link.navbar-brand(
      :to="{ name: 'path_home' }"
    ) Apuesta Elitech
    button.navbar-toggler(
      type="button",
      data-toggle="collapse",
      data-target="#navbarSupportedContent",
      aria-controls="navbarSupportedContent",
      aria-expanded="false",
      aria-label="Toggle navigation"
    ) 
      span.navbar-toggler-icon
    div.collapse.navbar-collapse#navbarSupportedContent
      ul.navbar-nav.mr-auto
        li.nav-item.active
            router-link.nav-link(
              :to="{ name: 'path_home' }"
            ) <i class="fa fa-dashboard" ></i> Panel General
        li.nav-item(v-if="$store.state.user.id > 0")
            router-link.nav-link(
              :to="{ name: 'path_response' }"
            ) <i class="fa fa-list" ></i> Ver Participaciones
        li.nav-item.dropdown(v-if="$store.state.user.user_type_id === 1")
            a.nav-link.dropdown-toggle#navbarDropdown(
              href="#",
              role="button",
              data-toggle="dropdown",
              aria-haspopup="true",
              aria-expanded="false"
            ) <i class="fa fa-gears" ></i> Administración
            div.dropdown-menu(aria-labelledby="navbarDropdown")
              router-link.dropdown-item(
                  :to="{ name: 'path_user_list' }"
              ) <i class="fa fa-users" ></i> Participantes
              router-link.dropdown-item(
                  :to="{ name: 'path_match_create' }"
              ) <i class="fa fa-gamepad" ></i> Partidos
      ul.navbar-nav(v-if="$store.state.user.id")
        li.nav-item.dropdown
          a.nav-link.dropdown-toggle#navbarDropdown(
              href="#",
              role="button",
              data-toggle="dropdown",
              aria-haspopup="true",
              aria-expanded="false"
            ) {{ $store.state.user.name }}
          div.dropdown-menu(aria-labelledby="navbarDropdown")
            router-link.dropdown-item(
                :to="{ name: 'path_user_profile' }"
            ) <i class="fa fa-user" ></i> Perfil
            button.dropdown-item(
              @click="logout()"
            ) <i class="fa fa-sign-out" ></i> Cerrar Sesión
      ul.navbar-nav(v-else)
        li.nav-item
          router-link.nav-link(
            :to="{ name: 'path_login' }"
          ) <i class="fa fa-sign-in" ></i> Inicio de Sesión
        li.nav-item
          router-link.nav-link(
            :to="{ name: 'path_register' }"
          ) <i class="fa fa-plus" ></i> Registro Gratis
  alert-message
  router-view
</template>

<script>
import AlertMessage from '@components/BaseAlertMessages.vue'

export default {
  name: 'app',
  components: {
    AlertMessage
  },
  mounted () {
    if (this.$store.state.user.id <= 0) {
      axios.get('api/user/auth', {})
        .then(({ data }) => {
          this.$store.commit('user/setState', data)
        })
    }
  },
  methods: {
    logout () {
      axios.get('api/user/logout', {})
        .then(({ data }) => {
          this.$store.commit('user/clearState')
          if (this.$router.history.current.name !== 'path_home') {
            this.$router.push({ name: 'path_home' })
          }
        })
    }
  }
}
</script>

<style lang="scss" >

.router-anim-enter-active {
  animation: coming 1s;
  animation-delay: .5s;
  opacity: 0;
}
.router-anim-leave-active {
  animation: going 1s;
}

@keyframes going {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-25px);
    opacity: 0;
  }
}
@keyframes coming {
  from {
    transform: translateX(-50px);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

</style>
