<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 v-if="id === 'new'">Add Product</h5>
                    <h5 v-else>Edit Product</h5>
                </div>
                <div class="ibox-content">
                    <form autocomplete="off" @submit.prevent="addProduct" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-10"><input type="text" class="form-control" v-model="name" required></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product Description</label>
                            <div class="col-sm-10"><textarea class="form-control" v-model="description" required></textarea></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product Images</label>
                            <div class="col-sm-10" v-if="!image">
                                <input class="form-control" type="file" @change="onFileChange">
                            </div>
                            <div class="col-sm-10" v-else>
                                <img :src="image" width="100px" height="100px" />
                                <button type="button" class="btn btn-danger" @click="removeImage">Remove Image</button>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="button">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>      
</template>
<script>
export default {
  data() {
    return {
      id: "new",
      image: "",
      name: "",
      description: "",
      category_id: ""
    };
  },
  beforeCreated() {},
  created() {
    this.id = this.$route.params.id;
    if (this.id !== 'new') this.getProduct(this.id);
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
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function(e) {
      this.image = "";
    },
    getProduct: function(id) {
      var app = this;
      axios
        .get("v1/products/"+ id)
        .then(res => {
          app.name = res.data.name;
          app.description = res.data.description;
          app.image = res.data.image;
          app.category_id = res.data.category_id;
        })
        .catch(err => {
          this.$toastr("error", err.message, "hello");
        });
    },
    addProduct: function(e) {
      var app = this;
      var rowData = {
        name: app.name,
        description: app.description,
        category_id: 1,
        image: app.image
      };
      if (app.id === "new") {
        axios
        .post("v1/products", rowData)
        .then(res => {
          this.$toastr('success', 'Product added!', 'hello');
          this.$router.push({ path: '/product'});
        })
        .catch(err => {
            this.$toastr("error", err.message, "hello");
        });
      } else {
        rowData.id = app.id;
        axios
        .put("v1/products/" + app.id, rowData)
        .then(res => {
          this.$toastr('success', 'Product Updated!', 'hello');
          this.$router.push({ path: '/product'});
        })
        .catch(err => {
            this.$toastr("error", err.message, "hello");
        });
      }
      
    
    }
  }
};
</script>

<style>

</style>
                