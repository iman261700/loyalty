a
<div class="page-wrapper">
    <div class="content container-fluid">

<?php

  $status =
  [
    "0" => "INACTIVE", "1" => "ACTIVE"
  ];

 ?>
<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Customers</h3>
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      <li class="breadcrumb-item active">Manage</li>
    </ul>
  </div>
<form method="post">
  <button name="exportUsers" class="btn btn-primary" style="margin-top:-5px;"><i class="fe fe-excel"></i> Export (CSV)</button>
</form>

</div>
</div>


<?php

function getBalanceByUserId($user_id) {

  $req3 = db::query("SELECT * FROM user_points WHERE user_id='".db::escape($user_id)."' LIMIT 1000");
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


  } ?>


<div class="row">
<div class="col-sm-12">

  <div class="card card-table">
    <div class="card-header">
      <h4 class="card-title" style="float:left;">Customers</h4>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Customer Name</th>
              <th>Email</th>
              <th>Balance</th>
              <th>Redeemed</th>
              <th>OptIn</th>

              <th>Date Created</th>
              <th></td>
            </tr>
          </thead>
          <tbody>

            <?php


            $req2 = db::query("SELECT * FROM users ORDER BY id DESC"); // ADD TOKEN LATER
            while ($customer = db::fetch_assoc($req2)) {

              if ($customer["optin"] == 1) {
                  $opt = "Y";
              }
              else {
                $opt = "N";
              }

            ?>
            <tr>
              <td>
                <?=$customer["id"];?>
              </td>
              <td>                <?=$customer["first_name"];?> <?=$customer["last_name"];?>

              </td>

              <td><?=$customer["email"];?></td>
              <td><?=getBalanceByUserId($customer["id"])["balance"];?></td>
              <td><?=getBalanceByUserId($customer["id"])["redeemed"];?></td>


              <td><?=$opt;?></td>


              <td><?=$customer["date_created"];?></td>

              <td class="text-right">
                <div class="actions">
                  <a href="/backend/customer_details?id=<?=$customer["id"];?>" class="btn btn-sm bg-success-light mr-2">
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
