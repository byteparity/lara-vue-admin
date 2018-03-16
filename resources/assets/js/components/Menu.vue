<template>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <router-link :to="{ name: 'profile' }">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{name}}</strong>
                          <span class="text-muted text-xs block">{{role}} </span> </span> </span>
                        </router-link>
                    </div>
                    <div class="logo-element">
                        BT
                    </div>
                </li>
                <router-link :to="{ name: 'dashboard' }" tag="li"><a><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a></router-link>
                <router-link :to="{ name: 'product' }" tag="li"><a><i class="fa fa-th-large"></i> <span class="nav-label">Product</span></a></router-link>
                <router-link :to="{ name: 'profile' }" tag="li"><a><i class="fa fa-th-large"></i> <span class="nav-label">Profile</span></a></router-link>
                <router-link :to="{ name: 'contact' }" tag="li"><a><i class="fa fa-th-large"></i> <span class="nav-label">Contact Us</span></a></router-link>
              </ul>
        </div>
    </nav>
</template>

<script>
export default {
  data() {
    return {
      created_at: "",
      email: "",
      id: null,
      name: "",
      updated_at: "",
      role: ""
    };
  },
  mounted() {
    var app = this;
    $(".navbar-minimalize").on("click", function() {
      $("body").toggleClass("mini-navbar");
      app.SmoothlyMenu();
    });
  },
  created: function() {
    this.getUser();
  },
  methods: {
    getUser() {
      var app = this;
      var userData = this.$auth.user();
      this.name = userData.name;
      this.email = userData.email;
      this.id = userData.id;
      this.created_at = userData.created_at;
      this.updated_at = userData.updated_at;
      this.role = userData.role;
    },
    SmoothlyMenu() {
      if (
        !$("body").hasClass("mini-navbar") ||
        $("body").hasClass("body-small")
      ) {
        // Hide menu in order to smoothly turn on when maximize menu
        $("#side-menu").hide();
        // For smoothly turn on menu
        setTimeout(function() {
          $("#side-menu").fadeIn(400);
        }, 200);
      } else if ($("body").hasClass("fixed-sidebar")) {
        $("#side-menu").hide();
        setTimeout(function() {
          $("#side-menu").fadeIn(400);
        }, 100);
      } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $("#side-menu").removeAttr("style");
      }
    }
  }
};
</script>
