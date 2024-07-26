<?php
	include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
    	$salesID = $_POST['salesID'];
    	$sqldel = $conn->query("delete from `sales` WHERE `salesID`=$salesID");
	
if($sqldel){
		
 	header('location:sales.php?status=1&msg=Item deleted Succesfully');
 	exit();
	}else{
 	header('location:sales.php?status=1&msg=Item deleted Succesfully');
 	exit();}

	
    }
  
    $id = $_GET['id'];
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
<form method="post" action="delSales.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <input type="hidden" class="form-control" id="salesID" name="salesID" value="<?php echo $id ?>" readonly="true"/>
		</div>
		Are You Sure You want to delete sales <!-- <b style="color: darkred; font-size: 20px;"><?php echo 'SID'.$id ?></b> --> Permanently
	</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-danger" name="submit" value="Confirm" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	</form>
</body>
</html>