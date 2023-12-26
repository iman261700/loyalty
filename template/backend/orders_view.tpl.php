
<?php

$req = db::query("SELECT * FROM user_order WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
$order = db::fetch_assoc($req);


  if (isset($_POST["save"]) ) {
    db::query("UPDATE user_order SET status = '".db::escape($_POST["status"])."' WHERE id='".db::escape($_GET["id"])."' LIMIT 1");

    ?>
      <script>alert('Order Status saved.');</script>
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



  $req = db::query("SELECT * FROM users WHERE id='".db::escape($order["user_id"])."' LIMIT 1");
  $user = db::fetch_assoc($req);

  $req = db::query("SELECT * FROM user_shipping WHERE user_id='".db::escape($order["user_id"])."' ORDER BY id DESC LIMIT 1");
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
    <h3 class="page-title">Order / #<?=$order["id"];;?>  / <?=$user["first_name"];?> <?=$user["last_name"];?></h3>

  </div>
</div>
</div>





<div class="row">
  <div class="col-xl-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Order Information</h4>
      </div>
      <div class="card-body">
        <form action="" method="post">



          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Order ID#</label>
            <div class="col-lg-9">
              <?=$order["id"];?>
            </div>
          </div>



          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Created</label>
            <div class="col-lg-9">
              <?=$order["date_created"];?>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status</label>
            <div class="col-lg-9">
              <select class="form-control" name="status">
                <option value="0" <?php if ($order["status"] == "0") {?>selected="selected" <? } ?>>Pending</option>
                <option value="1" <?php if ($order["status"] == "1") {?>selected="selected" <? } ?>>Prepared</option>
                <option value="2" <?php if ($order["status"] == "2") {?>selected="selected" <? } ?>>Shipped</option>
                <option value="10" <?php if ($order["status"] == "10") {?>selected="selected" <? } ?>>Cancelled</option>


              </select>            </div>
          </div>

          <div class="text-right">
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>



    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Customer Information</h4>
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
            <label class="col-lg-3 col-form-label">Email Address</label>
            <div class="col-lg-9">
              <input type="email" class="form-control" name="email" value="<?=$user["email"];?>" disabled>
            </div>
          </div>
        </form>
      </div>
    </div>



<?php

$order_products = json_decode($order["products"],true);

 ?>
  <div class="col-xl-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title">Claimed Products</h4>
      </div>
      <div class="card-body">

        <table class="table">

          <Tr>
              <th>Amount</th>
              <th>Product</th>
          </tr>

          <?php //foreach ($order_products as $item_id => $qty) {

            $req2 = db::query("SELECT * FROM products");
          while ( $item = db::fetch_assoc($req2)) { ?>


          <Tr>
              <td>
                <select class="form-control" name="<?=$item["id"];?>_qty">
                  <?php for ($i = 0; $i < 10; $i++) { ?>
                  <option value="<?=$i;?>" <?php if ($i == $order_products[$item["id"]]) { ?>selected="selected" <? } ?>><?=$i;?></option>
                <? } ?>
                </select>

              </td>
              <Td>
                <?=$item["product_name"];?>


              </td>
          </tr>
          <? } ?>


        </table>

        <div class="text">
          <button type="submit" name="saveOrder" class="btn btn-primary" onclick="return confirm('Are you sure?');">Update Order</button>
        </div>

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
        <div class="text">
          <button type="submit" name="saveShipping" class="btn btn-primary">Save</button>
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
</div>
</div>
</div>
