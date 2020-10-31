<template>
  <div class="content">
    <div class="md-layout" v-for="tool_detail in tools_detail">
      <!-- Box of Content -->
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25" @click="detailVibration(tool_detail.tools_id)">
          <stats-card data-background-color="blue">
            <template slot="header">
              <md-icon>vibration</md-icon>
            </template>

            <template slot="content">
              <p class="category">Vibration</p>
              <h3 class="title">{{ tool_detail.vibration }}
                <small>x</small>
              </h3>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>date_range</md-icon>
                Last updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </stats-card>
        </div>
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25" @click="detailWaterFlow(tool_detail.tools_id)">
          <stats-card data-background-color="green">
            <template slot="header">
              <md-icon>waves</md-icon>
            </template>

            <template slot="content">
              <p class="category">Water Flow</p>
              <h3 class="title">
                {{ tool_detail.water_flow }}
                <small>rpm</small>
              </h3>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>date_range</md-icon>
                Last updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </stats-card>
        </div>
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25"
        >
          <stats-card data-background-color="orange">
            <template slot="header">
              <md-icon>straighten</md-icon>
            </template>

            <template slot="content">
              <p class="category">Water Level</p>
              <h3 class="title">{{ tool_detail.water_level }}
                <small>x</small>
              </h3>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>date_range</md-icon>
                Last updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </stats-card>
        </div>

        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25"
        >
          <stats-card data-background-color="red">
            <template slot="header">
              <md-icon>power_off</md-icon>
            </template>

            <template slot="content">
              <p class="category">Relay</p>
              <h3 class="title">{{ tool_detail.relay1 }}
                <small>times</small>
              </h3>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>date_range</md-icon>
                Last updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </stats-card>
        </div>
      <!-- Chart -->
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
        >
          <chart-card
            :chart-data="sensorVibrationChart.data"
            :chart-options="sensorVibrationChart.options"
            :chart-type="'Line'"
            data-background-color="blue"
          >
            <template slot="content">
              <h4 class="title">Sensor Getaran</h4>
              <p class="category" @click="detailVibration(tool_detail.tools_id)">
                Rata-Rata Getaran Per-Jam
              </p>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>access_time</md-icon>
                updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </chart-card>
        </div>

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
              <h4 class="title">Sensor Arus Air</h4>
              <p class="category" @click="detailWaterFlow(tool_detail.tools_id)">
                Rata-Rata Arus Air Per-Jam
              </p>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>access_time</md-icon>
                updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </chart-card>
        </div>

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
              <h4 class="title">Sensor Ketinggian Air</h4>
              <p class="category" @click="detailWaterLevel(tool_detail.tools_id)">
                Rata-Rata Ketinggian Air Per-Jam
              </p>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>access_time</md-icon>
                updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
            </template>
          </chart-card>
        </div>

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
              <h4 class="title">Sensor Relay Air</h4>
              <p class="category" @click="detailRelay(tool_detail.tools_id)">
                Rata-Rata Arus Air Per-Jam
              </p>
            </template>

            <template slot="footer">
              <div class="stats">
                <md-icon>access_time</md-icon>
                updated 
                  <div v-if="tool_detail.hours === '0'"></div>
                  <div v-else-if="tool_detail.hours !== '0'">{{ tool_detail.hours }} hour </div> 
                {{ tool_detail.minutes }} minutes ago
              </div>
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
              <p class="category">Data Normal</p>
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
  StatsCard,
  ChartCard,
  NavTabsCard,
  NavTabsTable,
  OrderedTable,
  NormalTable,
  ProblemTable
} from "@/components";

export default {
  components: {
    StatsCard,
    ChartCard,
    NavTabsCard,
    NavTabsTable,
    OrderedTable,
    NormalTable,
    ProblemTable
  },
  data() {
    return {
      vibrationHour: [],
      flowHour: [],
      levelHour: [],
      relayHour: [],
      sensorVibrationChart: {
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
      sensorFlowChart: {
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
      errorMessage : "",
      successMessage : "",
      tools_detail: [],
      tools_detail_hour: []
    };
  },
  mounted: function () {
    //console.log(this.$session.get('name'));
    this.getToolsDetail();
    this.getToolsHour();
  },
  methods: {
    detailVibration (id) {
      this.$router.push('tools/detailvibration/'+id)
    },
    detailWaterFlow (id) {
      this.$router.push('tools/detailwaterflow/'+id)
    },
    detailWaterLevel (id) {
      this.$router.push('tools/detailwaterlevel/'+id)
    },
    detailRelay (id) {
      this.$router.push('tools/detailrelay/'+id)
    },
    getToolsDetail: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=last_top", config)
      .then(function(response){
        console.log(response.data.tools_detail);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail = response.data.tools_detail;
        }
      });
    },
    getToolsHour: function(){
      let currentObj = this;

      let config = {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        },
      }

      this.axios.get("http://spa.webalam.xyz/include/tools_detail.php?action=hour", config)
      .then(function(response){
        console.log(response.data.tools_detail_hour);
        if (response.data.error) {
          currentObj.errorMessage = response.data.message;
        }else{
          currentObj.tools_detail_hour = response.data.tools_detail_hour;
          response.data.tools_detail_hour.map(function(value, key) {
            currentObj.sensorVibrationChart.data.labels.push(value.hours);
            currentObj.sensorFlowChart.data.labels.push(value.hours);
            currentObj.sensorLevelChart.data.labels.push(value.hours);
            currentObj.sensorRelayChart.data.labels.push(value.hours);
            currentObj.vibrationHour.push(value.vibration);
            currentObj.flowHour.push(value.water_flow);
            currentObj.levelHour.push(value.water_level);
            currentObj.relayHour.push(value.relay1);
          });
          currentObj.sensorFlowChart.data.series.push(currentObj.flowHour);
          currentObj.sensorVibrationChart.data.series.push(currentObj.vibrationHour);
          currentObj.sensorLevelChart.data.series.push(currentObj.levelHour);
          currentObj.sensorRelayChart.data.series.push(currentObj.relayHour);
            
          //currentObj.sensorPhChart.data.labels = response.data.tools_detail_hour.hours;
          //console.log("currentObj.sensorPhChart.data.labels : "+currentObj.sensorPhChart.data.labels);
          //currentObj.sensorPhChart.data.series = response.data.tools_detail_hour.ph;
        }
      });
    }
  }
};
</script>
