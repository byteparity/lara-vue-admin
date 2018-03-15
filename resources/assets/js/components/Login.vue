<template>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Welcome to LaraVeu</h3>
            <p>A laravel and vue admin theme</p>
            <p>Login in. To see it in action.</p>
            <div class="alert alert-danger" v-if="error">
                {{errorText}}
            </div>
            <form class="m-t" role="form" autocomplete="off" @submit.prevent="login">
                <div class="form-group">
                    <input type="email" class="form-control" @focus="error = false" placeholder="Username" v-model="email" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" v-model="password" >
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <router-link :to="{ name: 'signup' }" tag="a" class="btn btn-sm btn-white btn-block">Create an account</router-link>
            </form>
            <p class="m-t"> <small>Made with Love in India &copy; 2018</small> </p>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email: null,
                password: null,
                error: false,
                errorText: ''
            }
        },

        mounted(){
        },

        methods: {
            login(){
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {},
                    error: function (resp) {
                        app.error = true;
                        app.errorText = resp.response.data.msg;
                    },
                    rememberMe: true,
                    redirect: '/dashboard',
                    fetchUser: true,
                });
            },
        }
    }   
</script>
