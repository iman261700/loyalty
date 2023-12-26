<div class="page-wrapper">
    <div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Products</h3>
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      <li class="breadcrumb-item active">Products</li>
    </ul>
  </div>
</div>
</div>



<form method="post">

<?php


if (isset($_POST["deleteProduct"])) {
  db::query("UPDATE products SET status = 99 WHERE id='".db::escape($_POST["deleteProduct"])."' LIMIT 1");

}

 ?>

<div class="row">
<div class="col-sm-12">

  <div class="card card-table">
    <div class="card-header">
      <h4 class="card-title" style="float:left;">Products</h4>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-center mb-0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Image</th>
              <th>SKU</th>
              <th>Category</th>
              <th>Required Points</th>

              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $req = db::query("SELECT * FROM products WHERE status != 99  ORDER BY product_category ASC");
              while ($row = db::fetch_assoc($req)) {
            ?>
            <tr>
              <td>
                <h2 class="table-avatar">
                  <a href="/backend/product_edit?id=<?=$row["id"];?>"> <?=$row["product_name"];?></a>
                </h2>
              </td>
              <td><img src="/<?=$row["product_image"];?>" style="width:100px;"></td>
              <td><?=$row["product_sku"];?></td>
              <td><?=$row["product_category"];?></td>
              <td><?=$row["required_points"];?></td>

              <td class="text-right">
                <div class="actions">
                  <a href="/backend/product_edit?id=<?=$row["id"];?>" class="btn btn-sm bg-success-light mr-2">
                    <i class="fe fe-pencil"></i> Edit
                  </a>

                  <button name="deleteProduct" value="<?=$row["id"];?>" onclick="return confirm('Are you sure?');" class="btn btn-sm bg-danger-light mr-2">
                    <i class="fe fe-pencil"></i> Remove
                  </button>


                </div>
              </td>
            </tr>
          <? } ?>


          </tbody>
        </table>

        <hr/>
        <a href="/backend/product_add?id=<?=$row["id"];?>" class="btn btn-primary" style="margin:10px;">
          Add Product
        </a>


      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
