<template lang="pug">
div.alert.alert-dismissible.fade.show.w-100.mt-2.mb-2(
    v-if="alert.messages.length"
    :class="alert.type"
    role="alert"
)
    <strong v-if="alert.title != ''" >{{ alert.title }}</strong>
    ul.mb-0.pb-0
        li(v-for="(message, index) in alert.messages") {{ alert.messages[index][0] }}
    button.close(type="button", data-dismiss="alert", aria-label="Close")
        span(aria-hidden="true") &times;
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'alert',
    computed: {
        ...mapState([
            'alert'
        ])
    }
}
</script>