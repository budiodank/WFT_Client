<template>
  <form @submit="updateUser" method="POST">
    <md-card>
      <md-card-header data-background-color="red">
        <h4 class="title">Update Users</h4>
        <p class="category">Complete your profile</p>
      </md-card-header>

      <md-card-content>
          <div class="alert alert-success" v-if="successMessage"  @click="close()">
            <button type="button" aria-hidden="true" class="close">
              ×
            </button>
            <span>{{successMessage}}</span>
          </div>
          <div class="alert alert-danger" v-if="errorMessage" @click="close()">
            <button type="button" aria-hidden="true" class="close">
              ×
            </button>
            <span>{{errorMessage}}</span>
          </div>
          <div v-for="user in users" v-bind:key="user.id">
            <div class="md-layout-item md-small-size-100 md-size-33">
              <md-field>
                <label>Name</label>
                <md-input v-model="name" name="name" type="text"></md-input>
                <md-input v-model="user_id" name="user_id" type="hidden"></md-input>
              </md-field>
            </div>
            <div class="md-layout-item md-small-size-100 md-size-33">
              <md-field>
                <label>Address</label>
                <md-input v-model="address" name="address" type="text"></md-input>
              </md-field>
            </div>
            <div class="md-layout-item md-small-size-100 md-size-33">
              <md-field>
                <label>Telephone Number</label>
                <md-input v-model="telp_no" name="telp_no" type="text"></md-input>
              </md-field>
            </div>
            <div class="md-layout-item md-size-100 text-right">
              <md-button type="submit" class="md-raised md-success">Submit</md-button>
            </div>
          </div>
        </div>
      </md-card-content>
    </md-card>
  </form>
</template>
<script>
export default {
  name: "user-form",
  props: {
    dataBackgroundColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      user_id: "",
      name: "",
      address: "",
      telp_no: "",
      errorMessage : "",
      successMessage : "",
      users: [],
      selected: {}
    };
  },
  mounted: function () {
    //console.log("Test getAllUsers");
    this.getAllUsers();
  },
  methods: {
      getAllUsers: function(){
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }

        this.axios.get("http://spa.webalam.xyz/include/users.php?action=view&id="+this.$route.params.id, config)
        .then(function(response){
          console.log(response.data.users);
          if (response.data.error) {
            currentObj.errorMessage = response.data.message;
          }else{
            currentObj.users = response.data.users;
            response.data.users.map(function(value, key) {
              currentObj.user_id = value.id;
              currentObj.name = value.name;
              currentObj.address = value.address;
              currentObj.telp_no = value.telp_no;
            });
          }
        });
      },
      updateUser: function (e) {
        //console.log("saveUser Data");
        e.preventDefault();
        
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }
        this.axios.post('http://spa.webalam.xyz/include/users.php?action=edit', {
            user_id: this.user_id,
            name: this.name,
            address: this.address,
            telp_no: this.telp_no
        }, config)
        .then(function (response) {
            //currentObj.output = response.data;
            console.log(response.data);
            if (response.data.error) {
              currentObj.errorMessage = response.data.message;
              console.log(currentObj.errorMessage);
            } else {
              currentObj.successMessage = response.data.message;
              console.log(currentObj.successMessage);
              currentObj.getAllUsers();
            }
        })
        .catch(function (error) {
            //currentObj.output = error.response;
            console.log(error.response);
        });
      },
      close: function(){
        this.errorMessage = "";
        this.successMessage = "";
      }
  }
};
</script>
<style lang="scss" scoped>
  .md-table + .md-table {
    margin-top: 16px
  }
</style>
