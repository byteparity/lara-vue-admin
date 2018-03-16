<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <router-link to="/product/new" tag="button" class="btn btn-primary">Add Product</router-link>
                </div>
                <div class="ibox-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Image</th>
                            <th>Product Catagory</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in products" :key="item.id">
                            <td>{{index}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.description}}</td>
                            <td><img v-if="item.image !== null" :src="item.image" :alt="item.name" width="100px" />
                            <img v-else src="http://via.placeholder.com/100x100?text=No+Image" :alt="item.name" />
                            </td>
                            <td>{{item.category_id}}</td>
                            <td><button type="button" @click="editProduct($event, item.id)" class="btn btn-info"><i class="fa fa-edit"></i></button> <button @click="deleteProduct($event, item.id)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>       
</template>
<script>
export default {
  data() {
    return {
      products: []
    };
  },
  beforeCreated() {},
  created() {
    this.getProduct();
  },
  methods: {
    getProduct: function(e) {
      var app = this;
      axios
        .get("v1/products")
        .then(res => {
          app.products = res.data;
        })
        .catch(err => {
          this.$toastr("error", err.message, "hello");
        });
    },
    deleteProduct(event, id) {
      var app = this;
      axios
        .delete("v1/products/" + id)
        .then(res => {
          this.$toastr("sucess", "Product Removed !", "hello");
          app.getProduct();
        })
        .catch(err => {
          this.$toastr("error", err.message, "hello");
        });
    },
    editProduct(event, id) {
      this.$router.push({ path: "/product/" + id });
    }
  }
};
</script>

<style>

</style>
                