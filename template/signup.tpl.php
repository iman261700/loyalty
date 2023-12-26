<div class="column-2">
  <img src="/new_image.png" style="max-width:100%;" class="mobile-only"/>&nbsp;
</div>

<style>
  .content {
    background: url(/background.jpeg) #fff  no-repeat;
    background-position: bottom;
    background-size: contain;
    min-height: 890px;
  }

  .mobile-only {
    display: none;
  }


  select {
    appearance: none !important;
    background-color: #f5f5f5 ;padding: 15px 8px;
    border: none;
    height: 40px;
    width: 100%;
    float: left;
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


      <div class="column-2" >

        <br/><br/>
        <center>
        <h2>
          Member Sign up
        </h2>
        </center>
        <br/>
        <div class="col-8x">
          <label>First Name</label>
          <input type="text" name="first_name" required value="<?=explode(' ', $_SESSION['fb_name'])[0]; ?>"/>
        </div>

        <div class="col-4x">
          <label>Last Name</label>
          <input type="text" name="last_name" required value="<?=explode(' ', $_SESSION['fb_name'])[1]; ?>"/>
        </div>

        <br clear="both"/><br/>

        <div class="col-8x">
          <label>Email Address</label>
          <input type="email" name="email" required value="<?=$_SESSION['fb_email']; ?>" placeholder="" />
        </div>

        <div class="col-4x">
          <label>Mobile No.</label>
          <input type="text" name="phone" value="<?=$_SESSION['fb_phone']; ?>" placeholder="+60" required/>
        </div>

        <br clear="both"/><br/>

        <div class="col-6x">
          <label>Password</label>
          <input  name="password" type="password" value="" required/>
        </div>

        <div class="col-6x">
          <label>Confirm Password</label>
          <input  name="password2" type="password" value="" required/>
        </div>

        <br clear="both"/>

        <div class="col-6x">
          <label>I am a owner of</label>


          <select name="pet" required>
            <option value="">- Please select -</option>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="both">Both</option>

          </select>

        </div>

  <br clear="both"/><br/>

      <div class="col-12x">
          <label>Address</label>
          <input type="text" name="address" required value="" placeholder="" />
        </div>
  <br clear="both"/><br/>
<div class="col-4x">
          <label>Zip Code</label>
          <input type="text" name="zip" required value=""/>
        </div>

        <div class="col-8x">
          <label>City</label>
          <input type="text" name="city" required value=""/>
        </div>


  <br clear="both"/>
        <br/>
        <center>
          <a href="/login">Already a member?</a><br/>
          <button class="btn" name="doRegister" type="Submit" style="margin:10px 0px;">Sign Up</button>
        </center>


      </div>
      <br clear="both"/>



    </div>

</form>
