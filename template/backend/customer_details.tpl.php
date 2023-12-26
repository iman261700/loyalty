
<?php

$req = db::query("SELECT * FROM users WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
$user = db::fetch_assoc($req);

  if (isset($_POST["saveAdjustment"])) {

    db::query("INSERT INTO user_points (user_id, code, value, type, remark) VALUES (
                '".db::escape($user["id"])."',
                '".db::escape($_POST["code"])."',
                '".db::escape($_POST["value"])."',
                '".db::escape($_POST["type"])."',
                '".db::escape($_POST["remark"])."')");


                db::query("UPDATE codes SET used = '".time()."' WHERE code='".db::escape($_POST["code"])."' LIMIT 1");

                    ?>
                      <script>alert('Point Adjustment Added.');</script>
                    <?
  }


  if (isset($_POST["save"]) ) {
    db::query("UPDATE users SET first_name = '".db::escape($_POST["first_name"])."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE users SET last_name = '".db::escape($_POST["last_name"])."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE users SET phone = '".db::escape($_POST["phone"])."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE users SET status = '".db::escape($_POST["status"])."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE users SET role = '".db::escape($_POST["role"])."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");

    ?>
      <script>alert('User saved.');</script>
    <?

  }

  if (isset($_POST["saveShipping"]) ) {
    db::query("UPDATE user_shipping SET first_name = '".db::escape($_POST["first_name"])."' WHERE user_id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE user_shipping SET last_name = '".db::escape($_POST["last_name"])."' WHERE user_id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE user_shipping SET address_line_1 = '".db::escape($_POST["address_line_1"])."' WHERE user_id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE user_shipping SET address_line_2 = '".db::escape($_POST["address_line_2"])."' WHERE user_id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE user_shipping SET postcode = '".db::escape($_POST["postcode"])."' WHERE user_id='".db::escape($_GET["id"])."' LIMIT 1");
    db::query("UPDATE user_shipping SET city = '".db::escape($_POST["city"])."' WHERE user_id='".db::escape($_GET["id"])."' LIMIT 1");

    ?>
      <script>alert('New Shipping Address saved.');</script>
    <?
  }


    if (isset($_POST["savePassword"]) ) {

      if (strlen($_POST["password"]) < 4) {
        $err = "Password is too short";
      }

      if ($_POST["password"] != $_POST["password2"]) {
        $err = "Password doesnt match.";
      }

      if ($err == "") {
        db::query("UPDATE users SET password = '".db::escape(md5($_POST["password"]))."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");

      }
      else {
        ?>
          <script>alert('<?=$err;?>');</script>
        <?
      }


    }


  $req = db::query("SELECT * FROM users WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
  $user = db::fetch_assoc($req);

  $req = db::query("SELECT * FROM user_shipping WHERE user_id='".db::escape($_GET["id"])."' ORDER BY id DESC LIMIT 1");
  $shipping = db::fetch_assoc($req);



  function getBalanceByUserId($user_id) {

    $req3 = db::query("SELECT * FROM user_points WHERE user_id='".$user_id."' LIMIT 1000");
    while ($row = db::fetch_assoc($req3)) {

      if ($row["type"] == "COLLECTION") {
        $balance = $balance + $row["value"];
        $claimed = $claimed + $row["value"];
      }
      else {
        $balance = $balance - $row["value"];
        $redeemed = $redeemed + $row["value"];
      }

    }


      return [
        "balance" => number_format($balance,0),
        "claimed" => number_format($claimed,0),
        "redeemed" => number_format($redeemed,0)
      ];


    }

    $points = getBalanceByUserId($user["id"]);



 ?>


<div class="page-wrapper">
    <div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Customer / <?=$user["first_name"];?> <?=$user["last_name"];?></h3>
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">ID: <?=$user["id"];?></a></li>
    </ul>
  </div>
</div>
</div>



<div class="row">
  <div class="col-xl-4 d-flex">
    <div class="card flex-fill">

      <div class="card-body">
        <form action="" method="post">

          <div class="form-group row">
            <label class="col-lg-12 col-form-label">Balance</label>
            <div class="col-lg-9">
              <span style="font-size:25px; font-weight:bold;"><?=$points["balance"];?></span>
            </div>
          </div>

        </form>
    </div>
  </div>

</div>

    <div class="col-xl-4 d-flex">
      <div class="card flex-fill">

        <div class="card-body">
          <form action="" method="post">

            <div class="form-group row">
              <label class="col-lg-12 col-form-label">Claimed</label>
              <div class="col-lg-9">
                <span style="font-size:25px; font-weight:bold;"><?=$points["claimed"];?></span>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>


      <div class="col-xl-4 d-flex">
        <div class="card flex-fill">

          <div class="card-body">
            <form action="" method="post">

              <div class="form-group row">
                <label class="col-lg-12 col-form-label">Redeemed</label>
                <div class="col-lg-9">
                  <span style="font-size:25px; font-weight:bold;"><?=$points["redeemed"];?></span>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


<div class="row">
  <div class="col-xl-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">User Information</h4>
      </div>
      <div class="card-body">
        <form action="" method="post">

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">First Name</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="first_name" value="<?=$user["first_name"];?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Last Name</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="last_name" value="<?=$user["last_name"];?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Phone</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="phone" value="<?=$user["phone"];?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Pet</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="phone" value="<?=$user["pet"];?>">
            </div>
          </div>



          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Email Address</label>
            <div class="col-lg-9">
              <input type="email" class="form-control" name="email" value="<?=$user["email"];?>" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Role</label>
            <div class="col-lg-9">
              <select class="form-control" name="role">

                <option value="client" <?php if ($user["role"] == "client") {?>selected="selected" <? } ?>>Customer</option>

                <option value="ADMIN" <?php if ($user["role"] == "ADMIN") {?>selected="selected" <? } ?>>ADMIN</option>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status</label>
            <div class="col-lg-9">
              <select class="form-control" name="status">
                <option value="ENABLED" <?php if ($user["status"] == "ENABLED") {?>selected="selected" <? } ?>>Enabled</option>
                <option value="DISABLED" <?php if ($user["status"] == "DISABLED") {?>selected="selected" <? } ?>>Disabled</option>
              </select>            </div>
          </div>

          <div class="text-right">
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<div class="col-xl-6" style="float:right;">

    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Change Password</h4>
      </div>
      <div class="card-body">
        <form action="#" method="post">
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">New Password</label>
            <div class="col-lg-9">
              <input type="password" class="form-control" name="password">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Retype new Password</label>
            <div class="col-lg-9">
              <input type="password" class="form-control" name="password2">
            </div>
          </div>

          <div class="text-right">
            <button type="submit" name="savePassword" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
  </div>
</div>



<div class="col-xl-12 d-flex">
  <div class="card flex-fill">
    <div class="card-header">
      <h4 class="card-title">Shipping Address</h4>
    </div>
    <div class="card-body">
      <form action="#" method="post">
        <div class="form-group row">
          <label class="col-lg-3 col-form-label">First Name</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="first_name" value="<?=$shipping["first_name"];?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-lg-3 col-form-label">Last Name</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="last_name" value="<?=$shipping["last_name"];?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-lg-3 col-form-label">Address Line 1</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="address_line_1" value="<?=$shipping["address_line_1"];?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-lg-3 col-form-label">Address Line 2</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="address_line_2" value="<?=$shipping["address_line_2"];?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-lg-3 col-form-label">Postcode</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="postcode" value="<?=$shipping["postcode"];?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-lg-3 col-form-label">City</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="city" value="<?=$shipping["city"];?>">
          </div>
        </div>
        <div class="text-right">
          <button type="submit" name="saveShipping" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<div class="row">
  <div class="col-xl-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Point Collection</h4>
      </div>
      <div class="card-body">
  <div class="table-responsive">
    <table class="table table-hover table-center mb-0 datatable">
      <thead>
        <tr>
          <th>Date</th>
          <th>Code ID</th>
          <th>Points</th>


        </tr>
      </thead>
      <tbody>

        <?php
        $req4 = db::query("SELECT * FROM user_points WHERE user_id = '".$user["id"]."' AND type='COLLECTION'"); // ADD TOKEN LATER
        while ($point = db::fetch_assoc($req4)) {

        ?>
        <tr>
          <td>
            <?=$point["date_created"];?>
          </td>
          <td>#<?=$point["code"];?></td>
          <td><?=$point["value"];?></td>
        </tr>
      <? } ?>
      </tbody>
    </table>
  </div>
</div>
</div></div>
</div>


<div class="row">
  <div class="col-xl-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Redemptions </h4>
      </div>
      <div class="card-body">
  <div class="table-responsive">
    <table class="table table-hover table-center mb-0 datatable">
      <thead>
        <tr>
          <th>Date Created</th>
          <th>Order ID</th>
          <th>Order</th>

          <th>Used Points</th>


        </tr>
      </thead>
      <tbody>

        <?php
        $req233 = db::query("SELECT * FROM user_points WHERE user_id = '".$user["id"]."'  AND type='REDEMPTION' "); // ADD TOKEN LATER
        while ($point = db::fetch_assoc($req233)) {

          $req23 = db::query("SELECT * FROM user_order WHERE id='".$point["order_id"]."' LIMIT 1");
          $order = db::fetch_assoc($req23);

          $order_products = json_decode($order["products"]);


        ?>
        <tr>
          <td>
            <?=$point["date_created"];?>
          </td>
          <td>#<?=$point["order_id"];?></td>

          <td>
            <?php foreach ($order_products as $item_id => $qty) {

              $req = db::query("SELECT * FROM products WHERE id='".db::escape($item_id)."' AND status = 1");
              $item = db::fetch_assoc($req);
              ?>
                <?=$qty;?>x <?=$item["product_name"];?><br/>
            <? } ?>

          </td>
          <td><?=$point["value"];?></td>

        </tr>
      <? } ?>
      </tbody>
    </table>
  </div>
</div>  </div>



<div class="col-xl-12" style="float:right;">

    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Point Adjustment</h4>
      </div>
      <div class="card-body">
        <form action="#" method="post">
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Type  (Required)</label>
            <div class="col-lg-9">
              <select class="form-control" name="type">
                <option value="COLLECTION" <?php if ($_POST["type"] == "COLLECTION") { ?>selected="selected" <? } ?>>Collection</option>
                <option value="REDEMPTION" <?php if ($_POST["type"] == "REDEMPTION") { ?>selected="selected" <? } ?>>Redemption</option>

              </select>            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Code (Required)</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="code">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Value  (Required)</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="value">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Remark (Why Adjustment needed)</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="remark" value="">
            </div>
          </div>

          <div class="text-right">
            <button type="submit" name="saveAdjustment" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
  </div>
</div>


</div>
</div>
</div>

</div>
</div>
</div>
</div>
