<div class="column-1">

<div class="point_overview">
<div class="x4">
  <span class="points">
    <?=number_format($balance["balance"],0);?>
  </span>
  Current Available Points<br/>
  <A href="/user/history">History</a>
</div>
<div class="x4">
  <span class="points">
    <?=number_format($balance["redeemed"],0);?>
  </span>
  Recently Redeemed</br> Points
</div>

<div class="x4 mobile-100">
  <span class="points">
    <?=number_format($balance["claimed"],0);?>
  </span>
  Total Collected</br> Points
</div>

<form method="post">
<div class="x4 mobile-100">
  <span class="points">
    <input type="text" placeholder="Enter Code" name="code" style="width:55%; margin-right:5%;"/>
    <input type="text" placeholder="Serial No." name="pin" style="width:35%;"/>

  </span>
  <button  type="Submit" name="doClaim" class="btn">Claim Points</button>
</div>
</form>

<br clear="both"/>
</div>

<style>
  .product {
    border: 1px solid #efefef;
    border-radius: 20px;
    width: 22.5%;
    float: left;
    margin: 10px;
    height:390px;
    position: relative;;

  }

  .product img {
    margin: 20px 0px;;
  }

    .product a {
      background-color: #e10030;
      color: white;
      border: none;
      text-align: center; width: 100%;
      border-bottom-left-radius:10px;
      border-bottom-right-radius:10px;
       line-height: 35px;
      display: inline-block;;
      margin-top: 10px;
      position: absolute;;
      bottom:0px;
      lefT: 0px;
    }
</style>


<?php
  $req = db::query("SELECT * FROM products WHERE status = 1");
  while ($row = db::fetch_assoc($req)) {

    $products[$row["product_category"]][] = $row;

  }

 ?>

 <style>
 .flex-container {
     display: flex;
 }

 .product-info {
   display: none;
 }

 .product-info.active {
   display: block;
 }
 </style>
 <div class="flex-container">

   <Script>

    function productInfoOver(id) {
      if ($('#product-info-'+id).hasClass("active") != true) {
        $('#product-info-'+id).addClass('active');

      }
    }

    function productInfoOut(id) {
      if ($('#product-info-'+id).hasClass("active") == true) {
        $('#product-info-'+id).removeClass('active');

      }
    }

   </script>

<form method="post">
 <?php foreach ($products as $category => $items) { ?>
    <center>
      <h3><?=$category;?></h3>
    </center>

    <?php foreach ($items as $item) {?>

      <div style="position: relative; " class="product" onmouseover="productInfoOver(<?=$item["id"];?>);" onmouseout="productInfoOut(<?=$item["id"];?>);">

          <div  class="product-info " id="product-info-<?=$item["id"];?>" style="text-align: left; position: absolute; top:0px; left:0px;  width: 100%; border:1px solid white; background-color: rgba(255,255,255,0.8); padding:10px;"><?=$item["product_info"];?></div>

        <center>
        <img src="/<?=$item["product_image"];?>" width="130"/ >
        <div style="font-size:15px; margin: 5px 0px; font-weight:bold;"><?=$item["product_name"];?></div>
        <div style="font-size:12px;"><i><?=$item["required_points"];?> Points</i></div>

      </center>



        <a data-no-instant href="/user/cart?add=<?=$item["id"];?>" name="redeem"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
      </div>


    <? } ?>
<br/>
    <br clear="both"/><br/>

 <? } ?>
</div>

</div>
</form>
