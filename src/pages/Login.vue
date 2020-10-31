<template>
  <form @submit="login" method="POST">

    <md-dialog-alert
      :md-active.sync="showDialog"
      md-title="Notice"
      md-content="Perangkat WFT dengan kode M-103 dalam kondisi bermasalah. Pada modul sensor getaran mengeluarkan data 0(low). Harap segera mengecek pompa air di M-103." />

    <md-card class="md-card-margin">
      <md-card-header data-background-color="green">
        <h4 class="title">Login</h4>
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
              <label>Username</label>
              <md-input v-model="username" name="username" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-33">
            <md-field>
              <label>Password</label>
              <md-input v-model="current_password" name="current_password" type="password"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-size-100 text-right">
            <md-button type="submit" class="md-raised md-success">Login</md-button>
          </div>
        </div>
      </md-card-content>
    </md-card>
  </form>
</template>
<script>
export default {
  name: "login",
  data() {
    return {
      username: null,
      current_password: null,
      errorMessage : "",
      successMessage : "",
      users: [],
      showDialog: true
    };
  },
  methods: {
    login: function (e) {
        //console.log("saveTool Data");
        e.preventDefault();
        
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }
        this.axios.post('http://spa.webalam.xyz/include/users.php?action=login', {
            username: this.username,
            password: this.current_password
        }, config)
        .then(function (response) {
            //currentObj.output = response.data;
            //console.log(response.data);
            if (response.data.error) {
              currentObj.errorMessage = response.data.message;
              console.log(currentObj.errorMessage);
            } else {
              //currentObj.successMessage = response.data.message;
              //console.log(currentObj.successMessage);
              currentObj.users = response.data.users;
              response.data.users.map(function(value, key) {
                currentObj.$session.start();
                currentObj.$session.set('id_user', value.id);
                currentObj.$session.set('name', value.name);
                currentObj.$session.set('telp_no', value.telp_no);
              });
              currentObj.$router.push('dashboard');
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
  .md-card-margin {
    margin-top: 200px;
  }
  .md-table + .md-table {
    margin-top: 16px
  }
  .md-dialog /deep/.md-dialog-container {
    max-width: 768px;
  }
</style>
