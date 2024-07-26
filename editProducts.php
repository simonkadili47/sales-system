 <?php
include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
    	$productID = $_POST['productID'];
    	$productName = $_POST['productName'];
    	$description = $_POST['description'];
    	$productionCost = $_POST['productionCost'];
    	$productPrice = $_POST['productPrice'];
	
  $sqlupdate=mysqli_query($conn, "UPDATE `products` SET `productName` = '$productName', `description` = '$description', `productionCost` = '$productionCost', `productPrice` = '$productPrice' WHERE `productID`=$productID");
	
if($sqlupdate){
		?>
		<script>
				document.location.href = 'products.php?status=1&msg=Record Updated successfully';
		</script>
		
		<?php
	}
		else{?>
		
					<script>
				document.location.href = 'products.php?status=2&msg=Failed To Update Record';
		</script>
		<?php

	}

	

    }

 $id = $_GET['id'];


    $sql = mysqli_query($conn, "select productID, productName, description, productionCost, productPrice from products WHERE `productID`='$id'");
    $row = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="editProducts.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="productID" name="productID" value="<?php echo $row['productID'];?>" readonly="true"/>
		</div>
		
		<div class="form-group">
		    <label for="itemName">Product Name</label>
	            <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $row['productName'];?>" />
		</div>

		<div class="form-group">
		    <label for="itemName">Description</label>
	            <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['description'];?>" />
		</div>

		<div class="form-group">
		    <label >Production Cost</label>
	            <input type="text" class="form-control" id="productionCost" name="productionCost" value="<?php echo $row['productionCost'];?>" />
		</div>

		<div class="form-group">
		    <label >Product Price</label>
	            <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?php echo $row['productPrice'];?>" />
		</div>
				
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>