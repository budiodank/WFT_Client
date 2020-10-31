<template>
  <div class="content">
    <div class="md-layout">     
      <!-- Chart -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorLevelChart.data"
            :chart-options="sensorLevelChart.options"
            :chart-type="'Line'"
            data-background-color="orange"
          >
            <template slot="content">
              <h4 class="title">Data Sensor Ketinggian Air</h4>
              <h5>Rata-Rata Ketinggian Air Per-Pekan</h5>
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
            :chart-data="sensorLevelChartMonth.data"
            :chart-options="sensorLevelChartMonth.options"
            :chart-type="'Line'"
            data-background-color="orange"
          >
            <template slot="content">
              <h4 class="title">Data Sensor Ketinggian Air</h4>
              <h5>Rata-Rata Ketinggian Air Per-Bulan</h5>
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
            :chart-data="sensorLevelChartP.data"
            :chart-options="sensorLevelChartP.options"
            :chart-type="'Line'"
            data-background-color="red"
          >
            <template slot="content">
              <h4 class="title">Data Masalah Sensor Ketinggian Air</h4>
              <h5>Rata-Rata Ketinggian Air Per-Pekan</h5>
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
            :chart-data="sensorLevelChartMonthP.data"
            :chart-options="sensorLevelChartMonthP.options"
            :chart-type="'Line'"
            data-background-color="red"
          >
            <template slot="content">
              <h4 class="title">Data Masalah Sensor Ketinggian Air</h4>
              <h5>Rata-Rata Ketinggian Air Per-Bulan</h5>
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
      levelWeek: [],
      sensorLevelChart: {
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
      levelMonth: [],
      sensorLevelChartMonth: {
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
      levelWeekP: [],
      sensorLevelChartP: {
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
      levelMonthP: [],
      sensorLevelChartMonthP: {
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
            currentObj.sensorLevelChart.data.labels.push(value.days);
            currentObj.levelWeek.push(value.water_level);
          });
          currentObj.sensorLevelChart.data.series.push(currentObj.levelWeek);
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
            currentObj.sensorLevelChartMonth.data.labels.push(value.month);
            currentObj.levelMonth.push(value.water_level);
          });
          currentObj.sensorLevelChartMonth.data.series.push(currentObj.levelMonth);
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
            currentObj.sensorLevelChartP.data.labels.push(value.days);
            currentObj.levelWeekP.push(value.water_level);
          });
          currentObj.sensorLevelChartP.data.series.push(currentObj.levelWeekP);
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
            currentObj.sensorLevelChartMonthP.data.labels.push(value.month);
            currentObj.levelMonthP.push(value.water_level);
          });
          currentObj.sensorLevelChartMonthP.data.series.push(currentObj.levelMonthP);
        }
      });
    }
  }
};
</script>
