<template>
  <md-card class="md-card-profile">
    <md-card-content>
      <h2>Our Team</h2>
      <div>
        <img class="img" style="width: 15%; height:15%" :src="Shinobi" />
      </div>
    </md-card-content>

    <md-card-content>
      <div style="padding-top: 35px;">
        <div class="md-card-avatar">
          <img class="img" :src="Hendra" />
        </div>
      </div>
    </md-card-content>

    <md-card-content>
      <div>
        <h6 class="category text-gray">Mentor</h6>
        <h4 class="card-title">Hendra Kusuma S.Kom., M.TI.</h4>
        <p class="card-description">
          Dosen terbaik di Raharja, bisa segala hal dalam mekatronika mulai dari robotik hingga AI.
        </p>
      </div>
    </md-card-content>

    <md-card-content>
      <div style="padding-top: 30px;">
        <div class="md-card-avatar">
          <img class="img" :src="Sohit" />
        </div>
      </div>
    </md-card-content>

    <md-card-content>
      <div>
        <h6 class="category text-gray">Hardware Engineer</h6>
        <h4 class="card-title">Nursohit</h4>
        <p class="card-description">
          Orangnya diem tapi kadang konyol, denger-denger dia lagi deketin seorang cewek. Penerus Bang Yo.
        </p>
      </div>
    </md-card-content>

    <md-card-content>
      <div style="padding-top: 30px;">
        <div class="md-card-avatar">
          <img class="img" :src="Budi" />
        </div>
      </div>
    </md-card-content>

    <md-card-content>
      <div>
        <h6 class="category text-gray">Software Engineer</h6>
        <h4 class="card-title">Budi Yusuf</h4>
        <p class="card-description">
          Saya yang buat apps ini. haha..
        </p>
      </div>
    </md-card-content>

    <md-card-content>
      <div style="padding-top: 30px;">
        <div class="md-card-avatar">
          <img class="img" :src="Dede" />
        </div>
      </div>
    </md-card-content>

    <md-card-content>
      <div>
        <h6 class="category text-gray">Hustler</h6>
        <h4 class="card-title">Dede Rohmat Hidayat</h4>
        <p class="card-description">
          Paling aktif diantara yang lain, kadang suka aneh. Dia yang pasti maju ke depan.
        </p>
      </div>
    </md-card-content>

    <md-card-content>
      <div style="padding-top: 30px;">
        <div class="md-card-avatar">
          <img class="img" :src="Cecep" />
        </div>
      </div>
    </md-card-content>

    <md-card-content>
      <div>
        <h6 class="category text-gray">Technical Support</h6>
        <h4 class="card-title">Cecep Nurcahya</h4>
        <p class="card-description">
          Jago desain, anehnya trauma sama hal yang berbau kemenangan.
        </p>
      </div>
    </md-card-content>
    <router-link to="/dashboard"> Back </router-link>
  </md-card>
</template>
<script>
export default {
  name: "detail",
  props: {
    Shinobi: {
      type: String,
      default: require("@/assets/img/shinobi.jpeg")
    },
    Hendra: {
      type: String,
      default: require("@/assets/img/hendra.jpeg")
    },
    Sohit: {
      type: String,
      default: require("@/assets/img/sohit.jpeg")
    },
    Budi: {
      type: String,
      default: require("@/assets/img/budi.jpeg")
    },
    Dede: {
      type: String,
      default: require("@/assets/img/dede.jpeg")
    },
    Cecep: {
      type: String,
      default: require("@/assets/img/cecep.jpeg")
    }
  },
  data() {
    return {
      errorMessage : "",
      successMessage : "",
      users: []
    };
  },
  mounted: function () {
  },
  methods: {
  }
};
</script>
<style></style>
