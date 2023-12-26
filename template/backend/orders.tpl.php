
<div class="page-wrapper">
    <div class="content container-fluid">

<?php

  $status =
  [
    "0" => "PENDING", "2" => "PACKED", "3" => "SHIPPED"
  ];

 ?>
<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Orders</h3>
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      <li class="breadcrumb-item active">Orders</li>
    </ul>
  </div>
</div>
</div>


<?php

function getBalanceByUserId($user_id) {

  $req = db::query("SELECT * FROM user_points WHERE user_id='".$user_id."' LIMIT 1000");
  while ($row = db::fetch_assoc($req)) {

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
      "balance" => $balance,
      "claimed" => $claimed,
      "redeemed" => $redeemed
    ];


  } ?>


<div class="row">
<div class="col-sm-12">

  <div class="card card-table">
    <div class="card-header">
      <h4 class="card-title" style="float:left;">Orders</h4>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-center mb-0">
          <thead>
            <tr>
              <th>Order #</th>
              <th>Status</th>
              <th>Products</th>

              <th>Customer Name</th>
              <th>Email</th>
              <th>Points Redeemed</th>
              <th>Date Created</th>
              <th></td>
            </tr>
          </thead>
          <tbody>

            <?php


            $req4 = db::query("SELECT * FROM user_order ORDER BY id DESC"); // ADD TOKEN LATER
            while ($order = db::fetch_assoc($req4)) {

              $req23 = db::query("SELECT * FROM users WHERE id='".$order["user_id"]."' LIMIT 1");
              $customer = db::fetch_assoc($req23);

              $order_products = json_decode($order["products"]);

            ?>
            <tr>
              <td>
                <?=$order["id"];?>
              </td>
              <td>
                <?=$status[$order["status"]];?>
              </td>
              <Td>
<?php foreach ($order_products as $item_id => $qty) {

  $req = db::query("SELECT * FROM products WHERE id='".db::escape($item_id)."' AND status = 1");
  $item = db::fetch_assoc($req);
  ?>
    <?=$qty;?>x <?=$item["product_name"];?><br/>
<? } ?>
              </td>
              <td>                <?=$customer["first_name"];?> <?=$customer["last_name"];?>

              </td>

              <td><?=$customer["email"];?></td>
              <td>
                <?=$order["points"];?>
              </td>


              <td><?=$customer["date_created"];?></td>

              <td class="text-right">
                <div class="actions">
                  <a href="/backend/orders_view?id=<?=$order["id"];?>" class="btn btn-sm bg-success-light mr-2">
                    <i class="fe fe-pencil"></i> Edit
                  </a>


                </div>
              </td>
            </tr>
          <? } ?>
          </tbody>
        </table>




      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
