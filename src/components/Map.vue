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
      errors: []
    }
  },
  created () {
    axios.get('https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyBmEwV9vl1UJv_m5_Teedtyjk8rPsbL4DY')
    .then(response => {
      console.log('Address:', response.data)
    })
    axios.get(`./static/data/db.js`)
    .then(response => {
      // JSON responses are automatically parsed.
      // this.posts = response.data
      console.log(response.data[0])
      let point = response.data[0]
      console.log(point)
      let urlBase = 'https://maps.googleapis.com/maps/api/geocode/json?address='
      let urlPoint = point.avenida + ' ' + point.numero + ' ' + point.distrito
      let urlAddress = urlBase + urlPoint
      axios.get(urlAddress)
      .then(response => {
        console.log('Address:', response.data)
        console.log(' Google Maps Point ', response.data.results[0].geometry.location.lat, response.data.results[0].geometry.location.lng)
      })
    })
    .catch(e => {
      this.errors.push(e)
    })
  }
}
</script>
 
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
