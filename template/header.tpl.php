<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <link rel="stylesheet" href="https://ritmapres.com/wp-content/themes/betheme/css/layout.css?ver=21.5.8"/>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;500&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Ritmapres - Loyalty Program</title>

    <style>

      body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      .top {
        background-color: #940006;
        color: white;
        text-align: center;
        width: 100%;
        height:330px;
      }

      .bread-crumb {
        padding-bottom: 50px;
      }

      .top i {
        font-size: 9px;
        margin: 0px 10px;
      }

      h3 {
        margin: 40px 0px 10px 0px;
      }

      .logo {
        border-bottom:1px solid red;
        width:100%;
        text-align: center;
        display: block;;
        padding-bottom: 8px;  padding-top: 10px;
      }

      .content {
        background-color: white;
        -webkit-box-shadow: 0px 10px 17px 0px rgba(0,0,0,0.16);
        -moz-box-shadow: 0px 10px 17px 0px rgba(0,0,0,0.16);
        box-shadow: 0px 10px 17px 0px rgba(0,0,0,0.16);
        max-width:95%;
        width: 1024px;
        margin: -100px auto;
        min-height: 700px;
        height: auto;
      }

      .content .content-inner {
          width: 90%;
          margin: 0 auto;;
          padding-top: 20px;
      }

      .top-content-menu {
        text-align: right;
        font-size: 13px;
      }

      .top-content-menu .login {
          margin-left:50px;
      }

      .cart {
        color: #858585;
      }

      .top-content-menu  i {
        margin-right: 10px;
      }

      .column-2 {
        width: 50%;
        float: left;
      }

      .col-8x {
        width: 60%; float: left;
        padding: 5px;
      }

      .centered {
        text-align: center;
        margin: 0 auto;;
        float: none !important;
      }

      .centered input, .centered label {
        float: none !important;
        text-align: center;;
      }

      .col-4x {
        width: 40%;float: left;        padding: 5px;

      }

      .col-6x {
        width: 50%;        padding: 5px;

        float: left;
      }

      label {
        font-weight: bold;
        display: block;
        text-align: left;
      }

      input {
        background-color: #f5f5f5;
        text-align: center;
        padding: 15px 8px;
        border:none;
        border-radius: 8px;
        width: 100%;
        float: left;
      }

      div, span {
        box-sizing: border-box;
      }

      .btn {
        background-color: #e10030;
        color: white;
        font-size: 14px;
        font-weight: bold;
        border-radius: 20px;
        padding: 5px 40px;
      }

            .btn2 {
              border:none;
              background-color: black;
              color: white;
              font-size: 14px;
              font-weight: bold;
              border-radius: 20px;
              padding: 5px 40px;
            }
      a {
        color: #e10030;
      }

        a:hover {
          color: #e10030;
        }


        /* Customize the label (the container) */
        .container-checkbox {
          display: block;
          position: relative;
          padding-left: 15px;
          margin-bottom: 12px;
          cursor: pointer;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container-checkbox input {
          position: absolute;
          opacity: 0;
          cursor: pointer;
          height: 0;
          width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
          position: absolute;
          top: 0;
          left: 0;
          height: 15px;
          width: 15px;
          background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container-checkbox:hover input ~ .checkmark {
          background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container-checkbox input:checked ~ .checkmark {
          background-color: #e10030;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
          content: "";
          position: absolute;
          display: none;
        }

        /* Show the checkmark when checked */
        .container-checkbox input:checked ~ .checkmark:after {
          display: block;
        }

        /* Style the checkmark/indicator */
        .container-checkbox .checkmark:after {
          left: 4px;
          top: 3px;
          width: 6px;
          height: 8px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }

        input.password_input {
          background: url(/images/input_password.png) #f5f5f5 no-repeat center right;
        }

        input.email_input {
          background: url(/images/input_email.png) #f5f5f5 no-repeat center right;
        }

        .top-bar {
          font-weight:bold;
          padding: 15px 15px;
          font-size:20px;
          background-color: #f8f8f8;
          text-align: center;
          border-bottom: 1px solid #e9e9e9;
        }

        @media only screen and (max-width: 600px) {
.column-2,.col-8x,.col-4x, .col-6 {
  width: 100%;
  float: none;
  text-align: center;;
}

.column-2 img {
  width: 100px;
  margin: 0 auto;;
}

.top-content-menu {
  width: 100% !important;
  text-align: center;
}

.content-inner {
  width: 98% !important;
  padding-top: 20px !important;
}

.x4 {
  width: 50% !important;
  padding: 10px;
}

div {
  box-sizing: border-box;;
}

.product {
  width: 44% !important;
}

.mobile-100 {
  width: 100% !important;
}

.mobile-100 button {
  width: 100%;
}

h3 {
  margin: 20px 0px !important;
}

.cart,.login {
  display: block;;
  width: 100%;
  margin: 0 !important;
}

.content {
  margin-top:-180px;
}
}



    </style>
  </head>
  <body>

  <style>

  .container {
    min-height: 900px;
  }
    .ritma_header {
      background-color: #940006;
      height:68px;
    }

    .ritma_header img {
      padding:1px 0px;
      margin-top:7px;
      margin-left:-3px;
    }

    .ritma_inner {
      margin: 0 auto;


    }

    #menu {
      display:noane;
    }

    @font-face{font-family:'mfn-icons';src:url(/mfn-icons.eot?31690507);src:url(/mfn-icons.eot?31690507#iefix) format("embedded-opentype"),url(/mfn-icons.woff?31690507) format("woff"),url(/mfn-icons.ttf?31690507) format("truetype"),url(/mfn-icons.svg?31690507#mfn-icons) format("svg");font-weight:400;font-style:normal}


.responsive-menu-toggle {
  position: absolute;
  left:0px;
  top: 0px;
  padding-left:92px;
  padding-top:24px;
  padding-bottom:28px;
}

@media only screen and (max-width: 600px) {

  .footer {
    padding: 40px 20px !important;
  }

}


@media only screen and (max-width: 600px) {

  .responsive-menu-toggle {
    padding-left:10px;
    padding-top:17px;

}

.responsive-menu-toggle .icon-menu-fine:before {
  font-size: 30px !important;
}

}


    .icon-menu-fine:before {
font-size: 22px;
color: white;
    content: '\e960';
    font-family: "mfn-icons";
font-style: normal;
font-weight: 400;
speak: none;
display: inline-block;
text-decoration: none!important;
width: 1em;
margin-right: .2em;
text-align: center;
font-variant: normal;
text-transform: none;
line-height: 1em;
margin-left: .2em;
}

.ritma_header ul {
  list-style: none;
  list-style-position: inside;;
  margin: 0; padding: 0;
}

.ritma_header li {
  line-height: 44px;
  font-size:17px;
  padding: 0 25px
}

.ritma_header li:hover {
  background: rgba(0,0,0,.02);
}

.ritma_header ul li a {
  color: white;
}

.ritma_header #menu {
  position: absolute;;
  background-color: #606060;
  left: 0px;
  min-width: 230px;
font-family: Poppins, Arial, Tahoma, sans-serif;
font-size: 17px;
font-stretch: 100%;
display: none;
}

.ritma_header ul li.active a {
  color: #e10030;
}

<?php
  if ($_SERVER["REQUEST_URI"] == "/") { ?>
body {

    -webkit-animation: fadein 0.5s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 0.5s; /* Firefox < 16 */
        -ms-animation: fadein 0.5s; /* Internet Explorer */
         -o-animation: fadein 0.5s; /* Opera < 12.1 */
            animation: fadein 0.5s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
<? } ?>


  </style>

  <div style="">

  <div class="ritma_header">

    <Div class="ritma_inner">

      <center>
        <a class="logao" href="/">
        <img src="/images/logo.png" height="60"/>
      </a>
     </center>

        <?php
        if ($_SESSION["user"]["role"] == "admin") {
         ?>
         <a href="/backend/orders"  data-no-instant style="font-weight: bold; border: 1px solid white; padding: 5px 10px; display:inline-block; position: absolute; color:white; right:5px; top: 5px;">ADMIN</a>
       <? } ?>



      <a class="responsive-menu-toggle " href="javascript:$('.menu-dropdown').slideToggle();"><i class="icon-menu-fine"></i></a>
    <nav id="menu" class="menu-dropdown"><ul id="menu-main-menu" class="menu menu-main"><li id="menu-item-2308" class=""><a href="https://ritmapres.com/my/" aria-current="page"><span>Home – Malaysia</span></a></li>
    <li id="menu-item-3746" class=""><a href="https://ritmapres.com/my/products/"><span>Products – Malaysia</span></a></li>
    <li id="menu-item-3747" class="active"><a href="https://loyalty.ritmapres.com/"><span>Loyalty</span></a></li>
    <li id="menu-item-3748" class=""><a href="https://ritmapres.com/my/latest-news/"><span>News</span></a></li>
    <li id="menu-item-3747" class=""><a href="https://ritmapres.com/my/gallery/"><span>Gallery</span></a></li>

    <li id="menu-item-2443" class=""><a href="https://ritmapres.com/my/contact-us/"><span>Contact Us – Malaysia</span></a></li>
    </ul></nav>		</div>

  </div>

  </div>



    <div class="top">



<br/>
      <h3>
        <?=$titles[explode("?",$_SERVER["REQUEST_URI"])[0]];?>
      </h3>
      <div class="bread-crumb">
        Home <i class="fa fa-chevron-right" aria-hidden="true"></i> <A href="/" style="text-decoration:none; color: white;">Loyalty Program</A> <i class="fa fa-chevron-right" aria-hidden="true"></i> <?=$titles[explode("?",$_SERVER["REQUEST_URI"])[0]];?>
      </div>

    </div>

    <div class="content">

      <?php if (isset($_SESSION["user"])) { ?>
      <Div class="top-bar">
        <?=$titles[explode("?",$_SERVER["REQUEST_URI"])[0]];?>

      </div>
    <? } ?>

      <div class="content-inner">



    <div class="top-content-menu">


        <span class="cart">
          <?php if (isset($_SESSION["user"])) { ?>

          <A href="/user/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?=number_format(count($_SESSION["cart"]),0);?> items in cart</a>
          <? } else { ?>
            <A href="/login"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?=number_format(count($_SESSION["cart"]),0);?> items in cart</a>

          <? } ?>
        </span>

        <span class="login">
          <?php if (isset($_SESSION["user"])) { ?>



            <i class="fa fa-user" aria-hidden="true"></i><b>Hi, <?=$_SESSION["user"]["first_name"];?></b> <A style="margin-left: 10px;" href="/">Start</a> / <A style="margin-left:0px;" href="/user/delivery_address">Edit Profile</a> / <A data-no-instant href="/logout">Logout</a>
          <? } else { ?>
            <i class="fa fa-user" aria-hidden="true"></i> <A href="/login">Login</a> / <A href="/signup">Sign Up</a>
          <? } ?>
        </span>


                <?php if (isset($_SESSION["user"])) { ?>

                            <?php

                              if (db::num_rows(db::query("SELECT * FROM user_shipping WHERE user_id='".$_SESSION["user"]["id"]."' LIMIT 1")) == 0 ) {

                             ?>

                             <a href="/user/delivery_address" style="width:100%; border: 1px solid #e10030; color: white; background-color:#e10030; text-align:center; padding:5px; font-size:12px; display: block; margin-top:10px;">Click here to add your address.</a>

                           <? }} ?>


    <div>




<style>

  .x4 {
    width: 25%;
    float: left;
    text-align: center;
  }

  .point_overview .points {
    font-size: 38px;
    color: #b4c0cc;
    font-weight: bold;
    display: block;;
  }

  .point_overview {
    font-weight: bold;
    font-size: 14px;
    border: 1px solid #eaeaea;
    padding: 20px;
    width:100%;
  }

    .point_overview input {
      font-size: 12px;
    }

    .point_overview button {
      margin-top: 15px;
    }

</style>

<br clear="both"/>



<?php
if (isset($_POST["optin"])) {

  db::query("UPDATE users SET optin = 1 WHERE id='".$_SESSION["user"]["id"]."' LIMIT 1");
  $_SESSION["user"]["optin"]  = 1;

}


if (isset($_SESSION["user"]["optin"]) && $_SESSION["user"]["optin"] == "0" && $_SERVER["REQUEST_URI"] == "/") { ?>
<form method="post">
  <div class="modal fade" id="modal_terms" tabindex="-1" role="dialog" aria-labelledby="modal_terms" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body" style="color:black;">
      <h3>Terms & Conditions</h3>
        <div style="height:300px; overflow:scroll; border: 2px solid #efefef; padding:10px; margin-top:10px; ">
        <?=getSettings("terms");?>
      </div>
      <label class="container-checkbox"><?=getSettings("optin");?>
<input name="optin" value="1" type="checkbox" checked="checked">
<span class="checkmark"></span>
</label>


    </div>
    <div class="modal-footer" style="display:block;">
      <Center>
      <button type="submit" class="btn  btn-red"  name="submit">Submit</button>
      </center>
    </div>
  </div>
 </div>  </div>
</form>
 <script>
  $(document).ready(function() {
      $("#modal_terms").modal({backdrop: 'static', keyboard: false});
  });
 </script>
<? } ?>
