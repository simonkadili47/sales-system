<?php
	include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
    	$stockID = $_POST['stockID'];
    	$productName = $_POST['productName'];
    	$quantityStocked = $_POST['quantityStocked'];
    	$attendant = $_POST['attendant'];
    	$restockDate = $_POST['restockDate'];
	
	$sqlSelect=mysqli_query($conn,"select productID from products where productName='$productName'");
	$resultselect=mysqli_fetch_row($sqlSelect);
		
	if(empty($resultselect)){
		?>

<script>
alert("Product Doesnt Exist")
document.location.href = 'updateStock.php';

</script>
<?php
	}else{
	
	
		$productID = $resultselect[0];

  $sqlupdate=mysqli_query($conn, "UPDATE `stock` SET `productID` = '$productID', 
  `quantityStocked` = '$quantityStocked', `attendant`='$attendant',`restockDate`='$restockDate' WHERE
  `stockID`=$stockID");
	
if($sqlupdate){
		?>
		<script>
		//alert('Record Updated successfully');
				document.location.href = 'updateStock.php?status=1&msg=Record Updated successfully';
		</script>
		
		<?php
	}
		else{?>
		
					<script>
		//alert('Failed To Update Record');
		document.location.href = 'updateStock.php?status=1&msg=Failed To Update Record';
		</script>
		<?php

	}
}

	
    }
  
    $id = $_GET['id'];


    $sql = mysqli_query($conn, "select stockID, quantityStocked, attendant, restockDate, products.productName
	from stock inner join products on stock.productID=products.productID WHERE `stockID`=$id");
    $row = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stock</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="editStock.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="stockID" name="stockID" value="<?php echo $row['stockID'];?>" readonly="true"/>
		</div>

		<div class="form-group">
		    <label for="supplierName">Product Name</label>
	            <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $row['productName'];?>" />
		</div>
		<div class="form-group">
		    <label for="quantity">Quantity</label>
	            <input type="text" class="form-control" id="quantityStocked" name="quantityStocked" value="<?php echo $row['quantityStocked'];?>" />
		</div>
		<div class="form-group">
		     <label for="attendant">Attendant</label>
		     <input type="text" class="form-control" id="attendant" name="attendant" value="<?php echo $row['attendant'];?>" readonly/>
		</div>
		<div class="form-group">
                     <label for="emailAddress">Date</label>
		     <input type="text" class="form-control" id="restockDate" name="restockDate" value="<?php echo $row['restockDate'];?>" />
		</div-->
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>