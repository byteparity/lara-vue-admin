<template>
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <h3>Register to LaraVue</h3>
            <p>Create account to see it in action.</p>
            <div class="alert alert-danger" v-if="error && !success">
                <p>There was an error, unable to complete registration.</p>
            </div>
            <div class="alert alert-success" v-if="success">
                <p>Registration completed. You can now <br>
                <router-link :to="{name:'login'}">sign in.</router-link>
                </p>
            </div>
            <form class="m-t" role="form" autocomplete="off" v-on:submit="register" v-if="!success">
                <div class="form-group" v-bind:class="{ 'has-error': error && errors.username }">
                    <input type="text" id="name" placeholder="Name" class="form-control" v-model="name" required>
                    <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
                    <input type="password" placeholder="Password" id="password" class="form-control" v-model="password" required>
                    <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <router-link :to="{ name: 'login' }" tag="a" class="btn btn-sm btn-white btn-block">Login</router-link>
            </form>
            <p class="m-t"> <small>Made with Love in India &copy; 2018</small> </p>
        </div>
    </div>

</template>
<script> 
    export default {
        data(){
            return {
                name: '',
                email: '',
                password: '',
                error: false,
                errors: {},
                success: false
            };
        },

        methods: {
            register(){
                var app = this
                this.$auth.register({
                    params: {
                        name: app.name,
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });                
            }
        }
    }
</script>
