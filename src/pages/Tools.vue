<template>
  <form @submit="saveTool" method="POST">
    <md-card>
      <md-card-header data-background-color="green">
        <h4 class="title">Add Tools</h4>
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
              <label>Name Tool</label>
              <md-input v-model="name" name="name" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-33">
            <md-field>
              <label>Latitude</label>
              <md-input v-model="lat" name="lat" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-33">
            <md-field>
              <label>Longitude</label>
              <md-input v-model="lng" name="lng" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-size-100">
            <md-field maxlength="5">
              <label>Description</label>
              <md-textarea v-model="description" name="description"></md-textarea>
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
      <md-card-header data-background-color="green">
        <h4 class="title">Sensor Data</h4>
      </md-card-header>
      <md-card-content>
        <md-table v-model="tools" md-card @md-selected="onSelect">
          <md-table-toolbar>
            <h1 class="md-title">Sensor Data</h1>
          </md-table-toolbar>

          <md-table-row slot="md-table-row" slot-scope="{ item }" :class="getClass(item)" md-selectable="single">
            <md-table-cell md-label="ID" md-sort-by="id">{{ item.id }}</md-table-cell>
            <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
            <md-table-cell md-label="Latitude" md-sort-by="lat">{{ item.lat }}</md-table-cell>
            <md-table-cell md-label="Longitude" md-sort-by="lng">{{ item.lng }}</md-table-cell>
            <md-table-cell md-label="Description" md-sort-by="description">{{ item.description }}</md-table-cell>
          </md-table-row>
        </md-table>
      </md-card-content>
    </md-card>
  </form>
</template>
<script>
export default {
  name: "edit-profile-form",
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
      lat: null,
      lng: null,
      description: null,
      errorMessage : "",
      successMessage : "",
      tools: [],
      selected: {}
    };
  },
  mounted: function () {
    //console.log("Test getAllTools");
    this.getAllTools();
  },
  methods: {
      getClass: ({ id }) => ({
        'md-primary': id === 2,
        'md-accent': id === 3
      }),
      onSelect (item) {
        this.selected = item
      },
      getAllTools: function(){
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }

        this.axios.get("http://spa.webalam.xyz/include/tools.php?action=read", config)
        .then(function(response){
          console.log(response.data.tools);
          if (response.data.error) {
            currentObj.errorMessage = response.data.message;
          }else{
            currentObj.tools = response.data.tools;
          }
        });
      },
      saveTool: function (e) {
        //console.log("saveTool Data");
        e.preventDefault();
        
        let currentObj = this;

        let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }
        this.axios.post('http://spa.webalam.xyz/include/tools.php?action=add', {
            name: this.name,
            lat: this.lat,
            lng: this.lng,
            description: this.description
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
