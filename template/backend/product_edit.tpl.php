
<?php



  if (isset($_POST["save"])) {



          if (!empty($_FILES["product_image"]["tmp_name"])) {

            $ext = end(explode(".",$_FILES["product_image"]["name"]));

            if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

              $new_filename = "uploads/".md5(time()).".jpg";

              copy($_FILES["product_image"]["tmp_name"],$new_filename);

              db::query("UPDATE products SET
                product_image = '".db::escape($new_filename)."'
                WHERE id='".db::escape($_GET["id"])."'  LIMIT 1");

            }

          }



    db::query("UPDATE products SET

        product_name = '".db::escape($_POST["product_name"])."',
        product_category = '".db::escape($_POST["product_category"])."',
        product_sku = '".db::escape($_POST["product_sku"])."',
        required_points = '".db::escape($_POST["required_points"])."',
        status = '".db::escape($_POST["status"])."',
        product_info = '".db::escape($_POST["product_info"])."'


        WHERE id='".db::escape($_GET["id"])."' LIMIT 1");

        ?>
        <script>alert('Product saved.');</script>
        <?

  }



  $req = db::query("SELECT * FROM products WHERE id='".db::escape($_GET["id"])."' LIMIT 1");
  $product = db::fetch_assoc($req);

 ?>


<div class="page-wrapper">
    <div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Product Edit / <?=$product["product_name"];?></h3>

  </div>
</div>
</div>




<div class="row">
  <div class="col-xl-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <h4 class="card-title"><?=$product["product_name"];?></h4>
      </div>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Product Name</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="product_name" value="<?=$product["product_name"];?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Product Info (Mouse over)</label>
            <div class="col-lg-9">
              <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

              <textarea rows="5" cols="5" name="product_info"  id="product_info" class="form-control" placeholder=""><?=htmlentities($product["product_info"]);?></textarea>
              <script>
                                      CKEDITOR.replace( 'product_info' );
              </script>


            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Product Image</label>
            <div class="col-lg-9">
              <input type="file" class="form-control" name="product_image" value="<?=$product["product_image"];?>">

              <img src="/<?=$product["product_image"];?>" width="200"/>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">SKU</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="product_sku" value="<?=$product["product_sku"];?>">
            </div>
          </div>



          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Category</label>
            <div class="col-lg-9">
              <input type="text" class="form-control" name="product_category" value="<?=$product["product_category"];?>" >
            </div>
          </div>


                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Required Points</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" name="required_points" value="<?=$product["required_points"];?>" >
                      </div>
                    </div>



          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status</label>
            <div class="col-lg-9">
              <select class="form-control" name="status">
                <option value="0" <?php if ($product["status"] == "0") {?>selected="selected" <? } ?>>Disabled</option>
                <option value="1" <?php if ($product["status"] == "1") {?>selected="selected" <? } ?>>Enabled</option>
              </select>            </div>
          </div>

          <div class="text-right">
            <button type="submit" name="save" class="btn btn-primary">Save</button>
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
