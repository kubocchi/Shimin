<template>
    <div>
        <title>宮崎市民活動センター</title>
        <div v-if="isAdmin">
            <admin-panel></admin-panel>
        </div>

        <div v-else>
            <website></website>
        </div>
    </div>
</template>


<script>
    export default {
        data: function () {
            return {}
        },
        computed: {
            authenticated: function () {
                return this.$store.getters.isAuthenticated
            },
            isAdmin: function () {
                return this.$route.meta === 'admin'
            },
            meta: function () {
                return this.$store.state.pageMetaStore
            }
        },
        mounted() {
           
        },
        components: {
            'admin-panel': require('./layouts/AdminPanel'),
            'website': require('./layouts/Website')
        },
        created: function () {
        }
    }
</script>