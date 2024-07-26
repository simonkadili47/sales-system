<!doctype html>
<html>
<head>
  <link href="./include/style.css" rel="stylesheet"> 
</head>
<body>

  <?php include('modals.php')?>

  <div class="topnav" style="background-color: #2C3E50;">
    <div class="row">
      <div class="col-md-4">
         <a href="dashboard.php" style="float:left;  color: #FFFFFF;" class="logo">
        <img src="images/pos-logo.png" height="45px" width="45px"> Retail Shop Management System
        </a>
      </div>
      <div class='col-md-6' style="float: right;  margin-right: 10px;">
            <a data-toggle="modal" data-target="#Logout" title="Logout" style="float: right;padding: 10px"><span class="glyphicon glyphicon-off"></span></a>
                <a data-toggle="modal" title="Change Password" data-target="#changePassword" style="float: right;padding: 10px"><i class="fa fa-user fa-fw"></i></a>


      </div>
    </div>
   

  </div>

  <?php include('modals.php');?>

  <div class="navbar-default sidebar" id="sidebar-nav" role="navigation" style="margin: 0px;"  id="side-menu">

    <div class="sidebar-nav navbar-collapse">
      <ul class="nav">
        <li><a href="dashboard.php"><i class="fa fa-dashboard fa-fw"  style="color:green;"></i> Shop | dashboard</a></li>

        <li class="collapsed active" data-toggle="collapse" data-target="#sales">
          <a href="sales.php"><i class="fa fa-money" style="color:green;" aria-hidden="true"></i> Sales</a></li>

          <!-- <li>
            <a href="products.php"><i class="fa fa-bar-chart-o fa-fw"  style="color:green;" ></i> Stock</a>
          </li>

          <li>
            <a href="reports.php"><i class="fa fa-newspaper-o" style="color:green;" aria-hidden="true"></i> Reports</a>
          </li> -->

          <li>
            <?php if($_SESSION['role']=='admin'){
              echo'<a href="users.php"><i class="fa fa-users" style="color:green;" aria-hidden="true"></i> Users<span class=""></span></a>';}?>
            </li>
            <li>
            <?php if($_SESSION['role']=='admin'){
              echo'<a href="reports.php"><i class="fa fa-users" style="color:green;" aria-hidden="true"></i> Reports<span class=""></span></a>';}?>
            </li>
          </ul>
        </div>

      </div>
    </body>
    </html>
