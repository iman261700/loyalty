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
    <h3 class="page-title">QR Codes</h3>

  </div>
</div>
</div>

<?php


  if (isset($_POST["resetAll"])) {

    $sql = db::query("DELETE FROM codes");

  }

 ?>


<div class="row">
<div class="col-sm-12">




  <form method="post">
    <!-- <button name="resetAll" class="btn btn-primary" style="margin-top:-5px; float:right;" onclick="return confirm('Are you sure?');"><i class="fe fe-trash"></i> DELETE ALL CODES</button> -->

                 <div class="email-header">
                     <div class="row">
                       <div class="col top-action-left">
                         <div class="float-left">



                           <div class="btn-group ">
                             <input type="text" name="search" value="<?=$_POST["search"];?>" placeholder="Code / Distributer" class="form-control search-message" >
                           </div>

                           <div class="btn-group ">
                             <input type="text" name="created_from" value="<?=$_POST["created_from"];?>" placeholder="Date Imported (From)" class="form-control search-message form-control datetimepicker">
                           </div>

                           <div class="btn-group  ">
                             <input type="text" name="created_to"  value="<?=$_POST["created_to"];?>" placeholder="Date Imported (To)" class="form-control search-message form-control datetimepicker">
                           </div>



                           <div class="btn-group  " style="margin:0px 20px;">
                               <select class="form-control" name="status">
                                 <option value="">All</option>
                                 <option value="Used">Used</option>
                                 <option value="Not">Not Used</option>

                               </select>
                           </div>


                           <button name="save" class="btn btn-primary" style="margin-top:-5px;"><i class="fe fe-search"></i> Search</button>

                           <a href="/backend/codes_import" class="btn btn-primary" >Import Codes</a>





                         </div>
                       </div>

                     </div>
                   </div>
     </div>
   </div>

   <hr/>

  <div class="card card-table">
    <div class="card-header">
      <h4 class="card-title" style="float:left;">Codes</h4>
      <script>
        function showPin(id) {
          $(".hide-pin-"+id).fadeOut(function() {
            $(".pin-"+id).fadeIn();
          });

        }
      </script>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Serial Number</th>

              <th>Points</th>
              <th>Product</th>

              <th>Distributor Code</th>
              <th>Date Used</th>
              <th>Date Created</th>

            </tr>
          </thead>
          <tbody>

            <?php

            if (!empty($_POST["search"])) {
              $filter .= " AND (distributor_code LIKE '%".db::escape($_POST["search"])."%' OR code LIKE '%".db::escape($_POST["search"])."%') ";
            }

            if ($_POST["status"] == "Used") {
              $filter .= " AND date_used > 0 ";
            }

            if ($_POST["status"] == "Not") {
              $filter .= " AND date_used  = 0 ";
            }


            if (!empty($_POST["created_from"])) {
              $filter .= " AND date_created >= '".db::escape($_POST["created_from"])."' ";
            }

            if (!empty($_POST["created_to"])) {
              $filter .= " AND date_created <= '".db::escape($_POST["created_to"])."' ";
            }


            $req = db::query("SELECT * FROM codes WHERE id > 0 $filter ORDER BY id DESC LIMIT 0,100"); // ADD TOKEN LATER
            while ($code = db::fetch_assoc($req)) {

            ?>
            <tr>
              <td>
                <?=$code["id"];?>
              </td>
              <td>                <?=$code["code"];?>

              </td>
  <td width="100">
    <?=$code["pin"];?>
              <!-- <a href="javascript:showPin(<?=$code["id"];?>);" class="hide-pin-<?=$code["id"];?>" style="color: #940006;">
                  ******
              </a>

              <div class="pin-<?=$code["id"];?>" style="display:none;">                    <?=$code["pin"];?> </div> -->
  </td>

              <td><?=$code["value"];?></td>
              <td><?=$code["product"];?></td>

              <td><?=$code["distributor_code"];?></td>



              <td><?php
              if ($code["date_used"] > 0) {?>
                  <?=date("d/m/Y H:i",$code["date_used"]);?>
              <? } else { ?> - <? } ?>
              <td><?=$code["date_created"];?></td>


            </tr>
          <? } ?>
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
