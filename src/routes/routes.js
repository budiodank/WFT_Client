import DashboardLayout from "@/pages/Layout/DashboardLayout.vue";

import Dashboard from "@/pages/Dashboard.vue";
import UserProfile from "@/pages/UserProfile.vue";
import Users from "@/pages/Users.vue";
import DetailUser from "@/pages/Users/Detail.vue";
import EditUser from "@/pages/Users/Edit.vue";
import TableList from "@/pages/TableList.vue";
import Typography from "@/pages/Typography.vue";
import Icons from "@/pages/Icons.vue";
import Maps from "@/pages/Maps.vue";
import MapsApi from "@/pages/MapsApi.vue";
import Tools from "@/pages/Tools.vue";
import Report from "@/pages/Report.vue";
import DetailPH from "@/pages/Tools/PHDetail.vue";
import DetailWaste from "@/pages/Tools/WasteDetail.vue";
import Vibration from "@/pages/Tools/Vibration.vue";
import FlowWater from "@/pages/Tools/FlowWater.vue";
import WaterLevel from "@/pages/Tools/WaterLevel.vue";
import Relay from "@/pages/Tools/Relay.vue";
import Notifications from "@/pages/Notifications.vue";
import UpgradeToPRO from "@/pages/UpgradeToPRO.vue";
import Shinobi from "@/pages/Shinobi.vue";
import Login from "@/pages/Login.vue";

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "login",
    children: [
      {
        path: "dashboard",
        name: "Dashboard",
        component: Dashboard
      },
      {
        path: "user",
        name: "User Profile",
        component: UserProfile
      },
      {
        path: "users",
        name: "Users",
        component: Users
      },
      {
        path: "users/detail/:id",
        name: "Detail User",
        component: DetailUser
      },
      {
        path: "users/edit_user/:id",
        name: "Edit User",
        component: EditUser
      },
      {
        path: "table",
        name: "Table List",
        component: TableList
      },
      {
        path: "typography",
        name: "Typography",
        component: Typography
      },
      {
        path: "icons",
        name: "Icons",
        component: Icons
      },
      {
        path: "maps",
        name: "Maps",
        meta: {
          hideFooter: true
        },
        component: Maps
      },
      {
        path: "maps-api",
        name: "MapsApi",
        component: MapsApi
      },
      {
        path: "tools",
        name: "Tools",
        component: Tools
      },
      {
        path: "tools/detailph/:id",
        name: "Detail PH Tools",
        component: DetailPH
      },
      {
        path: "tools/detailwaste/:id",
        name: "Detail Waste Tools",
        component: DetailWaste
      },
      {
        path: "tools/detailvibration/:id",
        name: "Detail Vibration Tools",
        component: Vibration
      },
      {
        path: "tools/detailwaterflow/:id",
        name: "Detail Water Flow Tools",
        component: FlowWater
      },
      {
        path: "tools/detailwaterlevel/:id",
        name: "Detail Water Level Tools",
        component: WaterLevel
      },
      {
        path: "tools/detailrelay/:id",
        name: "Detail Relay Tools",
        component: Relay
      },
      {
        path: "report",
        name: "Report",
        component: Report
      },
      {
        path: "notifications",
        name: "Notifications",
        component: Notifications
      },
      {
        path: "upgrade",
        name: "Upgrade to PRO",
        component: UpgradeToPRO
      },
      {
        path: "shinobi",
        name: "Shinobi",
        component: Shinobi
      },
      {
        path: "login",
        name: "Login",
        meta: {
          hideFooter: true,
          hideTopNavbar: true
        },
        component: Login
      }
    ]
  }
];

export default routes;
