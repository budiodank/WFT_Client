<template>
	<div class="">
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
	            <md-table-cell md-label="Address" md-sort-by="address">{{ item.address }}</md-table-cell>
	            <md-table-cell md-label="Latitude" md-sort-by="lat">{{ item.lat }}</md-table-cell>
	            <md-table-cell md-label="Longitude" md-sort-by="lng">{{ item.lng }}</md-table-cell>
	            <md-table-cell md-label="Description" md-sort-by="description">{{ item.description }}</md-table-cell>
	          </md-table-row>
	        </md-table>
	      </md-card-content>
	    </md-card>
	</div>
</template>
<script>
import { ToolsView } from "@/pages";
export default {
  name: "view-tools",
  props: {
    dataBackgroundColor: {
      type: String,
      default: ""
    }
  },
  components: {
    ToolsView
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
    console.log("Test getAllTools");
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

        this.axios.get("http://river.test/include/tools.php?action=read", config)
        .then(function(response){
          console.log(response.data.tools);
          if (response.data.error) {
            currentObj.errorMessage = response.data.message;
          }else{
            currentObj.tools = response.data.tools;
          }
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