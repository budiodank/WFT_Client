<template>
  <div class="content">
    <div class="md-layout">     
      <!-- Chart -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorRelayChart.data"
            :chart-options="sensorRelayChart.options"
            :chart-type="'Line'"
            data-background-color="purple"
          >
            <template slot="content">
              <h4 class="title">Data Sensor Relay</h4>
              <h5>Rata-Rata Relay Per-Pekan</h5>
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
            :chart-data="sensorRelayChartMonth.data"
            :chart-options="sensorRelayChartMonth.options"
            :chart-type="'Line'"
            data-background-color="purple"
          >
            <template slot="content">
              <h4 class="title">Data Sensor Relay</h4>
              <h5>Rata-Rata Relay Per-Bulan</h5>
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
            :chart-data="sensorRelayChartP.data"
            :chart-options="sensorRelayChartP.options"
            :chart-type="'Line'"
            data-background-color="red"
          >
            <template slot="content">
              <h4 class="title">Data Masalah Sensor Relay</h4>
              <h5>Rata-Rata Relay Per-Pekan</h5>
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
            :chart-data="sensorRelayChartMonthP.data"
            :chart-options="sensorRelayChartMonthP.options"
            :chart-type="'Line'"
            data-background-color="red"
          >
            <template slot="content">
              <h4 class="title">Data Masalah Sensor Relay</h4>
              <h5>Rata-Rata Relay Per-Bulan</h5>
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
      relayWeek: [],
      sensorRelayChart: {
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
      relayMonth: [],
      sensorRelayChartMonth: {
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
      relayWeekP: [],
      sensorRelayChartP: {
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
      relayMonthP: [],
      sensorRelayChartMonthP: {
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
            currentObj.sensorRelayChart.data.labels.push(value.days);
            currentObj.relayWeek.push(value.relay1);
          });
          currentObj.sensorRelayChart.data.series.push(currentObj.relayWeek);
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
            currentObj.sensorRelayChartMonth.data.labels.push(value.month);
            currentObj.relayMonth.push(value.relay1);
          });
          currentObj.sensorRelayChartMonth.data.series.push(currentObj.relayMonth);
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
            currentObj.sensorRelayChartP.data.labels.push(value.days);
            currentObj.relayWeekP.push(value.relay1);
          });
          currentObj.sensorRelayChartP.data.series.push(currentObj.relayWeekP);
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
            currentObj.sensorRelayChartMonthP.data.labels.push(value.month);
            currentObj.relayMonthP.push(value.relay1);
          });
          currentObj.sensorRelayChartMonthP.data.series.push(currentObj.relayMonthP);
        }
      });
    }
  }
};
</script>
