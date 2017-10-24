<template>
  <div class="seccion--login">
    <h2 class="login--title">Log in with your email account</h2>  
    <form id="form_login">
      <div class="box--input">
        <input type="text" class="form-control" placeholder="somebody@example.com" id="user">
        <label class="text--error"> Usuario incorrecto</label>
      </div>
      <div class="box--input">
        <input type="password" class="form-control input_password" placeholder="Password" id="password">
        <label class="text--error"> Contraseña incorrecta</label>

      </div>
      <div class="check--box">
        <input class="show--password" type="checkbox" id="check--input">
        <label for="check">show password</label>
      </div>
      <div class="box-btn">
        <button type="submit" class="btn btn-primary btn--login">Login</button>
      </div>
      <p>Forgot your password?</p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Welcome to Your Login Component'
    }
  },
  mounted (){
    $('#form_login').submit(function(e) {
      e.preventDefault()
      let usuario = "mauricio",
          clave = "admin",
          user = $('#user').val(),
          pass = $('#password').val();

      if ( user == usuario && pass == clave ) {
        console.log('formulario enviado correctamente');
        window.location.href = '#/map';
      } else {
        console.log('formulario no enviado');
        $('.text--error').show();
        setTimeout(function() {
            $('.text--error').hide('fast');
        }, 5000);
      }
    });
  },
  methods: {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .text--error{
    color: red;
    display: none;
    text-align: left;
    font-size: 13px;
    width: 100%;
    font-weight: 600;
    font-family: 'arial', sanserif;
    
  }
  .login--title{
    font-size: 18px;
    color:#30A9A0;
    margin-bottom: 30px;
  }
  .seccion--login{
    max-width: 300px;
    width: 94%;
    margin: auto;
    padding-top: 100px;
  }
  .box--input{
    margin-bottom: 25px;
  }
  .check--box{
    text-align: left;
    margin-bottom: 40px;
    position: relative;
  }
  .btn--login{
    background: #30A9A0;
    border: 1px solid #30A9A0;
    margin-bottom: 20px;
  }
</style>
