<template>
  <div>
    <md-table v-model="alData" :table-header-color="tableHeaderColor" md-sort="name" md-sort-order="asc">
      <md-table-row slot="md-table-row" slot-scope="{ item }" @click="detail(item.tools_id)">
        <md-table-cell md-label="ID">{{ item.tools_id }}</md-table-cell>
        <md-table-cell md-label="Sensor Name" md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Vibration" md-sort-by="vibration">{{ item.vibration }}</md-table-cell>
        <md-table-cell md-label="Water Flow" md-sort-by="flow">{{ item.water_flow }}</md-table-cell>
        <md-table-cell md-label="Water Level" md-sort-by="level">{{ item.water_level }}</md-table-cell>
        <md-table-cell md-label="Relay" md-sort-by="relay">{{ item.relay1 }}</md-table-cell>
        <md-table-cell md-label="Update" md-sort-by="update">{{ item.created_dt }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
export default {
  name: "normal-table",
  props: {
    tableHeaderColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      selected: [],
      alData: []
    };
  },
  mounted: function () {
    //console.log("Test getSumTools");
    this.getToolsDetail();
  },
  methods: {
    detail (id) {
      this.$router.push('tools/detail/'+id)
    },
    getToolsDetail: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=normal", config)
      .then(function(response){
        console.log(response.data.tools_detail_normal);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.alData = response.data.tools_detail_normal;
        }
      });
    }
  }
};
</script>
