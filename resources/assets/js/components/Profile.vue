<template>
  <div class="row">
      <div class="col-lg-4">
            <div class="contact-box">
                <div class="col-sm-4 pull-left">
                    <div class="text-center">
                        <img alt="image" width="100px" class="img-circle m-t-xs img-responsive" v-if="user.image !== null" :src="user.image" >
                        <img alt="image" class="img-circle m-t-xs img-responsive" v-else src="http://via.placeholder.com/100x100?text=No+Image" >
                        <div v-if="user.image === null">
                            <input style="padding: 1px; margin: 5px;" class="form-control" type="file" @change="onFileChange">
                        </div>
                        <div v-else><button style="margin: 5px;"  type="button" class="btn btn-danger" @click="removeImage">Remove</button></div>
                        <div class="m-t-xs font-bold">{{user.role}}</div>

                    </div>
                </div>
                <div class="col-sm-8 pull-right">
                    <h3><strong>{{user.name}}</strong></h3>
                    <p><i class="fa fa-home"></i> {{user.home_address}}</p>
                    <address>
                        <i class="fa fa-building"></i> {{user.office_address}}
                    </address>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Profile</h5>
                </div>
                <div class="ibox-content">
                    <form autocomplete="off" @submit.prevent="updateUser" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" v-model="user.name" required></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10"><input class="form-control" placeholder="user@example.com" v-model="user.email" required></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10"><input type="text" class="form-control" v-model="user.role" required></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Home Address</label>
                            <div class="col-sm-10">
                            <vue-google-autocomplete
                                ref="user.home_address"
                                id="homeAddress"
                                classname="form-control"
                                placeholder="Start typing"
                                v-model="user.home_address"
                                v-on:placechanged="getAddressData"
                            >
                            </vue-google-autocomplete></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Office Address</label>
                            <div class="col-sm-10">
                            <vue-google-autocomplete
                                ref="user.office_address"
                                id="officeAddress"
                                classname="form-control"
                                placeholder="Start typing"
                                v-on:placechanged="getAddressData"
                            >
                            </vue-google-autocomplete>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <router-link to="/product" tag="button" type="button" class="btn btn-white">Cancel</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  </div>
</template>
<script>
import VueGoogleAutocomplete from 'vue-google-autocomplete';
export default {
  components: { VueGoogleAutocomplete },
  data() {
      return {
          user: {}
      }
  },
  created() {
    this.user = this.$auth.user();
  },
  mounted() {
  },
  methods: {
      onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = e => {
        vm.user.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function(e) {
      this.user.image = null;
    },
      updateUser: function () {
        var app = this;
        debugger;
        axios
        .put("/v1/auth/user/" + app.user.id, app.user)
        .then(res => {
          this.$toastr('success', 'Profile Updated!', 'hello');
        })
        .catch(err => {
            this.$toastr("error", err.message, "hello");
        }); 
      },
      /**
        * When the location found
        * @param {Object} addressData Data of the found location
        * @param {Object} placeResultData PlaceResult object
        * @param {String} id Input container ID
        */
        getAddressData: function (addressData, placeResultData, id) {
            var app = this;
            if (id === 'homeAddress') {
                app.user.home_address = placeResultData.formatted_address;
            } else if(id === 'officeAddress') {
                app.user.office_address = placeResultData.formatted_address;
            }
        }
  }
}
</script>
