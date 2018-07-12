<template>
    <div>
        <div>
            <!-- <vue-topprogress ref="topProgress"></vue-topprogress> -->
        </div>
        
        <title>宮崎市民活動センター</title>
        <div v-if="isAdmin">
            <admin-panel></admin-panel>
        </div>
         <div v-else-if="isHome">
            <website></website>
        </div>
        <div v-else>
            <login></login>
        </div>
    </div>
</template>


<script>
    export default {
        components: {
            'admin-panel': require('./layouts/AdminPanel'),
            'website': require('./layouts/Website'),
            'login': require('./layouts/Login'),
        },
        data: function () {
            return {}
        },
        computed: {
            authenticated: function () {
                return this.$store.getters.isAuthenticated
            },
            isAdmin: function () {
                return this.$route.meta === 'admin' && this.$store.state.user != null
            },
            meta: function () {
                return this.$store.state.pageMetaStore
            },
            isLogin: function () {
                return this.$route.meta === 'login'
            },
            isHome: function () {
                return this.$route.meta === 'home'
            }
            
        },
        
        
        created() {
            //console.log( this.$store.state.user)
            //window.location.reload(true)
            //this.$router.go(this.$router.currentRoute)
            //console.log('token', localStorage.getItem('token'))

            // let recaptchaScript = document.createElement('script')
            // recaptchaScript.setAttribute('src', 'https://unpkg.com/nprogress@0.2.0/nprogress.js')
            // document.head.appendChild(recaptchaScript)

            
        }
    }
</script>