<template>
    <b-overlay
            :show="getSpinner.loading"
            rounded="lg"
            no-center
    >
        <div class="container-fluid mt-2">
            <Notification/>
            <div class="row">
                <div class="col-12 m-0 p-0">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <template #overlay>
            <div class="text-center ml-auto mt-lg-5">
                <b-spinner variant="primary"></b-spinner>
                <p>{{getSpinner.text}}</p>
            </div>
        </template>
    </b-overlay>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Notification from './common/Notification'

    export default {
        components: {
            Notification,
        },
        computed: {
            ...mapGetters([
                'getSpinner'
            ]),
        },
    }
</script>