<template lang="pug">
div.container
  nav.navbar.navbar-expand-lg.navbar-dark.bg-dark
      a.navbar-brand(
          href="#"
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
                a.nav-link(
                    href="#"
                ) <i class="fa fa-dashboard" ></i> Panel General
            li.nav-item
                a.nav-link(
                    href="#"
                ) <i class="fa fa-list" ></i> Resultados
            li.nav-item.dropdown
                a.nav-link.dropdown-toggle#navbarDropdown(
                    href="#",
                    role="button",
                    data-toggle="dropdown",
                    aria-haspopup="true",
                    aria-expanded="false"
                ) <i class="fa fa-gears" ></i> Administración
                div.dropdown-menu(aria-labelledby="navbarDropdown")
                    a.dropdown-item(
                        href="#"
                    ) <i class="fa fa-users" ></i> Participantes
                    a.dropdown-item(
                        href="#"
                    ) <i class="fa fa-gamepad" ></i> Partidos
        ul.navbar-nav
          li.nav-item
            a.nav-link(
              href="#"
            ) <i class="fa fa-sign-in" ></i> Login
          li.nav-item
            a.nav-link(
              href="#"
            ) <i class="fa fa-plus" ></i> Register
  router-view
</template>

<script>

export default {
  name: 'app'
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
