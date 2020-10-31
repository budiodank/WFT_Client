<template>
  <form @submit="saveUser" method="POST">
    <md-card>
      <md-card-header data-background-color="red">
        <h4 class="title">Add Users</h4>
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
          <div class="md-layout-item md-small-size-100 md-size-33">
            <md-field>
              <label>Name</label>
              <md-input v-model="name" name="name" type="text"></md-input>
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
          <div class="md-layout-item md-small-size-100 md-size-33">
            <md-field>
              <label>Username</label>
              <md-input v-model="username" name="username" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-33">
            <md-field>
              <label>Password</label>
              <md-input v-model="password_confirm" name="password_confirm" type="password"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-size-100 text-right">
            <md-button type="submit" class="md-raised md-success">Submit</md-button>
          </div>
        </div>
      </md-card-content>
    </md-card>
    <!-- Table -->
    <md-card>
      <md-card-header data-background-color="red">
        <h4 class="title">Users Data</h4>
      </md-card-header>
      <md-card-content>
        <md-table v-model="users" md-card @md-selected="onSelect">
          <md-table-toolbar>
            <h1 class="md-title">Users Data</h1>
          </md-table-toolbar>

          <md-table-row slot="md-table-row" slot-scope="{ item }" :class="getClass(item)" md-selectable="single" @click="detail(item.id)">
            <md-table-cell md-label="ID" md-sort-by="id">{{ item.id }}</md-table-cell>
            <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
            <md-table-cell md-label="Address" md-sort-by="address">{{ item.address }}</md-table-cell>
            <md-table-cell md-label="Telp No" md-sort-by="lat">{{ item.telp_no }}</md-table-cell>
          </md-table-row>
        </md-table>
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
      name: null,
      address: null,
      telp_no: null,
      username: null,
      password_confirm: null,
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
      getClass: ({ id }) => ({
        'md-primary': id === 2,
        'md-accent': id === 3
      }),
      onSelect (item) {
        this.selected = item
      },
      detail (id) {
        this.$router.push('users/detail/'+id)
      },
      getAllUsers: function(){
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }

        this.axios.get("http://spa.webalam.xyz/include/users.php?action=read", config)
        .then(function(response){
          console.log(response.data.users);
          if (response.data.error) {
            currentObj.errorMessage = response.data.message;
          }else{
            currentObj.users = response.data.users;
          }
        });
      },
      saveUser: function (e) {
        //console.log("saveUser Data");
        e.preventDefault();
        
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }
        this.axios.post('http://spa.webalam.xyz/include/users.php?action=add', {
            name: this.name,
            address: this.address,
            telp_no: this.telp_no,
            username: this.username,
            password_confirm: this.password_confirm
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
