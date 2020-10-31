<template>
    <!-- Table -->
    <div class="md-layout">
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
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
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-15">
        <md-datepicker v-model="fromDate" md-immediately />
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-15">
        <md-datepicker v-model="toDate" md-immediately />
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-15">
        <md-field>
          <label for="dataSensor">Data</label>
          <md-select v-model="dataSensor" name="dataSensor" id="dataSensor">
            <md-option value="all">All</md-option>
            <md-option value="normal">Normal</md-option>
            <md-option value="problem">Problem</md-option>
          </md-select>
        </md-field>
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-15">
        <md-button class="md-success md-raised" @click="viewData()">View</md-button>
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card>
          <md-card-header data-background-color="blue">
            <h4 class="title">Data Sensor</h4>
          </md-card-header>
          <md-card-content>
            <export-excel table-header-color="blue"></export-excel >
          </md-card-content>

          <md-table v-model="report" md-card @md-selected="onSelect">

            <md-table-row slot="md-table-row" slot-scope="{ item }" :class="getClass(item)" md-selectable="single">
              <md-table-cell md-label="Tool" md-sort-by="tools_id">{{ item.tools_id }}</md-table-cell>
              <md-table-cell md-label="Vibration" md-sort-by="vibration">{{ item.vibration }}</md-table-cell>
              <md-table-cell md-label="Water Flow" md-sort-by="water_flow">{{ item.water_flow }}</md-table-cell>
              <md-table-cell md-label="Water Level" md-sort-by="water_level">{{ item.water_level }}</md-table-cell>
              <md-table-cell md-label="Relay" md-sort-by="relay1">{{ item.relay1 }}</md-table-cell>
              <md-table-cell md-label="Hour" md-sort-by="hours">{{ item.hours }}</md-table-cell>
              <md-table-cell md-label="Status" md-sort-by="hours">{{ item.status }}</md-table-cell>
              <md-table-cell md-label="Last Update" md-sort-by="created_dt">{{ item.created_dt }}</md-table-cell>
            </md-table-row>
          </md-table>
        </md-card>
      </div>
    </div>
</template>
<script>
import {
  StatsCard,
  ChartCard,
  NavTabsCard,
  NavTabsTable,
  OrderedTable,
  ExportExcel
} from "@/components";

export default {
  components: {
    StatsCard,
    ChartCard,
    NavTabsCard,
    NavTabsTable,
    OrderedTable,
    ExportExcel
  },
  //name: 'CloseOnSelectDatepicker',
  /*data: () => ({
    fromDate: new Date(),
    toDate: new Date(),
    dataSensor: 'all'
  }),*/
  data() {
    return {
      fromDate: new Date(),
      toDate: new Date(),
      dataSensor: 'all',
      errorMessage : "",
      successMessage : "",
      report : [],
    }
  },
   mounted: function () {
    //this.getAllTools();
  },
  methods: {
    getClass: ({ id }) => ({
      'md-primary': id === 2,
      'md-accent': id === 3
    }),
    onSelect (item) {
      this.selected = item
    },
    viewData () {
      let currentObj = this;

      if (currentObj.fromDate == "" || currentObj.fromDate == null) {
        currentObj.errorMessage = "Please, input from date the fill";
        return;
      } else {
        console.log(this.moment(String(currentObj.fromDate)).format('YYYY-MM-DD'));
        currentObj.fromDate = this.moment(String(currentObj.fromDate)).format('YYYY-MM-DD');
      }

      if (currentObj.toDate == "" || currentObj.toDate == null) {
        currentObj.errorMessage = "Please, input to date the fill";
        return;
      } else {
        console.log(this.moment(String(currentObj.toDate)).format('YYYY-MM-DD'));
        currentObj.toDate = this.moment(String(currentObj.toDate)).format('YYYY-MM-DD');
      }

      if (currentObj.dataSensor == "" || currentObj.dataSensor == null) {
        currentObj.errorMessage = "Please, input data sensor the fill";
        return;
      } else {
        console.log(currentObj.dataSensor);
      }
      
      //View Data
      let config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        }
        this.axios.post('http://spa.webalam.xyz/include/report.php?action=read', {
            fromDate: currentObj.fromDate,
            toDate: currentObj.toDate,
            dataSensor: currentObj.dataSensor
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
              currentObj.report = response.data.report;
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
