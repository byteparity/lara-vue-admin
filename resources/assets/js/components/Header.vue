<template>
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button class="navbar-minimalize minimalize-styl-2 btn btn-primary " type="button"><i class="fa fa-bars"></i> </button>
            <form role="search" class="navbar-form-custom" v-on:submit="search">
                <div class="form-group">
                    <input value="" v-model="searchText" type="text" placeholder="Search for something..." class="form-control">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links flex-row ml-md-auto d-md-flex">
            <li>
                <a v-if="$auth.check()" @click.prevent="$auth.logout()">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        data() {
           return {searchText: ''};
        },
        mounted() {
            console.log('Header Component mounted.')
        },
        methods: {
            search: function (event) {
                if (this.searchText !== '') {
                    console.log('You are searching --> ' + this.searchText);
                }
                
            }
        }
    }
</script>
