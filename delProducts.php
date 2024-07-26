<?php
	include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
     
  $sqldel=mysqli_query($conn, "delete from `products` WHERE `productID`=$id");
	
if($sqldel){
		?>
		<script>
		//alert('Record Deleted successfully');
				document.location.href = 'products.php?status=1&msg=Record Deleted successfully';
		</script>
		
		<?php
	}
		else{?>
		
					<script>
		alert('Failed To Delete Record');
						document.location.href = 'products.php';
		</script>
		<?php

	}

	
    }
  
    $id = $_GET['id'];


   
   $sql = mysqli_query($conn, "SELECT productName FROM `products` WHERE `productID`=$id");
   $row=mysqli_fetch_row($sql);
   $productName=$row[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="POST" action="delProducts.php" role="form">
	<div class="modal-body">
		<div class="form-group">
	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id?>" readonly="true"/>

		</div>
		Are You Sure You want to delete  <b style="color: darkred; font-size: 20px;"><?php echo $productName ?></b> Permanently
	</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-danger" name="submit" value="Confirm" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	</form>
</body>
</html>