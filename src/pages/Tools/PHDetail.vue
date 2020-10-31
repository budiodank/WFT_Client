<template>
  <div class="content">
    <div class="md-layout">     
      <!-- Chart -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorPhChart.data"
            :chart-options="sensorPhChart.options"
            :chart-type="'Line'"
            data-background-color="blue"
          >
            <template slot="content">
              <h4 class="title">Data Sensor PH</h4>
              <h5>Rata-Rata PH Per-Pekan</h5>
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
            :chart-data="sensorPhChartMonth.data"
            :chart-options="sensorPhChartMonth.options"
            :chart-type="'Line'"
            data-background-color="blue"
          >
            <template slot="content">
              <h4 class="title">Data Sensor PH</h4>
              <h5>Rata-Rata PH Per-Bulan</h5>
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
            <md-card-header data-background-color="blue">
              <h4 class="title">Data Sensor</h4>
              <p class="category">All Data Today</p>
            </md-card-header>
            <md-card-content>
              <ph-table table-header-color="blue"></ph-table>
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
  PhTable
} from "@/components";

export default {
  components: {
    ChartCard,
    PhTable
  },
  data() {
    return {
      phWeek: [],
      sensorPhChart: {
        data: {
          labels: [],
          series: []
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 12, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      phMonth: [],
      sensorPhChartMonth: {
        data: {
          labels: [],
          series: []
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 10, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
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
            currentObj.sensorPhChart.data.labels.push(value.days);
            currentObj.phWeek.push(value.ph);
          });
          currentObj.sensorPhChart.data.series.push(currentObj.phWeek);
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
            currentObj.sensorPhChartMonth.data.labels.push(value.month);
            currentObj.phMonth.push(value.ph);
          });
          currentObj.sensorPhChartMonth.data.series.push(currentObj.phMonth);
        }
      });
    }
  }
};
</script>
