<center>
  <h3>Checkout</h3>
</center>

<form method="post">


<?php if (count($_SESSION["cart"]) > 0) { ?>
<table class="cart table" style="text-align: left;" >


    <?php foreach ($_SESSION["cart"] as $item_id => $qty) {

        $req = db::query("SELECT * FROM products WHERE id='".db::escape($item_id)."' AND status = 1");
        $item = db::fetch_assoc($req);

        $total = $total + ($item["required_points"] * $qty);

      ?>
      <tr class="cart-product">
        <td width="50" style="width:50px; vertical-align: middle !important;" valign="middle">
                <!-- <label class="container-checkbox" style="width:50px;">
                  <input type="checkbox" checked="checked"  name="cart_<?=$item_id;?>" value="<?=$qty;?>">
                  <span class="checkmark"></span>
                </label> -->

                <input type="hidden" name="cart_<?=$item_id;?>" value="<?=$qty;?>">

                  <button class="btn" name="delete_product" value="<?=$item_id;?>" style="width:auto; padding:5px 10px;  text-align:center;"><i class="fa fa-trash" style="margin:0;"></i></button>
        </td>
          <td>
            <img src="/<?=$item["product_image"];?>" width="80"/>
          </td>
          <td valign="middle" style="vertical-align: middle !important;">
            <?=$qty;?>x <b><?=$item["product_name"];?></b>
          </td>
          <td valign="middle" style="vertical-align: middle !important;" width="150">
            <b><?=number_format($item["required_points"] * $qty,0);?> points</b>
          </td>
      </tr>
  <? } ?>

  <tr class="cart-shipping" style="background-color: #e10030; color: white !important; line-height:35px; font-weight:bold;">
    <td>
    </td>
    <td>
      <b>SHIPPING FEE</b><br/>
    </td>
    <td></td>
    <td>
      FREE
    </td>
  </tr>


    <tr class="delivery-address">
      <td style="text-align:right;">

        <i class="fa fa-map-marker" style="color:#e10030; font-size:28px;" aria-hidden="true"></i>

      </td>
      <td style="line-height:30px;">
        <span style="font-size:16px; color:black; font-weight:bold;">Delivery Address</span>
        <p>
          <?=$_SESSION["user"]["phone"];?>
          <br/>
          <?=$delivery_address["address_line_1"];?>,<br/>
          <?=$delivery_address["address_line_2"];?>,<br/>
          <?=$delivery_address["postcode"];?>
          <?=$delivery_address["city"];?>
        </p>
      </td>
      <td></td>
      <td>
        <A href="/user/delivery_address">Update</a>
      </td>
    </tr>

    <tr class="total" style="height:100px;">
      <td></td>
      <td></td>
      <td style="text-align: right;  vertical-align: middle !important;" valign="middle">
        <b>Total</b>
      </td>
      <td style="color: black;  vertical-align: middle !important;">
        <b><?=number_format($total,0);?> points</b>
      </td>
    </tr>


</table>

<center>

  <button class="btn2" name="doCartUpdate" type="Submit" style="margin:10px 0px;">Update</button>

  <button class="btn" name="doPlaceOrder" type="Submit" style="margin:10px 0px;">Place Order</button>


</center>

<? } else { ?>

  <p><center>
    - No Products in Cart
  </center></p>

<? } ?>
</form>
