<div class="page-wrapper">
    <div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
  <div class="col">
    <h3 class="page-title">Settings</h3>
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      <li class="breadcrumb-item active">Email Template</li>
    </ul>
  </div>
</div>
</div>





<?php

  $templates =[
    "registration","password_recovery","order_confirmation","admin_order_confirmation","footer"
  ];
  $templates2 =[
    "terms","privacy_policy","optin"
  ];

  $settings = [

  'ORDER_NOTIFICATION_EMAIL',  'GOOGLE_ANALYTICS_ID','FACEBOOK_APP_ID','GOOGLE_APP_CLIENT_ID','GOOGLE_APP_SECRET','EMAIL_FROM','EMAIL_FROM_NAME'];

    if (isset($_POST["save"])) {


      foreach ($settings as $name) {

        // Existiert bereits?
        $req = db::query("SELECT * FROM meta WHERE name='".$name."'  LIMIT 1");
        if (db::num_rows($req) == 1) {
          db::query("UPDATE meta SET value='".db::escape($_POST[$name])."' WHERE name='".$name."' LIMIT 1");
        }
        else {
          db::query("INSERT INTO meta (name, value) VALUES ('".$name."','".db::escape($_POST[$name])."')");
        }



      }


            foreach ($templates2 as $name) {

              // Existiert bereits?
              $req = db::query("SELECT * FROM meta WHERE name='".$name."'  LIMIT 1");
              if (db::num_rows($req) == 1) {
                db::query("UPDATE meta SET value='".db::escape($_POST[$name])."' WHERE name='".$name."' LIMIT 1");
              }
              else {
                db::query("INSERT INTO meta (name, value) VALUES ('".$name."','".db::escape($_POST[$name])."')");
              }



            }





    }




 ?>

 <div class="row">
   <div class="col-lg-12">
     <div class="card">
       <div class="card-header">
         <h4 class="card-title">Settings</h4>
       </div>

       <div class="card-body">

         <form action="" method="post">

           <?php foreach ($settings as $setting) { ?>
           <div class="form-group row">
             <label class="col-form-label col-md-4"><?=$setting;?></label>
             <div class="col-md-8">
               <input type="<?php if ($setting == "PAYMENT_STRIPE_SECRET") { ?>password<? } else { ?>text<? } ?>" class="form-control" name="<?=$setting;?>" value="<?=getSettings($setting);?>">
             </div>
           </div>
         <? } ?>


         <button name="save" class="btn btn-primary">Save</button>

       </div>
     </div>

   </div>
 </div>



  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pages</h4>
        </div>

        <div class="card-body">

            <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

            <?php foreach ($templates2 as $setting) { ?>
            <div class="form-group row">
              <label class="col-form-label col-md-4"><?=$setting;?></label>
              <div class="col-md-8">
                <textarea rows="5" cols="5" name="<?=$setting;?>"  id="<?=$setting;?>" class="form-control" placeholder=""><?=htmlentities(getSettings($setting));?></textarea>
                <script>
                                        CKEDITOR.replace( '<?=$setting;?>' );
                </script>

              </div>
            </div>
          <? } ?>


          <button name="save" class="btn btn-primary">Save</button>

          </form>
        </div>
      </div>

    </div>
  </div>



<div class="row">
<div class="col-sm-12">

  <div class="card card-table">
    <div class="card-header">
      <h4 class="card-title">Email Templates</h4>
       </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-center mb-0">
          <thead>
            <tr>
              <th>Template</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
              foreach ($templates as $template) {
            ?>
            <tr>
              <td>
                <h2 class="table-avatar">
                  <a href="/backend/email_edit?id=<?=$template;?>"> <?=$template;?></a>
                </h2>
              </td>
              <td class="text-right">
                <div class="actions">
                  <a href="/backend/email_edit?id=<?=$template;?>" class="btn btn-sm bg-success-light mr-2">
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
