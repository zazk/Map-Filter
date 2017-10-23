<template>
  <div class="box">
    <aside class="aside--bar">
      <div class="box-itm">
        <h3>LOCATION</h3>
        <input type="text" class="form-control">
      </div>
      <div class="box-itm">
        <h3>PRICE RANGE</h3>
        <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
      </div>
      <div class="box-itm">
        <h3>BEDROOMS</h3>
        <input type="text">
      </div>
      <div class="box-itm">
        <h3>BATHROOMS</h3>
        <input type="text">
      </div>
      <div class="box-itm">
        <h3>LEASE DURATION</h3>
        <select class="form-control" name="" id="">
          <option value="">8 Months</option>
        </select>
      </div>
      <div class="box-itm">
        <h3>LEASE DURATION</h3>
        <input type="text" class="form-control">
      </div>
    </aside>
    <div class="map" id="google-maplima"></div>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: ''
    }
  },
  mounted (){



     function initMaplima() {
      var $map = $( '#google-maplima' );
      if ( ! $map.length ) return;
      var myLatlng = new google.maps.LatLng(-12.086676, -77.058986,18); // <- Your latitude and longitude
      
      var mapOptions = {
        zoom             : 15,
        center           : myLatlng,
        mapTypeControl   : true,
        disableDefaultUI : true,
        zoomControl      : true,
        scrollwheel      : false,
        draggable        : true
      }
      var map = new google.maps.Map(document.getElementById('google-maplima'), mapOptions);

      var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          //icon:'img/icon-map.png'
      });
    }
    google.maps.event.addDomListener(window, 'load', initMaplima);   
  }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .aside--bar{
    width: 30%;
    height: 100vh;
    background: orange;
    padding: 20px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    text-align: left;
  }
  .map{
    width: 70%;
    height: 100vh;
  }
  .box{
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: center;
  }
</style>
