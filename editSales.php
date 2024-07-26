<?php
	include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
	$salesID = $_POST['salesID'];
	$productName = $_POST['productName'];
	$quantitySold = $_POST['quantitySold'];
	$productionCost = $_POST['productionCost'];
	$sellingPrice = $_POST['sellingPrice'];
	$amountPaid = $_POST['amountPaid'];
	$customerName = $_POST['customerName'];
	$date = $_POST['date'];

	 $sqlupdate=mysqli_query($conn, "UPDATE `sales` SET 
  	`productName` = '$productName', `quantitySold` = '$quantitySold',
  	`productionCost` = '$productionCost', `sellingPrice` = '$sellingPrice', `date` = '$date', `amountPaid` = '$amountPaid'
  		WHERE `salesID`=$salesID");


if($sqlupdate){
		$_SESSION['msg'] = 'Record Updated successfully';
		header('location:sales.php');
		exit();
	}else{
		$_SESSION['msg'] = 'Record Updated successfully';
		header('location:sales.php');
		exit();
	}


	
    }
  
$id = $_GET['id'];
$sql = mysqli_query($conn, "select * from sales inner join products on sales.productID = products.productID WHERE salesID='$id'");
    $row = mysqli_fetch_array($sql);

	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit sales</title>

	<!--cal sales-->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>

<script>
  
 $(document).ready(function(){
    $(".input").keyup(function(){
          var sellingPrice = +$(".sellingPrice").val();
          var quantitySold = +$(".quantitySold").val();
          $("#totalAmount").val(sellingPrice*quantitySold);
    });
});
 

</script>

<body>
<form method="POST" action="editSales.php" role="form">
	<div class="modal-body">
		<!-- <div class="form-group">
		    <label for="id">ID</label> -->
		    <input type="hidden" class="form-control" id="salesID" name="salesID" value="<?php echo $row['salesID'];?>"/>
		    
		<div class="form-group">
                     <label >Customer</label>
		    <input type="text" class="form-control" id="customerName" name="customerName" value="<?php echo $row['customerName'];?>" />
		</div>

		<div class="form-group">
		    <label >Product</label>
	            <input type="text" class="form-control" id="productName" name="productName" value="<?php 
	            echo $row['productName'];?>" />
		</div>
		<div class="form-group">
		    <label >Quantity</label>
	            <input type="text" class="form-control quantitySold input" id="quantitySold" name="quantitySold" value="<?php echo $row['quantitySold'];?>" />
		</div>
		<div class="form-group">
		     <label >Cost</label>
		     <input type="text" class="form-control productionCost input" id="productionCost" name="productionCost" value="<?php echo $row['productionCost'];?>" />
		</div>
		<div class="form-group">
                     <label >Selling Price</label>
		     <input type="text" class="form-control input sellingPrice" id="sellingPrice" name="sellingPrice" value="<?php echo $row['sellingPrice'];?>" />
		</div>
		<div class="form-group">
                     <label >Total</label>
		     <input type="text" id="totalAmount" name="amountPaid" class="form-control input totalAmount" value="<?php echo $row['amountPaid'];?>" readonly>
		</div>
		<div class="form-group">
                     <label >Date</label>
		     <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['date'];?>" max="<?php echo $current_date = date('Y-m-d'); ?>" />
		</div>


		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>