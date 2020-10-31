<template>
  <div>
    <md-table v-model="alData" :table-header-color="tableHeaderColor">
      <md-table-row slot="md-table-row" slot-scope="{ item }" @click="detail(item.id)">
        <md-table-cell md-label="ID">{{ item.tools_id }}</md-table-cell>
        <md-table-cell md-label="Sensor Name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Address">{{ item.address }}</md-table-cell>
        <md-table-cell md-label="PH">{{ item.ph }}</md-table-cell>
        <md-table-cell md-label="Weight">{{ item.weight }}</md-table-cell>
        <md-table-cell md-label="Update">{{ item.created_dt }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
export default {
  name: "ph-table-problem",
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
    console.log("Test getSumTools");
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

      this.axios.get("http://api.webalam.xyz/include/tools_detail.php?action=problem", config)
      .then(function(response){
        console.log(response.data.tools_detail_problem);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.alData = response.data.tools_detail_problem;
        }
      });
    }
  }
};
</script>
