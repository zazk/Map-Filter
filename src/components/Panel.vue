<template>
  <div class="box">
    <nav class="navheader">
      <div class="menuH">
        <span class="menuopen">
          <img src="/static/menu.svg" width="25" height="25" alt="">  
        </span>
        <span class="menuclose">
          <img src="/static/close.svg" width="25" height="25" alt="">
        </span>
      </div> 
      <a class="nav--logo" href="">
        <img src="/static/logo.png" width="" height="40" alt="">
      </a>
    </nav>
    <div class="box--flex">
      <aside class="aside--bar">
        <div class="box-itm">
          <h3>Distrito</h3>
          <select name="" class="form-control" id="">
            <option value="">Distrito</option>
          </select>
        </div>
        <div class="box-itm">
          <h3>Estado</h3>
          <select name="" class="form-control" id="">
            <option value="">Estado</option>
          </select>
        </div>
        <div class="box-itm">
          <h3>Tamaño</h3>
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
          <h3>Nombre de Via</h3>
          <select name="" class="form-control" id="">
            <option value="">Nombre de Via</option>
          </select>
        </div>
        <div class="box-itm">
          <h3>Urbanización</h3>
          <select name="" class="form-control" id="">
            <option value="">Urbanización</option>
          </select>
        </div>
        <div class="box-itm">
          <h3>Actividad</h3>
          <div class="boxinput">
            <input type="checkbox"> activa1
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa2
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa3
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa4
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa5
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa6
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa7
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa8
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa9
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa10
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa11
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa12
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa13
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa14
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa15
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa16
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa17
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa18
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa19
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa20
          </div>
        </div>
        <div class="box-itm">
          <h3>Edad</h3>
          <div class="boxinput">
            <input type="checkbox"> activa1
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa2
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa3
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa4
          </div>
        </div>
        <div class="box-itm">
          <h3>Educación</h3>
          <div class="boxinput">
            <input type="checkbox"> activa1
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa2
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa3
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa4
          </div>
        </div>
        <div class="box-itm">
          <h3>Cargo / Funciones</h3>
          <div class="boxinput">
            <input type="checkbox"> activa1
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa2
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa3
          </div>
          <div class="boxinput">
            <input type="checkbox"> activa4
          </div>
        </div>
        <div class="btn_aside">
          <button class="btn btn-primary">
            <img src="/static/reload.svg" width="15" height="15" alt="">
            recargar filtros
          </button>
        </div>
      </aside>
      <div class="map">
        <div id="google-maplima"></div>  
        <div class="map--etiqueta">
          <span>150 Listings Found</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'Panel',
  data () {
    return {
      location : []
    }
  },
  mounted() {
    this.getdatos()
    // SCRIPT PARA ABRIR EL MENU RESPONSI Y CERRAR
    $('.menuH .menuopen').click(function(event) {
      $(this).addClass('active');
      $('.aside--bar').addClass('active');
      $('.map').addClass('active');
      $('.menuclose').addClass('active');
    });
    $('.menuH .menuclose').click(function(event) {
      $(this).removeClass('active');
      $('.menuopen').removeClass('active');
      $('.map').removeClass('active');
      $('.aside--bar').removeClass('active');
    });
    // END MENU
    // SLIDER 
    var slider = new Slider('.input--slider_1', {});
    // MAPA
    var locations = [
      {
        "index": 0,
        "url": "Av. Angamos Este 180 Surquillo",
        "address": "Av. Angamos Este 180, Miraflores 15074, Peru",
        "points": {
            "lat": -12.1138421,
            "lng": -77.0289209
        }
      } 
    ];
    var map = new google.maps.Map(document.getElementById('google-maplima'), {
      zoom: 14,
      center: new google.maps.LatLng(locations[0]['points']['lat'], locations[0]['points']['lng']),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i]['points']['lat'], locations[i]['points']['lng']),
        map: map,
        icon:'/static/location.png'
      });
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i]['url']);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  },
  methods:{
    getdatos(){
      let url = 'http://w.areminds.com/api/parse.php';
      axios.get(url)
        .then((respuesta) => {
          this.location = respuesta.data;
        })
        console.log('datos',location);
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .btn_aside{
    margin-top: 30px;
    text-align: center;
    
  }
  .btn_aside img{
    width: 15px;
    height: 15px;
  }
  .boxinput{
    width: 48%;
    display: inline-block;
    vertical-align: top;
  }
  .box{
    overflow: hidden;
  }
  .menuH{
    position: absolute;
    top: 0;
    left: 20px;
    bottom: 0;
    width: 40px;
    height: 40px;
    line-height: 38px;
    margin: auto;
    opacity: 0;
    visibility: hidden;
    background: #30A9A0;
    padding: 10px;
    border-radius: 6px;
    
  }
  .menuH span{
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    margin: auto;
    cursor: pointer;
    width: 24px;

  }
  .menuclose{
    opacity: 0;
    visibility: hidden;
    
  }
  .menuclose.active{
    opacity: 1;
    visibility: visible;
    
  }
  .menuopen.active{
    opacity: 0;
    visibility: hidden;
    
  }
  .navheader{
    padding: 10px 0;
    position: relative;
  }
  .map--etiqueta{
    position: absolute;
    z-index: 600;
    right: 0;
    background: #fff;
    height: 40px;
    line-height: 40px;
    border-radius: 6px 0px 0px 6px;
    color:#797979;
    padding: 0px 10px 0px 30px;
    text-align: right;
    font-weight: bold;
  }
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
    height: calc(100vh - 60px);
    background: #F3F3F3;
    padding: 20px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    text-align: left;
    overflow: auto;

  }
  .map{
    width: 75%;
    height: calc(100vh - 60px);
    position: relative;
  }
  .map.active{
      right: -300px;
    }
  .map #google-maplima{
    position: absolute;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100%;
  }
  .box--price{
    display: block;
  }
  .box--flex{
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: center;
    position: relative;
  }
  .box-itm{
    padding: 30px 0;
    border-bottom: 1px solid #E2E2E2;
  }
  .box-itm h3{
    font-size: 16px;
    font-weight: bold;
    color: #797979;
    font-family: 'arial', sanserif;
  }
  @media screen and (max-width: 1024px) {
    .aside--bar{
      width: 40%;
    }
    .map{
      width: 60%;
    }
  }
  @media screen and (max-width: 768px) {
    .menuH{
      opacity: 1;
      visibility: visible;
    }
    .aside--bar{
      left: -300px;
      position: absolute;
      top: 0;
      width: 300px;
    }
    .aside--bar.active{
      left: 0;
    }
    .map{
      width: 100%;
    }

  }
</style>
