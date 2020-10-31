<template>
  <div class="content">
    <div class="md-layout">     
      <!-- Chart -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorFlowChart.data"
            :chart-options="sensorFlowChart.options"
            :chart-type="'Line'"
            data-background-color="green"
          >
            <template slot="content">
              <h4 class="title">Data Sensor Arus Air</h4>
              <h5>Rata-Rata Arus Air Per-Pekan</h5>
              <p class="category" @click="reload()">
                Pekan ke {{ oneToolDtl.weeks }} <br>
                Tanggal {{ oneToolDtl.days }}-{{ oneToolDtl.months }}-{{ oneToolDtl.years }} Sampai {{ lastToolDtl.days }}-{{ lastToolDtl.months }}-{{ lastToolDtl.years }}
              </p>
            </template>
          </chart-card>
        </div>

        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorFlowChartMonth.data"
            :chart-options="sensorFlowChartMonth.options"
            :chart-type="'Line'"
            data-background-color="green"
          >
            <template slot="content">
              <h4 class="title">Data Sensor Arus Air</h4>
              <h5>Rata-Rata Arus Air Per-Bulan</h5>
              <p class="category">
                Bulan {{ oneToolDtl.months }}-{{ oneToolDtl.years }} Sampai {{ lastToolDtl.months }}-{{ lastToolDtl.years }}
              </p>
            </template>
          </chart-card>
        </div>
        
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorFlowChartP.data"
            :chart-options="sensorFlowChartP.options"
            :chart-type="'Line'"
            data-background-color="red"
          >
            <template slot="content">
              <h4 class="title">Data Masalah Sensor Arus Air</h4>
              <h5>Rata-Rata Arus Air Per-Pekan</h5>
              <p class="category" @click="reload()">
                Pekan ke {{ oneToolDtlP.weeks }} <br>
                Tanggal {{ oneToolDtlP.days }}-{{ oneToolDtlP.months }}-{{ oneToolDtlP.years }} Sampai {{ lastToolDtlP.days }}-{{ lastToolDtlP.months }}-{{ lastToolDtlP.years }}
              </p>
            </template>
          </chart-card>
        </div>

        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorFlowChartMonthP.data"
            :chart-options="sensorFlowChartMonthP.options"
            :chart-type="'Line'"
            data-background-color="red"
          >
            <template slot="content">
              <h4 class="title">Data Masalah Sensor Arus Air</h4>
              <h5>Rata-Rata Arus Air Per-Bulan</h5>
              <p class="category">
                Bulan {{ oneToolDtlP.months }}-{{ oneToolDtlP.years }} Sampai {{ lastToolDtlP.months }}-{{ lastToolDtlP.years }}
              </p>
            </template>
          </chart-card>
        </div>

        <!-- Table -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
        >
          <md-card>
            <md-card-header data-background-color="blue">
              <h4 class="title">Data Sensor</h4>
              <p class="category">All Data Today</p>
            </md-card-header>
            <md-card-content>
              <normal-table table-header-color="blue"></normal-table>
            </md-card-content>
          </md-card>
        </div>

        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
        >
          <md-card>
            <md-card-header data-background-color="red">
              <h4 class="title">Data Sensor</h4>
              <p class="category">Data Problem</p>
            </md-card-header>
            <md-card-content>
              <problem-table table-header-color="red"></problem-table>
            </md-card-content>
          </md-card>
        </div>
    </div>
  </div>
</template>

<script>
import {
  ChartCard,
  NormalTable,
  ProblemTable
} from "@/components";

export default {
  components: {
    ChartCard,
    NormalTable,
  ProblemTable
  },
  data() {
    return {
      flowWeek: [],
      sensorFlowChart: {
        data: {
          labels: [],
          series: []
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 5, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      flowMonth: [],
      sensorFlowChartMonth: {
        data: {
          labels: [],
          series: []
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 5, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },

      //Problem
      flowWeekP: [],
      sensorFlowChartP: {
        data: {
          labels: [],
          series: []
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 5, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      flowMonthP: [],
      sensorFlowChartMonthP: {
        data: {
          labels: [],
          series: []
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 5, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      errorMessage : "",
      successMessage : "",
      tools_detail_week: [],
      tools_detail_month: [],
      tools_detail_week_problem: [],
      tools_detail_month_problem: []
    };
  },
  created: function () {
    this.getToolsWeek();
    this.getToolsMonth();
    this.getToolsWeekP();
    this.getToolsMonthP();
  },
  computed: {
    oneToolDtl() {
      return this.tools_detail_week[0] || {}
    },
    lastToolDtl() {
      return this.tools_detail_week[6] || {}
    },
    oneToolDtlP() {
      return this.tools_detail_week_problem[0] || {}
    },
    lastToolDtlP() {
      return this.tools_detail_week_problem[6] || {}
    }
  },
  methods: {
    reload: function(){
      location.reload();
    },
    getToolsWeek: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=weeks", config)
      .then(function(response){
        console.log(response.data.tools_detail_week);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_week = response.data.tools_detail_week;
          response.data.tools_detail_week.map(function(value, key) {
            currentObj.sensorFlowChart.data.labels.push(value.days);
            currentObj.flowWeek.push(value.water_flow);
          });
          currentObj.sensorFlowChart.data.series.push(currentObj.flowWeek);
        }
      });
    },
    getToolsMonth: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=months", config)
      .then(function(response){
        console.log(response.data.tools_detail_month);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_month = response.data.tools_detail_month;
          response.data.tools_detail_month.map(function(value, key) {
            currentObj.sensorFlowChartMonth.data.labels.push(value.month);
            currentObj.flowMonth.push(value.water_flow);
          });
          currentObj.sensorFlowChartMonth.data.series.push(currentObj.flowMonth);
        }
      });
    },
    getToolsWeekP: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=weeks_problem", config)
      .then(function(response){
        console.log(response.data.tools_detail_week_problem);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_week_problem = response.data.tools_detail_week_problem;
          response.data.tools_detail_week_problem.map(function(value, key) {
            currentObj.sensorFlowChartP.data.labels.push(value.days);
            currentObj.flowWeekP.push(value.water_flow);
          });
          currentObj.sensorFlowChartP.data.series.push(currentObj.flowWeekP);
        }
      });
    },
    getToolsMonthP: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=months_problem", config)
      .then(function(response){
        console.log(response.data.tools_detail_month_problem);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_month_problem = response.data.tools_detail_month_problem;
          response.data.tools_detail_month_problem.map(function(value, key) {
            currentObj.sensorFlowChartMonthP.data.labels.push(value.month);
            currentObj.flowMonthP.push(value.water_flow);
          });
          currentObj.sensorFlowChartMonthP.data.series.push(currentObj.flowMonthP);
        }
      });
    }
  }
};
</script>
