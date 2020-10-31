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
              <label>Address</label>
              <md-input v-model="address" name="address" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-50">
            <md-field>
              <label>Latitude</label>
              <md-input v-model="lat" name="lat" type="text"></md-input>
            </md-field>
          </div>
          <div class="md-layout-item md-small-size-100 md-size-50">
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
  </form>
</template>
<script>
import { ToolAdd } from "@/pages";
export default {
  name: "add-tool-form",
  props: {
    dataBackgroundColor: {
      type: String,
      default: ""
    }
  },
  components: {
    ToolAdd
  },
  data() {
    return {
      name: null,
      address: null,
      lat: null,
      lng: null,
      description: null,
      errorMessage : "",
      successMessage : ""
    };
  },
  methods: {
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
        this.axios.post('http://river.test/include/tools.php?action=add', {
            name: this.name,
            address: this.address,
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
              //app.getAllUsers();
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
<style>
</style>
