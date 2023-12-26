
<!-- Page Wrapper -->
      <div class="page-wrapper">
          <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col">
          <h3 class="page-title">Edit Email Template</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Email Template</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->



<form method="post">
    <?php



      $templates =[
        $_GET["id"]
      ];



            if (isset($_POST["save"])) {

              foreach ($templates as $name) {



                // Existiert bereits?
                $req = db::query("SELECT * FROM meta WHERE name='email_".$name."'  LIMIT 1");
                if (db::num_rows($req) == 1) {
                  db::query("UPDATE meta SET value='".db::escape($_POST[$name])."' WHERE name='email_".$name."'  LIMIT 1");
                }
                else {
                  db::query("INSERT INTO meta (name, value) VALUES ('email_".$name."','".db::escape($_POST[$name])."')");
                }





              }

            }




 ?>
 <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?=strtoupper($_GET["id"]);?></h4>
          </div>
          <div class="card-body">

            <?php foreach ($templates as $template) { ?>

            												<textarea rows="5" cols="5" name="<?=$template;?>"  id="<?=$template;?>" class="form-control" placeholder=""><?=htmlentities(getSettings("email_".$template));?></textarea>
                                    <script>
                                                            CKEDITOR.replace( '<?=$template;?>' );
                                    </script>

                            <? } ?>
                            <br/>
                            <button type="submit" name="save" class="btn btn-primary">Save</button>


                            <hr/>
                            <b>Placeholder:</b>
                            <ul>
                              <li>%%first_name%%  = First Name</li>
                              <li>%%last_name%%  = Last Name</li>
                              <li>%%order_id%%  = Order ID</li>
                              <li>%%order_summary%%  = Order Summary (Quantity + Product)</li>
                              <li>%%link%% = Use for Registration and Password Recovery</li>

                                            </ul>
                          </p>


          </div>
        </div>

      </div>
    </div>


  </div>
</div>
</form>
