<template>
  <div>
    <vue-excel-xlsx
        :data="data"
        :columns="columns"
        :filename="'data_sensor'"
        :sheetname="'data_sensor'"
        >
        Download
    </vue-excel-xlsx>
  </div>
</template>

<script>
export default {
  name: "export-excel",
  props: {
    tableHeaderColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
          columns : [
              {
                  label: "Tools",
                  field: "tools",
              },
              {
                  label: "Vibration",
                  field: "vibration",
              },
              {
                  label: "Water Flow",
                  field: "water_flow",
              },
              {
                  label: "Water Level",
                  field: "water_level",
              },
              {
                  label: "Relay",
                  field: "relay",
              },
              {
                  label: "Last Update",
                  field: "last_update",
              },
          ],
          data : [
              {
                  tools: "6d476a",
                  vibration: 1,
                  water_flow: 1,
                  water_level: 1,
                  relay: 1,
                  last_update: "2020-08-29 21:51:12"
              },
              {
                  tools: "6d476a",
                  vibration: 1,
                  water_flow: 1,
                  water_level: 1,
                  relay: 1,
                  last_update: "2020-08-29 21:51:12"
              },
              {
                  tools: "6d476a",
                  vibration: 1,
                  water_flow: 1,
                  water_level: 1,
                  relay: 1,
                  last_update: "2020-08-29 21:51:12"
              },
              {
                  tools: "6d476a",
                  vibration: 1,
                  water_flow: 1,
                  water_level: 1,
                  relay: 1,
                  last_update: "2020-08-29 21:51:12"
              }
          ],
      }
  },
  methods: {
    priceFormat(value){
        return '$ ' + value;
    }
  }
};
</script>
