<?php
session_start();
include('include/checkLogin.php');
check_login();
include('include/databaseConnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Retail Shop Management System</title>
	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>

    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<!-- left Navigation and header  -->
	<?php include('include/leftbar.php');?>
	
	<div id="wrapper">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="page-header">
						<?php echo strtoupper("SHOP DASHBOARD | "." ".htmlentities($_SESSION['username']));?>
					</h4>
				</div>
			</div>

			

				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading"><strong>Total Sales</strong></div>
						<div class="panel-body">
							<a href="sales.php" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
							" class="btn btn-primary btn-block ">
							<img src="images/sales.jpg" style="height:25px; width:25px; border-radius:50%;"><br> Sales
							<?php 
							$date=date('Y-m-d');
							$salesQuery = mysqli_query($conn, "select sum(amountPaid) from sales where date = '$date'");
							$resultsales = mysqli_fetch_array($salesQuery);
							echo'<br>'. number_format($resultsales[0]);?>
							</a>
						</div>
					</div>
				</div>

				<?php
					if($_SESSION['role'] == 'admin'){
				?>

						
                <div class="row">
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading"><strong>Stock</strong></div>
						<div class="panel-body">
							<a href="products.php" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-info btn-block">
								<img src="images/stock.png" style="height:25px; width:25px; border-radius:50%;">
								<br>Stock <br>
								<?php 
								$StockQuery = mysqli_query($conn, "select count(productID) from products");
								$resultProd = mysqli_fetch_array($StockQuery);
								echo $resultProd[0];
								?>
							</a>
						</div>
					</div>
				</div>
						<div class="col-sm-4">
					      <div class="panel panel-default">
						<div class="panel-heading"><strong>Users</strong></div>
						<div class="panel-body">

							<a href="users.php" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
							" class="btn btn-primary btn-block">
							<img src="images/users.png" style="height:25px; width:25px; border-radius:50%;"><br> Users
							<br>
							<?php 
							$UserQuery = mysqli_query($conn, "select count(userID) from users");
							$resultUser = mysqli_fetch_array($UserQuery);
							echo $resultUser[0];?></a>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading"><strong>Reports</strong></div>
						<div class="panel-body">

							<a href="reports.php" 
							style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"
							class="btn btn-basic btn-block">
							<img src="images/reports.png" style="height:25px; width:25px; border-radius:50%;"> <br>Reports<br><br></a>
						</div>
					</div>
				</div>
			</div>

				<?php

					}
				?>

				

			</div>
			<hr>	
			
		</div>
	</div>
</body>

</html>