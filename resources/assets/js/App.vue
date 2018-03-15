<template>
    <div id="app" v-if="meta.auth">
        <menu-component></menu-component>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <header-component></header-component>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <section class="content-header">
                    <h1 v-if="meta.pageName">{{meta.pageName}}</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">{{meta.pageName}}</li>
                    </ol>
                </section>
                <router-view></router-view>
            </div>
            <footer-component></footer-component>
        </div>
    </div>
    <div id="app" v-else>
        <router-view></router-view>
    </div>
</template>
<script>
    import Header from './components/Header';
    import Menu from './components/Menu';
    import Footer from './components/Footer';
    export default {
        data: function () {
            return {
                meta: {}
            }
        },
        components : {
            'header-component': Header,
            'menu-component' : Menu,
            'footer-component': Footer
        },
        created: function () {
            this.meta = this.$route.meta;
            if (this.meta.auth) {
               $('body').removeClass('gray-bg');
            } else {
                $('body').addClass('gray-bg');
               
            }
        },
        watch:{
            $route (to, from){
                this.meta = this.$route.meta;
                if (this.meta.auth) {
                    $('body').removeClass('gray-bg');
                } else {
                    $('body').addClass('gray-bg');
                    
                }
            }
        } 
    }
</script>