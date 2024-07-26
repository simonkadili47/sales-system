<?php
	include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$oldqtyStocked = $_POST['oldqtyStocked'];
    	$productID = $_POST['productID'];
   
$sqlSelectProqty =mysqli_query($conn, "select quantity from products where productID = $productID");
$resultSelectProqty = mysqli_fetch_row($sqlSelectProqty);	
$newqtyAvail=$resultSelectProqty[0]-$oldqtyStocked;

$sqlUpdateqty=mysqli_query($conn,"update products set quantity=$newqtyAvail where productID = $productID ");
   
  $sqldel=mysqli_query($conn, "delete from `stock` WHERE `stockID`=$id");
	
if($sqldel){
		?>
		<script>
		alert('Record Deleted successfully');
				document.location.href = 'stock.php';
		</script>
		
		<?php
	}
		else{?>
		
					<script>
		alert('Failed To Delete Record');
						document.location.href = 'stock.php';
		</script>
		<?php

	}

	
    }
  
    $id = $_GET['id'];


   $sql = mysqli_query($conn, "SELECT productID, quantityStocked FROM `stock` WHERE `stockID`='$id'");
   $row = mysqli_fetch_row($sql);
   $oldqtyStocked=$row[1];
   $productID=$row[0];


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
<form method="POST" action="delStock.php" role="form">
	<div class="modal-body">
		<div class="form-group">
	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id?>" readonly="true"/>
	<input type="hidden" class="form-control" id="oldqtyStocked" name="oldqtyStocked" value="<?php echo $oldqtyStocked ?>">
	<input type="hidden" class="form-control" id="productID" name="productID" value="<?php echo $productID ?>">

		</div>
		Are You Sure You want to delete  <b style="color: darkred; font-size: 20px;"><?php echo 'TID'.$id?></b> Permanently
	</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-danger" name="submit" value="Confirm" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	</form>
</body>
</html>