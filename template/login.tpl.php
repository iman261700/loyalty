<div class="column-2">
  <img src="/new_image.png" style="max-width:100%;" class="mobile-only"/>&nbsp;
</div>

<style>
  .content {
    background: url(/background.jpeg) #fff  no-repeat;
    background-position: bottom;
    background-size: contain;
  }

  .mobile-only {
    display: none;
  }

  @media only screen and (max-width: 1000px) {

    .mobile-only {
      display: block !important;
      width: 90% !important;
      margin-bottom:-20px !important;
    }


    .content {
      background: none;
      background-color: #fff;
    }



  }

</style>

<form method="post">
<div class="column-2">
  <br/><br/>
  <center>
  <h2>
    Member Login
  </h2>
  <br/>
  <div class="col-8x centered" >
    <input type="email" name="email" required value="" placeholder="Email Address" class="email_input" value="<?=$_COOKIE["email"];?>"/>
  </div>
  <br clear="both"/>
  <div class="col-8x centered">
    <input type="password" name="password" required value="" placeholder="Password" class="password_input"/>
  </div>


  <br/>

  <div class="col-8x centered" >


  <center>

    <div class="col-6x" style="font-size:11px;">

      <label class="container-checkbox">Remember me
        <input type="checkbox" checked="checked" name="Remember me" name="remember_me">
        <span class="checkmark"></span>
      </label>

    </div>

    <div class="col-6x" style="font-size:11px;">
      <A href="/password">Forgot password?</a>
    </div>

    <button class="btn" name="doLogin" type="Submit" style="margin:10px 0px;">Sign In</button>

    <hr/>
    <div style="margin-top:-25px; font-weight: bold; background-color: white; padding:0px 10px; width: 35px; display: block;"><i>or</i></div>

    <br/>

    <center>
    <a href="<?=file_get_contents("https://loyalty.ritmapres.com/facebook.php");?>"><img src="/images/fb_connect.png" style="max-width:35px;"/></a>
    <!-- <img src="/images/google_connect.png" style="max-width:35px; margin-left:20px;" onclick="alert('Please enter Google ID into the Backend.');" style="margin-left:20px;"/> -->
  </center>
  <br clear="both"/>

  <br/>

  Not a member?<br/>
    <a class="btn" href="/signup" style="margin:10px 0px;">Create Account</a>
  </center>

</div>
<br clear="both"/>


</center>

<br clear="both"/>

</div>
</form>
<br clear="both"/></div>
<br/>
