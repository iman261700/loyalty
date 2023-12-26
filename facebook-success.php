<?php
session_start();
require_once("classes/db.class.php");
require_once("classes/sendgrid.class.php");

require_once("config.inc.php");

db::connect();

// Check if got registred user with fbid
$req = db::query("SELECT * FROM users WHERE fb_id='".$_SESSION['fb_id']."' AND fb_id > 0 LIMIT 1");
if (db::num_rows($req) == 1) {

  $_SESSION["user"] = db::fetch_assoc($req);
  header("location: /");die();

}
else {
  header("location: /signup?fb=".$_SESSION['fb_id']);
  die();
}



die();
?>
<head>
     <title>Login with Facebook</title>
     <link
        href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        rel = "stylesheet">
  </head>
  <body>
  <?php



  if(isset($_SESSION['fb_id'])) {?>
        <div class = "container">
           <div class = "jumbotron">
              <h1>Hello <?php echo $_SESSION['fb_name']; ?></h1>
              <p>Welcome to Cloudways</p>
           </div>
              <ul class = "nav nav-list">
                 <h4>Image</h4>
                 <li><?php echo $_SESSION['fb_pic']?></li>
                 <h4>Facebook ID</h4>
                 <li><?php echo  $_SESSION['fb_id']; ?></li>
                 <h4>Facebook fullname</h4>
                 <li><?php echo $_SESSION['fb_name']; ?></li>
                 <h4>Facebook Email</h4>
                 <li><?php echo $_SESSION['fb_email']; ?></li>
              </ul>
          </div>
<?php } ?>
  </body>
</html>
