<template>
  <div class="seccion--login">
    <h2 class="login--title">Log in with your email account</h2>  
    <form action="">
      <div class="box--input">
        <input type="text" class="form-control" placeholder="somebody@example.com">
      </div>
      <div class="box--input">
        <input type="password" class="form-control" placeholder="Password">
      </div>
      <div class="check--box">
        <input type="checkbox" id="check">
        <label for="check">show password</label>
      </div>
      <div class="box-btn">
        <button class="btn btn-primary btn--login">Login</button>
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
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
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
