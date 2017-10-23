<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
  </div>
</template>

<script>

import axios from 'axios'
export default {
  name: 'Map',
  data () {
    return {
      msg: 'Welcome to Map Component',
      errors: [],
      points:[]
    }
  },
  created () {
    var self = this;
    //------------------------ 
    axios.get(`./static/data/db.js`)
    .then(r => {
      // JSON responses are automatically parsed.
      // this.posts = response.data
      console.log("Data Elementssss",r.data[0])
      let urlBase = 'https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyBmEwV9vl1UJv_m5_Teedtyjk8rPsbL4DY&address='
      for (var i = 0, len = r.data.length; i < len; i++) {
        console.log("Data Len" + i);
        //setTimeout( ()=> {
        console.log("Send URL" + r.data[i] );
        // Get Point
        let point = r.data[i]
        console.log(point)
        let urlPoint = point.avenida + ' ' + point.numero + ' ' + point.distrito
        let urlAddress = urlBase + urlPoint 

        if( i >=0 && i <80 ){
          continue; 
        }
        console.log('Pass');
        if( i >= 81 ){ 
          //print data     
          break;
        } 
        axios.get(urlAddress,{index:i})
          .then(response => {
            let obj = response.data.results[0] 
            console.log('Address:', response.data, "Config Indexss:", response.config )  
            console.log(' Google Maps Point ', obj.geometry.location.lat, obj.geometry.location.lng)
            // Associate the data with Points
            self.points.push({ 
              index:response.config.index,
              url: response.config.url.replace(urlBase,'') , 
              address: obj.formatted_address ,
              points:obj.geometry.location
              })
            console.log("Stringsss:", JSON.stringify( self.points ) ) 
            console.log("Points", self.point);
        })
        //},(1000*i));
        //break;
      }
    })
    .catch(e => {
      console.log(e);
      this.errors.push(e)
    })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
