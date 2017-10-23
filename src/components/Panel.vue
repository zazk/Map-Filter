<template>
  <div class="box">
    <aside class="aside--bar">
      <div class="box-itm">
        <h3>LOCATION</h3>
        <input type="text" class="form-control" placeholder="Enter a location e.g. Hamilton">
      </div>
      <div class="box-itm">
        <h3>PRICE RANGE</h3>
        <input id="ex2" type="text" class="span2 input--slider_1" value="" 
          data-slider-min="10" 
          data-slider-max="1000" 
          data-slider-step="5" 
          data-slider-value="[250,450]"/>
        <span class="box--price">
          <b>€ 10</b>  <b>€ 1000</b> 
        </span>   
      </div>
      <div class="box-itm">
        <h3>BEDROOMS</h3>
        <input id="ex3" type="text" class="span2 input--slider_2" value="" 
          data-slider-min="10" 
          data-slider-max="1000" 
          data-slider-step="5" 
          data-slider-value="[250,450]"/>
        <span class="box--price">
          <b>€ 10</b>  <b>€ 1000</b> 
        </span> 
      </div>
      <!-- BOX FILTERS -->
      <div class="box--filter">
        <span>ADVANCED FILTERS</span>
      </div>

      <div class="box-itm">
        <h3>BATHROOMS</h3>
        <input id="ex4" type="text" class="span2 input--slider_3" value="" 
          data-slider-min="10" 
          data-slider-max="1000" 
          data-slider-step="5" 
          data-slider-value="[250,450]"/>
        <span class="box--price">
          <b>€ 10</b>  <b>€ 1000</b> 
        </span>
      </div>
      <div class="box-itm">
        <h3>LEASE DURATION</h3>
        <select class="form-control" name="" id="">
          <option value="">8 Months</option>
        </select>
      </div>
      <div class="box-itm">
        <h3>LEASE DURATION</h3>
        <input type="text" class="form-control" placeholder="Enter Date">
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
    var slider = new Slider('.input--slider_1', {});
    var slider = new Slider('.input--slider_2', {});
    var slider = new Slider('.input--slider_3', {});

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
  .box--filter{
    background: #ccc;
  }
  .aside--bar{
    width: 30%;
    height: 100vh;
    background: #f1f1f1;
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
  .box--price{
    display: block;
  }
  .box{
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: center;
  }
  .box-itm{
    padding: 30px 0;
  }
  .box-itm h3{
    font-size: 16px;
    font-weight: bold;
  }
</style>
