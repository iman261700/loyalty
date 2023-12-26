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
    <h3 class="page-title">Report</h3>

  </div>
</div>
</div>



<div class="row">
<div class="col-sm-12">



  <form method="post">
                 <div class="email-header">
                     <div class="row">
                       <div class="col top-action-left">
                         <div class="float-left">



                           <div class="btn-group ">
                             <input type="text" name="search" value="<?=$_POST["search"];?>" placeholder="Customer Name / Email / Code / Distributer" class="form-control search-message" >
                           </div>

                           <div class="btn-group ">
                             <input type="text" name="created_from" value="<?=$_POST["created_from"];?>" placeholder="Date Created (From)" class="form-control search-message form-control datetimepicker">
                           </div>

                           <div class="btn-group  ">
                             <input type="text" name="created_to"  value="<?=$_POST["created_to"];?>" placeholder="Date Created (To)" class="form-control search-message form-control datetimepicker">
                           </div>

                           <div class="btn-group  " style="margin:0px 20px;">
                               <select class="form-control" name="type">
                                 <option value="">All</option>
                                 <option value="COLLECTION" <?php if ($_POST["type"] == "COLLECTION") { ?>selected="selected" <? } ?>>Collection</option>
                                 <option value="REDEMPTION" <?php if ($_POST["type"] == "REDEMPTION") { ?>selected="selected" <? } ?>>Redemption</option>

                               </select>
                           </div>




                           <button name="save" class="btn btn-primary" style="margin-top:-5px;"><i class="fe fe-search"></i> Search</button>
                           <button name="exportReport" class="btn btn-primary" style="margin-top:-5px;"><i class="fe fe-excel"></i> Export (CSV)</button>


                         </div>
                       </div>

                     </div>
                   </div>
     </div>
   </div>

   <hr/>

  <div class="card card-table">
  
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Date Created</th>
              <th>Customer</th>
              <th>Transaction</th>
              <th>Value</th>
              <th>Order ID</th>
              <th>Code</th>
              <th>Code (Distributer)</th>
            </tr>
          </thead>
          <tbody>

            <?php




              if (!empty($_POST["type"])) {
                $filter .= " AND type = '".db::escape($_POST["type"])."' ";
              }

            if (!empty($_POST["created_from"])) {
              $filter .= " AND date_created >= '".db::escape($_POST["created_from"])."' ";
            }

            if (!empty($_POST["created_to"])) {
              $filter .= " AND date_created <= '".db::escape($_POST["created_to"])."' ";
            }


            if (isset($_POST["save"])) {

            $req3 = db::query("SELECT * FROM user_points WHERE id > 0 $filter ORDER BY id DESC"); // ADD TOKEN LATER
            while ($transaction = db::fetch_assoc($req3)) {



              $req = db::query("SELECT * FROM codes WHERE code='".db::escape($transaction["code"])."' LIMIT 1");
              $transaction["code"] = db::fetch_assoc($req);


              $req = db::query("SELECT * FROM users WHERE id='".db::escape($transaction["user_id"])."' LIMIT 1");
                $transaction["customer"] = db::fetch_assoc($req);


              $hide = 0;


              if (!empty($_POST["search"])) {

                $hide = 1;

                  if (stripos(  $transaction["customer"]["first_name"],$_POST["search"]) !== false) {
                    $hide = 0;
                  }

                  if (stripos(  $transaction["customer"]["last_name"],$_POST["search"]) !== false) {
                    $hide = 0;
                  }

                  if (stripos(  $transaction["customer"]["email"],$_POST["search"]) !== false) {
                    $hide = 0;
                  }

                  if (stripos(  $transaction["code"]["code"],$_POST["search"]) !== false) {
                    $hide = 0;
                  }

                  if (stripos($transaction["code"]["distrbuter_code"],$_POST["search"]) !== false) {
                    $hide = 0;
                  }

              }

              if ($hide == 0) {
                $report[] = $transaction;
              }

            }

            foreach ($report as $transaction) {

            ?>
            <tr>
              <td>
                <?=$transaction["id"];?>
              </td>
              <td>                <?=$transaction["date_created"];?>

              </td>

              <td><A href="/backend/customer_details?id=<?=$transaction["customer"]["id"];?>"><?=$transaction["customer"]["first_name"];?> <?=$transaction["customer"]["last_name"];?> (<?=$transaction["customer"]["id"];?>)</a></td>
              <td><?=$transaction["type"];?></td>

    <?php if ($transaction["type"] == "REDEMPTION") { ?>
      <td>
<span style="color:red">  -<?=$transaction["value"];?></span></td>
    <? }else { ?>
      <td>
  <?=$transaction["value"];?></td>
  <? } ?>
  <td>
    <A href="/backend/order?id=<?=$transaction["order_id"];?>"><?=$transaction["order_id"];?></a></td>

  <td><?=$transaction["code"]["code"];?></td>
  <td><?=$transaction["code"]["distrbuter_code"];?></td>



            </tr>
          <? }} ?>
          </tbody>
        </table>



      </div>


          <hr/>



    </div>
           </form>
  </div>

</div>
</div>
</div>
</div>
