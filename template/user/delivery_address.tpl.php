<div class="column-2">
  <img src="/images/signup-image.png"/>
</div>

<form method="post">

<?php

$req = db::query("SELECT * FROM user_shipping WHERE user_id='".db::escape($_SESSION["user"]["id"])."' ORDER BY id DESC");
$item = db::fetch_assoc($req);

?>

      <div class="column-2">

        <br/><br/>
        <center>
        <h2>
          Update Profile
        </h2>
        </center>
        <br/>
        <div class="col-8x">
          <label>First Name</label>
          <input type="text" name="first_name" required value="<?=$item["first_name"];?>"/>
        </div>

        <div class="col-4x">
          <label>Last Name</label>
          <input type="text" name="last_name" required value="<?=$item["last_name"];?>"/>
        </div>

        <br clear="both"/><br/><br/>

        <div class="col-12x">
          <label>Phone</label>
          <input type="text" name="phone" required value="<?=$item["phone"];?>" placeholder="+601234567"/>
        </div>

        <br clear="both"/><br/><br/>


        <div class="col-8x">
          <label>Address Line 1</label>
          <input type="text" name="address_line_1" required value="<?=$item["address_line_1"];?>"/>
        </div>

        <div class="col-4x">
          <label>Address Line 2</label>
          <input type="text" name="address_line_2" value="<?=$item["address_line_2"];?>"/>
        </div>

        <br clear="both"/><br/><br/>

        <div class="col-6x">
          <label>Postcode</label>
          <input  name="postcode" type="text" value="<?=$item["postcode"];?>"/>
        </div>

        <div class="col-6x">
          <label>City</label>
          <input  name="city" type="text" value="<?=$item["city"];?>"/>
        </div>

        <br clear="both"/>

        <br/>
        <center>
          <button class="btn" name="doUpdateDeliveryAddress" type="Submit" style="margin:10px 0px;">Save</button>

          <A class="btn" style="margin-left:0px; border: 1px solid #e10030; color: #e10030; background-color: white;" href="/user/update_password">Change Password</a>

        </center>


      </div>
      <br clear="both"/>



    </div>

</form>
