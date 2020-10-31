<template>
  <div class="content">
    <div class="md-layout">     
      <!-- Chart -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorLoadChart.data"
            :chart-options="sensorLoadChart.options"
            :chart-type="'Line'"
            data-background-color="green"
          >
            <template slot="content">
              <h4 class="title">Data Weight Waste</h4>
              <h5>Total Berat Rata-Rata Per Pekan</h5>
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
            :chart-data="sensorLoadChartMonth.data"
            :chart-options="sensorLoadChartMonth.options"
            :chart-type="'Line'"
            data-background-color="green"
          >
            <template slot="content">
              <h4 class="title">Data Weight Waste</h4>
              <h5>Total Berat Per Bulan</h5>
              <p class="category">
                Bulan {{ oneToolDtl.months }}-{{ oneToolDtl.years }} Sampai {{ lastToolDtl.months }}-{{ lastToolDtl.years }}
              </p>
            </template>
          </chart-card>
        </div>
        <!-- Table -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <md-card>
            <md-card-header data-background-color="green">
              <h4 class="title">Data Sensor</h4>
              <p class="category">All Data Today</p>
            </md-card-header>
            <md-card-content>
              <waste-table table-header-color="green"></waste-table>
            </md-card-content>
          </md-card>
        </div>
        <!--
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <nav-tabs-card>
            <template slot="content">
              <span class="md-nav-tabs-title">Tasks:</span>
              <md-tabs class="md-success" md-alignment="left">
                <md-tab id="tab-home" md-label="Bugs" md-icon="bug_report">
                  <nav-tabs-table></nav-tabs-table>
                </md-tab>

                <md-tab id="tab-pages" md-label="Website" md-icon="code">
                  <nav-tabs-table></nav-tabs-table>
                </md-tab>

                <md-tab id="tab-posts" md-label="server" md-icon="cloud">
                  <nav-tabs-table></nav-tabs-table>
                </md-tab>
              </md-tabs>
            </template>
          </nav-tabs-card>
        </div>
        -->
    </div>
  </div>
</template>

<script>
import {
  ChartCard,
  WasteTable
} from "@/components";

export default {
  components: {
    ChartCard,
    WasteTable
  },
  data() {
    return {
      wasteWeek: [],
      sensorLoadChart: {
        data: {
          /*labels: ["12am", "3pm", "6pm", "9pm", "12pm", "3am", "6am", "9am"],
          series: [[230, 750, 450, 300, 280, 240, 200, 190]]*/
          labels: [],
          series: []
        },

        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 100,
          high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      wasteMonth: [],
      sensorLoadChartMonth: {
        data: {
          /*labels: ["12am", "3pm", "6pm", "9pm", "12pm", "3am", "6am", "9am"],
          series: [[230, 750, 450, 300, 280, 240, 200, 190]]*/
          labels: [],
          series: []
        },

        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 500,
          high: 5000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
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
      tools_detail_month: []
    };
  },
  created: function () {
    this.getToolsWeek();
    this.getToolsMonth();
  },
  computed: {
    oneToolDtl() {
      return this.tools_detail_week[0] || {}
    },
    lastToolDtl() {
      return this.tools_detail_week[1] || {}
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

      this.axios.get("http://api.inoprex.com/include/tools_detail.php?action=weeks", config)
      .then(function(response){
        console.log(response.data.tools_detail_week);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_week = response.data.tools_detail_week;
          response.data.tools_detail_week.map(function(value, key) {
            currentObj.sensorLoadChart.data.labels.push(value.days);
            currentObj.wasteWeek.push(value.ttlWaste);
          });
          currentObj.sensorLoadChart.data.series.push(currentObj.wasteWeek);
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

      this.axios.get("http://api.inoprex.com/include/tools_detail.php?action=months", config)
      .then(function(response){
        console.log(response.data.tools_detail_month);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_month = response.data.tools_detail_month;
          response.data.tools_detail_month.map(function(value, key) {
            currentObj.sensorLoadChartMonth.data.labels.push(value.months);
            currentObj.wasteMonth.push(value.ttlWaste);
          });
          currentObj.sensorLoadChartMonth.data.series.push(currentObj.wasteMonth);
        }
      });
    }
  }
};
</script>
