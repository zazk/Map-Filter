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
        <span>ADVANCED FILTERS <i></i></span>
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
          // icon:'location.png'
      });
    }
    google.maps.event.addDomListener(window, 'load', initMaplima);   
  }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .box--filter{
    background: #E8E8E8;
    padding: 15px 10px;
    border-bottom: 1px solid #D9D9D9;
    position: relative;
    font-weight: 500;
    color:#797979;
  }
  .box--filter i{
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 4px 7px 4px;
    border-color: transparent transparent #A7A7A7 transparent;
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
    right: 10px;
  }
  .aside--bar{
    width: 25%;
    height: 100vh;
    background: #F3F3F3;
    padding: 20px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    text-align: left;
  }
  .map{
    width: 75%;
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
    border-bottom: 1px solid #E2E2E2;
  }
  .box-itm h3{
    font-size: 16px;
    font-weight: bold;
    color: #797979;
  }
</style>
