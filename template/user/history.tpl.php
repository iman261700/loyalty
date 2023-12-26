<table class="table">
  <tr>
    <th>No.</th>
    <th>Date</th>
    <th>Purchased Items</th>
    <th>Redemption Items</th>
    <th style="text-align:right;">Points</th>
  </tr>

  <?php

    $req2 = db::query("SELECT * FROM `user_points` WHERE `user_id` = '".$_SESSION["user"]["id"]."'");
    while ($history = db::fetch_assoc($req2)) {

      if ($history["type"] == "COLLECTION") {

        $req3 = db::query("SELECT * FROM `codes` WHERE `code` = '".$history["code"]."' LIMIT 1");
        $item = db::fetch_assoc($req3);

        $history["collected"] = $item["product"];


      }


      if ($history["type"] == "REDEMPTION") {

        $req3 = db::query("SELECT * FROM `user_order` WHERE `id` = '".$history["order_id"]."' LIMIT 1");
        $item = db::fetch_assoc($req3);

        foreach (json_decode($item["products"],true) as $item => $qty) {

          $req3 = db::query("SELECT * FROM `products` WHERE `id` = '".$item."' LIMIT 1");
          $item = db::fetch_assoc($req3);

          $history["ordered"] = $item["product_name"];


        }


        $history["collected"] = $item["product"];


      }



      $i++;
      $history["no"] = $i;
      $h[] = $history;





    }

    ($h);

   ?>

   <?php foreach ($h as $row) { ?>
   <tr>
     <td><?=$row["no"];?></td>
     <td><?=$row["date_created"];?></td>

     <?php if ($row["type"] == "COLLECTION") { ?>
       <td><?=$row["collected"];?></td>
       <td>-</td>

       <td style="font-weight:bold; text-align:right;">+<?=$row["value"];?> points</td>

     <? } else { ?>
       <td>-</td>
       <td><?=$row["ordered"];?></td>

       <td style="font-weight:bold; text-align:right;">-<?=$row["value"];?> points</td>

     <? } ?>

   </tr>
 <? } ?>

</table>

<style>
  th {
    text-align:left;
    font-weight: bold;
  }

  td {
    text-align: left;
  }
</style>
