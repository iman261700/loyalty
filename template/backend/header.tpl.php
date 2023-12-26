<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Ritma Press | Backend</title>

        <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/feathericon.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/style-orange.css?<?=time();?>">
    		<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="/assets/plugins/fullcalendar/fullcalendar.min.css">

        <script src="/assets/js/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
    <body>

		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<!-- Header -->
            <div class="header">

				<!-- Logo -->
                <div class="header-left">
                    <a href="#" class="logo">
						<img src="/images/logo.png" alt="Logo">
					</a>
					<a href="index.html" class="logo logo-small">
						<img src="/images/logo.png" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->

				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>

				<div class="top-nav-search">
					<form method="POST" action="?p=customers">
						<input type="text" class="form-control" name="search" placeholder="Customer or Order ID ">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>

				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>

				</a>
				<!-- /Mobile Menu Toggle -->

				<!-- Header Right Menu -->
				<ul class="nav user-menu">





					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
							<span class="user-img"><?=$_SESSION["user"]["email"];?></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">

								<div class="user-text">
									<h6>Admin</h6>
								</div>
							</div>
							<a class="dropdown-item" href="/logout">Logout</a>
						</div>
					</li>
					<!-- /User Menu -->

				</ul>
				<!-- /Header Right Menu -->

            </div>
			<!-- /Header -->

			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>

							<li class="menu-title">
								<span>RITMA</span>
							</li>


              <li>
                <a href="/backend/customers"><i class="fe fe-users"></i> <span>Customers</span></a>
              </li>

              <li>
                <a href="/backend/orders"><i class="fe fe-book"></i> <span>Orders</span></a>
              </li>

              <li>
                <a href="/backend/products"><i class="fe fe-beginner"></i> <span>Products </span></a>
              </li>

              <li>
                <a href="/backend/report"><i class="fe fe-line-chart"></i> <span>Report</span></a>
              </li>

              <li>
                <a href="/backend/codes"><i class="fe fe-camera"></i> <span>Codes</span></a>
              </li>

              <li>
                <a href="/backend/settings"><i class="fe fe-gear"></i> <span>Settings</span></a>
              </li>





						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" integrity="sha256-xHkYry2yRjy99N8axsS5UL/xLHghksrFOGKm9HvFZIs=" crossorigin="anonymous"></script>
