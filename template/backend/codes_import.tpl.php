
<?php

  if (isset($_POST["save"])) {

    $csv = file_get_contents($_FILES["import"]["tmp_name"]);

    $i = 0;
    $imported = 0;
    $existing = 0;

    try {
        foreach (explode("\n", $csv) as $line) {

            if ($i > 0) { // Skip Header

                $col = explode(",", $line);

                // check if code existing
                if (db::num_rows(db::query("SELECT id FROM codes WHERE code='" . db::escape($col[0]) . "' AND pin='" . db::escape($col[1]) . "' LIMIT 1")) == 1 || empty($col[0])) {
                    $existing++;
                } else {
                    $imported++;

                    db::query("INSERT INTO codes (code, pin, value, product, distributor_code) VALUES ('" . db::escape($col[0]) . "','" . db::escape($col[1]) . "','" . db::escape($col[2]) . "','" . db::escape($col[3]) . "','" . db::escape($col[4]) . "')");
                }
            }

            $i++;
        }
    } catch (Exception $e) {
        // Handle the exception
        echo "Error: " . $e->getMessage();
    }

    // db::query("INSERT INTO products (product_name,product_category,product_image,product_sku,required_points,status)
    //
    // VALUES ('".db::escape($_POST["product_name"])."',
    // '".db::escape($_POST["product_category"])."',
    // '".db::escape($_POST["product_image"])."',
    // '".db::escape($_POST["product_sku"])."',
    // '".db::escape($_POST["required_points"])."',
    // '".db::escape($_POST["status"])."')");

    ?>
    <script>alert('Codes Imported: <?= $imported; ?> / Codes skipped: <?= $existing; ?>');</script>
    <?php
}



 ?>


<div class="page-wrapper">
    <div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Import Codes</h3>

  </div>
</div>
</div>




<div class="row">
  <div class="col-xl-12 d-flex">
    <div class="card flex-fill">

      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Sample File</label>
            <div class="col-lg-9">
                <a href="/sample.csv">Sample CSV Template for Import</a>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">File</label>
            <div class="col-lg-9">
              <input type="file" class="form-control" name="import" value="<?=$product["product_image"];?>">
            </div>
          </div>

          <div class="text-right">
            <button type="submit" name="save" class="btn btn-primary">Upload</button>
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
