<template>
  <div class="box">
    <nav class="navheader">
      <div class="menuH">
        <span class="menuopen">
          <img src="static/menu.svg" width="25" height="25" alt="">  
        </span>
        <span class="menuclose">
          <img src="static/close.svg" width="25" height="25" alt="">
        </span>
      </div> 
      <a class="nav--logo" href="">
        <img src="static/logo.png" width="" height="40" alt="">
      </a>
    </nav>
    <div class="box--flex">
      <aside class="aside--bar">
        <div class="box-itm">
          <h3>Distrito</h3>
          <select name="" v-model="filtros.distrito" class="form-control" id="" @change="addFilter($event)">
            <option>Todos</option>
            <option v-for="distrito in districts" :value="distrito.distrito">{{distrito.distrito}}</option>
          </select>
        </div>
        <div class="box-itm">
          <h3>Estado</h3> 
          <select name="" v-model="filtros.estado" class="form-control" id="" @change="addFilter($event)">  
            <option>Todos</option>
            <option v-for="estado in estados" :value="estado.estado">{{estado.estado}}</option>
          </select>
        </div>   
        <div class="box-itm tooltip_1">
          <h3>Edad</h3>
          <input id="ex2" type="text" class="span2 input--slider_1" value="" 
            data-slider-min="10" 
            data-slider-max="80" 
            data-slider-step="5"
            data-slider-value="[10,80]"
             />
          <span class="box--price">
            <b>&nbsp;</b>  <b></b> 
          </span>   
        </div>        
        <div class="box-itm tooltip_1">
          <h3>Trabajadores</h3>
          <input id="ex3" type="text" class="span2 input--slider_2" value="" 
            data-slider-min="1" 
            data-slider-max="10" 
            data-slider-step="1"
            data-slider-value="[1,10]"
             />
          <span class="box--price">
            <b>&nbsp;</b>  <b></b> 
          </span>   
        </div>
        <div >
          <div class="box-itm">
            <h3>Educación</h3>
            <template v-for="e in educacion">
              <div class="boxinput">
                <label>
                  <input type="checkbox" v-model="educaciones" :value="e.educacion" @change="addFilter($event)"> {{ e.educacion }}
                </label>
              </div>
            </template>
          </div>     
          <div class="btn_aside">
            <button class="btn btn-primary">
              <img src="static/reload.svg" width="15" height="15" alt="">
              Recargar filtros
            </button>
          </div>
        </div>
      </aside>
      <div class="map">
        <div id="google-maplima"></div>  
        <div class="preload" style="">
          <div class="imgpreload">
            <img src="static/preload.gif" alt="">
          </div>
        </div>
        <div class="map--etiqueta">
          <span>{{total}} Puntos</span>
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
      mapa:null,
      markerCluster:null,
      total:0,
      locations : [],
      location : [],
      estados :[],
      districts :[], 
      edad :{edad:0,min:0,max:0},
      educacion :[],
      educaciones:[],
      filtros:{
        trabajador:{min:0,max:0},
        distrito:"Todos",
        estado:"Todos",
        edad :{min:0,max:0},
      }
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
  },
  methods:{
    getdatos(){
      let url = 'http://w.areminds.com/api/parse.php';
      self = this;
      axios.get(url)
        .then((respuesta) => {
          this.estados = respuesta.data.estados;
          this.districts = respuesta.data.distritos;
          this.edad  = respuesta.data.edad;
          this.filtros.edad.max = this.edad.edad;
          this.filtros.trabajador.max = respuesta.data.trabajadores.trabajadores;
          this.educacion = respuesta.data.educacion;
          console.log('educacion', respuesta.data.educacion)

          // MAPA
          var locations = respuesta.data.locations;
          this.locations = locations;
          
          // Create Marks
          this.createMarkers( locations, this.createMap() );

          // SLIDER 
          new Slider('.input--slider_1', {tooltip:'always'}).on("slideStop", function(sliderValue) {

            console.log("Slider Value",this,sliderValue);
            self.filtros.edad.min = sliderValue[0];
            self.filtros.edad.max = sliderValue[1];
            self.addFilter();

          });

          new Slider('.input--slider_2', {tooltip:'always'}).on("slideStop", function(sliderValue) {

            console.log("Slider Value",this,sliderValue);
            self.filtros.trabajador.min = sliderValue[0];
            self.filtros.trabajador.max = sliderValue[1];
            self.addFilter();

          });
          
        })
        console.log('datos',location);
    },


    addFilter( event ){

      var rows = [];
      console.log("Filtros",this.filtros);
      for (var i = 0, t = this.locations.length; i < t; i++) {  
        let loc = this.locations[i];

        let isDistritoValid = (this.filtros.distrito == 'Todos')? true : 
          this.filtros.distrito == loc.distrito;
        let isEstadoValid = (this.filtros.estado == 'Todos')? true : 
          this.filtros.estado == loc.estado;
        let isEdadValid = (loc.edad_1 >= this.filtros.edad.min && 
          loc.edad_1 <= this.filtros.edad.max);
        let isTrabajadoresValid = (loc.nro_trabajadores >= this.filtros.trabajador.min && 
          loc.nro_trabajadores <= this.filtros.trabajador.max);

        if(this.educaciones.length > 0){
          console.log("Educaciones Checked",this.educaciones);
          for( var j=0,s = this.educaciones.length;j<s;j++ ){

          } 
        }
        let isEducacion = true;//this.filtros.estado == loc.educacion_1;

        if( isDistritoValid && isEstadoValid && isEdadValid 
            && isTrabajadoresValid && isEducacion ){
          rows.push(loc);
          continue;
        }
      }

      //Add New Markers
      this.createMarkers( rows, this.createMap() );
    },

    createMap(){
      return new google.maps.Map(document.getElementById('google-maplima'), {
        zoom: 14,
        center: new google.maps.LatLng(this.locations[0]['latitud'], this.locations[0]['longitud']),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
    },

    createMarkers( locations, map ){
      console.log("Create Markers");
      // Info Windows to Show Marker Information
      var infowindow = new google.maps.InfoWindow();
      // Square to use to center the map
      var bounds = new google.maps.LatLngBounds();

      var marker, markers =[], i;
      for (var i = 0, t = locations.length; i < t; i++) {
        
        // Set Coordinates  
        var myLatLng = new google.maps.LatLng(locations[i]['latitud'], locations[i]['longitud']);
        
        // Create Marker for each point
        marker = new google.maps.Marker({
          position: myLatLng,
          //map: map,
          icon:'./static/map/location.png'
        });

        // extend the size of the map
        bounds.extend(myLatLng);
        
        //Create Array of Markers
        markers.push( marker );

        //Create event
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(
              `<h4> ${locations[i].nombre_del_establecimiento} </h4>
                <form x-update-points>
                  Latitud: 
                    <input name="latitud" x-latitud value="${locations[i].latitud}" /> 
                  Longitud: 
                    <input name="longitud" x-longitud value="${locations[i].longitud}" />
                  <input type="hidden" name="id" x-id value="${locations[i].id}" />
                  <br>
                <button x-update >Refresh Points</button> 
                <form>
                ID: ${locations[i].id}
              <br>
              Distrito: ${locations[i].distrito}
              <br>
              Fecha: ${locations[i].fecha}
              <br>
              Estado: ${locations[i].estado}
              <br>
              Razon Social: ${locations[i].razon_social_del_establecimiento} `+
              '<br>'+
              'Celular: ' +locations[i].celular_local_1+' '+locations[i].celular_local_2+' '+locations[i].celular_local_3+
              '<br>'+
              'Telefono: ' +locations[i].telefonos_local_1+' '+locations[i].telefonos_local_1+' '+locations[i].telefonos_local_1+
              '<br>'+
              'Tamaño: ' +locations[i].tamano_frente_m2+' '+locations[i].tamano_fondo_m2+
              '<br>'+
              'Direccion: ' +locations[i].direccion_nombre_de_la_via+' '+locations[i].direccion_enumeracion+' '+locations[i].direccion_nro_interior+' '+locations[i].direccion_urbanizacion+' '+locations[i].direccion_referencia_1+' '+locations[i].direccion_referencia_2+' '+locations[i].direccion_referencia_3+
              '<br>'+
              'Propietario: ' +locations[i].propietario_nombres+' '+locations[i].propietario_apellido_paterno+' '+locations[i].propietario_apellido_materno+
              '<br>'+
              'Aministrador: ' +locations[i].administrador_nombres+' '+locations[i].administrador_apellido_paterno+' '+locations[i].administrador_apellido_materno+
              '<br>'+
              'Informante: ' +locations[i].informante_nombres+' '+locations[i].informante_apellido_paterno+' '+locations[i].informante_apellido_materno+'<br>'+
              locations[i].informante_telefonos+'<br>'+
              locations[i].informante_celular+'<br>'+
              locations[i].informante_edad+'<br>'+
              locations[i].informante_email
            );
            infowindow.open(map, marker);

            // Update Points
         
            $('[x-update-points]').on('submit',function(e){
              e.preventDefault();
              let longitud = $('[x-longitud]');
              let latitud = $('[x-latitud]');
              let id = $('[x-id]');
              let url = "http://w.areminds.com/api/parse.php?" + $('[x-update-points]').serialize();
              console.log('sent points', longitud,latitud, id, 'url:', url);
              axios.get(url)
                .then((r) => { 
                  console.log("Response", r);
                  alert( JSON.stringify(r) );
                });

            })
            //---------
          }
        })(marker, i));
      }

      // Add a marker clusterer to manage the markers.
      this.markerCluster = new MarkerClusterer(map, markers, {
        imagePath: './static/map/m'
      });

      //Center to Map Size
      map.fitBounds(bounds);

      // Set the total Results
      this.total = locations.length;

      // Remove Loading
      $('.preload').css('display', 'none');
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >
  .tooltip_1.active .tooltip{
    opacity: 1 !important;
    margin-top:-20px !important;
  } 
  .tooltip.top.in{
    opacity: 0 !important;
  }
  .slider.slider-horizontal{
    margin-left: 15px;
    width: 260px !important; 
  }
  .preload{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 200;
    margin: auto;
    background: #fff;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    -ms-align-items: center;
    align-items: center;
    justify-content: center;
  }
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
    font-size: 15px;
    padding:10px; 
    line-height: 100%;
  }

  .boxinput input[type=checkbox]{
    
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
    top: 10px;
    z-index: 600;
    right: 0;
    background: #fff;
    height: 40px;
    font-size: 14px;
    line-height: 40px;
    border-radius: 6px 0px 0px 6px;
    color:#797979;
    padding: 0px 10px 0px 30px;
    text-align: right;
    font-weight: bold;
    box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
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
    height: calc(100vh - 60px);
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
  .tooltip.top{
    opacity: 1 !important;
    display: block !important;
    margin-top:22px !important;
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
