<template>
  <div>
    <md-table v-model="load" :table-header-color="tableHeaderColor">
      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID">{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Sensor Name">{{ item.address }}</md-table-cell>
        <md-table-cell md-label="Weight Waste">{{ item.data_load }}</md-table-cell>
        <md-table-cell md-label="Update">{{ item.update }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
export default {
  name: "load-table",
  props: {
    tableHeaderColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      selected: [],
      load: []
    };
  },
  mounted: function () {
    console.log("Test getSumTools");
    this.getToolsDetail();
  },
  methods: {
    getToolsDetail: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://api.inoprex.com/include/tools_detail.php?action=all", config)
      .then(function(response){
        console.log(response.data.tools_detail);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.load = response.data.tools_detail;
        }
      });
    }
  }
};
</script>
