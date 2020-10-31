<template>
	<div id='mapbox'></div>
</template>

<script>
import mapboxgl from 'mapbox-gl';

require('../../node_modules/mapbox-gl/dist/mapbox-gl.css');

export default {
  name: 'mapbox',
  data() {
    return {
      apiKey:  'pk.eyJ1IjoiYnVkaW9kYW5rIiwiYSI6ImNrMGRyM2RuYTA2ZG0zbWsxdWx1cjhxMG0ifQ.4lvzq1eA8Kp8Pg7w5lAFRg',
    };
  },
  mounted() {
    this.createMap();
  },
  methods: {
  	detail () {
      this.$router.push('tools/detailph/e795b8')
    },
    createMap() {
      mapboxgl.accessToken = this.apiKey;
      // init the map
      var map = new mapboxgl.Map({
        container: 'mapbox',
        style: 'mapbox://styles/mapbox/streets-v11',
        minzoom: 1.3,
        center: [106.6258872, -6.1958739], 
        zoom: 14.15,
      });

      	map.on('load', function () {
		    // Add a layer showing the places.
		    map.addLayer({
		        "id": "places",
		        "type": "symbol",
		        "source": {
		            "type": "geojson",
		            "data": {
		                "type": "FeatureCollection",
		                "features": [{
		                    "type": "Feature",
		                    "properties": {
		                        "description": "<strong>Sensor Cleaner River #1</strong><p @click=\"detail()\"><a href=\"./#/tools/detailph/e795b8\" title=\"Read Data\">Jembatan Teuku Umar</a> Terletak di Jl. Teuku Umar, Kota Tangerang, Banten</p>",
		                        "icon": "waterfall"
		                    },
		                    "geometry": {
		                        "type": "Point",
		                        "coordinates": [106.6258872, -6.1958739]
		                    }
		                }, {
		                    "type": "Feature",
		                    "properties": {
		                        "description": "<strong>Sensor Cleaner River #2</strong><p @click=\"detail()\"><a href=\"./#/tools/detailph/e795b8\" title=\"Read Data\">Jembatan Cisadane Cikokol</a> Terletak di Jl. Baru, RT.007/RW.006, Cikokol, Kec. Tangerang, Kota Tangerang, Banten</p>",
		                        "icon": "waterfall"
		                    },
		                    "geometry": {
		                        "type": "Point",
		                        "coordinates": [106.6242765, -6.2018063]
		                    }
		                }]
		            }
		        },
		        "layout": {
		            "icon-image": "{icon}-15",
		            "icon-allow-overlap": true
		        }
		    });

		    // When a click event occurs on a feature in the places layer, open a popup at the
		    // location of the feature, with description HTML from its properties.
		    map.on('click', 'places', function (e) {
		        var coordinates = e.features[0].geometry.coordinates.slice();
		        var description = e.features[0].properties.description;

		        // Ensure that if the map is zoomed out such that multiple
		        // copies of the feature are visible, the popup appears
		        // over the copy being pointed to.
		        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
		            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
		        }

		        new mapboxgl.Popup()
		            .setLngLat(coordinates)
		            .setHTML(description)
		            .addTo(map);
		    });

		    // Change the cursor to a pointer when the mouse is over the places layer.
		    map.on('mouseenter', 'places', function () {
		        map.getCanvas().style.cursor = 'pointer';
		    });

		    // Change it back to a pointer when it leaves.
		    map.on('mouseleave', 'places', function () {
		        map.getCanvas().style.cursor = '';
		    });
		});
  	},
  },
};
</script>
<style>
	#mapbox {
	  	width: 100%;
	  	height: 500px;
	}
	.mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }
</style>