<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <notifications></notifications>

    <side-bar>
      <!--<mobile-menu slot="content"></mobile-menu>-->
      <sidebar-link to="/dashboard">
        <md-icon>dashboard</md-icon>
        <p>Dashboard</p>
      </sidebar-link>
      <sidebar-link to="/users">
        <md-icon>person</md-icon>
        <p>Users</p>
      </sidebar-link>
      <sidebar-link to="/tools">
        <md-icon>scanner</md-icon>
        <p>Tools</p>
      </sidebar-link>
      <sidebar-link to="/report">
        <md-icon>insert_drive_file</md-icon>
        <p>Report</p>
      </sidebar-link>
    </side-bar>

    <div class="main-panel">
      <top-navbar v-if="!$route.meta.hideTopNavbar"></top-navbar>

      <dashboard-content> </dashboard-content>

      <content-footer v-if="!$route.meta.hideFooter"></content-footer>
    </div>
  </div>
</template>
<style lang="scss"></style>
<script>
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "@/pages/Layout/MobileMenu.vue";

export default {
  components: {
    TopNavbar,
    DashboardContent,
    ContentFooter,
    MobileMenu
  }
};
</script>
