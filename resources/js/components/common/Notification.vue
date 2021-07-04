<template>
    <b-alert
            class="position-fixed"
            style="z-index:5; top: 0; left: 50%; margin-left:-150px; width:300px;"
            :show="notification.active ? 3 : 0"
            @dismissed="notification.active=false"
            :variant="notification.type"
    >
        <h6 class="alert-heading">{{notification.type === 'success' ? 'Success' : 'Error'}}!</h6>
        <p>{{notification.text}}</p>
    </b-alert>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'Notification',

        computed: {
            ...mapGetters([
                'notification',
            ]),
        }
    }
</script>