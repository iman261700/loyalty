<center>
  <h3>Redemption successful!</h3>

<p style="font-size:16px; line-height:30px;">
  <b>ORDERID #<?=$order_id;?></b><br/><?=date("d/m/Y H:i");?> <br/><br/>Thank you for your redemption. You will receive a notification once your order is shipped!
</p>

</center>



<center>
  <h2>Order Summary</h2>
</center>

<form method="post">


<table class="cart table" >


    <?php foreach ($_SESSION["cart"] as $item_id => $qty) {

        $req = db::query("SELECT * FROM products WHERE id='".db::escape($item_id)."' AND status = 1");
        $item = db::fetch_assoc($req);

        $total = $total + ($item["required_points"] * $qty);

      ?>
      <tr class="cart-product">
        <td width="50" style="width:50px; vertical-align: middle !important;" valign="middle">

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
      <b>J&T Express</b>
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
      </td>
    </tr>

    <tr class="total" style="height:100px;">
      <td></td>
      <td></td>
      <td style="text-align: right;  vertical-align: middle !important;" valign="middle">
        <b>Total redeemed points</b>
      </td>
      <td style="color: black;  vertical-align: middle !important;">
        <b><?=number_format($total,0);?> points</b>
      </td>
    </tr>


</table>


<?
unset($_SESSION["cart"]);
 ?>
</form>
