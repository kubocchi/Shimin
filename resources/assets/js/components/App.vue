<template>
    <div>
        <vue-topprogress ref="topProgress"></vue-topprogress>
        <title>宮崎市民活動センター</title>
        <div v-if="isAdmin">
            <admin-panel></admin-panel>
        </div>
        <div v-else-if="isLogin">
            <login></login>
        </div>
        <div v-else>
            <website></website>
        </div>
        
    </div>
</template>


<script>
     import { vueTopprogress } from 'vue-top-progress'
    export default {
        components: {
            'admin-panel': require('./layouts/AdminPanel'),
            'website': require('./layouts/Website'),
            'login': require('./layouts/Login'),
            vueTopprogress
        },
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
            },
            isLogin: function () {
                return this.$route.meta === 'login'
            }
            
        },
        mounted () {
            this.$refs.topProgress.start()
        
            // Use setTimeout for demo
            setTimeout(() => {
            this.$refs.topProgress.done()
            }, 2000)
        },
        
        created() {
            //window.location.reload(true)
            //this.$router.go(this.$router.currentRoute)
        }
    }
</script>