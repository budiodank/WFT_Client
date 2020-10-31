// =========================================================
// * Vue Material Dashboard - v1.2.1
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vue-material-dashboard
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
// * Licensed under MIT (https://github.com/creativetimofficial/vue-material-dashboard/blob/master/LICENSE.md)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from "vue";
import VueRouter from "vue-router";
import App from "./App";
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueExcelXlsx from "vue-excel-xlsx";
import moment from 'moment';
import VueSession from 'vue-session';




// router setup
import routes from "./routes/routes";

// Plugins
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import Notifications from "./components/NotificationPlugin";

// MaterialDashboard plugin
import MaterialDashboard from "./material-dashboard";

import Chartist from "chartist";

import Mapbox from 'mapbox-gl';

// Tools View
//import ToolsView from "./pages/Tool/View.vue";

// Tools Add
//import ToolsAdd from "./pages/Tool/Add.vue";

// configure router
const router = new VueRouter({
  routes, // short for routes: routes
  linkExactActiveClass: "nav-item active"
});

//const moment = require('moment');

Vue.prototype.$Chartist = Chartist;

Vue.prototype.moment = moment;

Vue.use(VueRouter);
Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(Notifications);
Vue.use(Mapbox);
Vue.use(VueAxios, axios);
Vue.use(VueExcelXlsx);
Vue.use(VueSession);

/* eslint-disable no-new */
new Vue({
  el: "#app",
  render: h => h(App),
  router,
  moment,
  data: {
    Chartist: Chartist
  }
});
