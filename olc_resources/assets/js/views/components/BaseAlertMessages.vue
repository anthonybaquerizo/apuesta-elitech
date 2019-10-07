<template lang="pug">
div.alert.alert-dismissible.fade.show.w-100(
    v-if="messages.length"
    :class="typeAlert"
    role="alert"
)
    <strong v-if="title != ''" >{{ title }}</strong>
    ul.mb-0.pb-0
        li(v-for="(message, index) in messages") {{ messages[index][0] }}
    button.close(type="button", data-dismiss="alert", aria-label="Close")
        span(aria-hidden="true") &times;
</template>

<script>
export default {
    name: 'alert',
    props: {
        typeAlert: { type: String, required: true },
        title: { type: String, required: false, default: '' },
        messages: { type: Array, required: false, default: Array }
    }
}
</script>