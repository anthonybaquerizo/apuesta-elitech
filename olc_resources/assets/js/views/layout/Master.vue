<template lang="pug">
nav.navbar.navbar-expand-lg.navbar-dark.bg-dark
    a.navbar-brand(href="#") Navbar
    button.navbar-toggler(type="button", 
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
                a.nav-link(href="#") Home <span class="sr-only">(current)</span>
            li.nav-item
                a.nav-link(href="#") Link
            li.nav-item.dropdown
                a.nav-link.dropdown-toggle#navbarDropdown(href="#",
                    role="button",
                    data-toggle="dropdown",
                    aria-haspopup="true",
                    aria-expanded="false"
                ) Dropdown
                div.dropdown-menu(aria-labelledby="navbarDropdown")
                    a.dropdown-item(href="#") Action
                    a.dropdown-item(href="#") Another action
                    div.dropdown-divider
                    a.dropdown-item(href="#") Something else here
            li.nav-item
                a.nav-link.disabled(href="#",
                    tabindex="-1",
                    aria-disabled="true"
                ) Disabled
</template>

<script>
export default {
    name: 'master'
}
</script>