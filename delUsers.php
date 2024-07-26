<?php
	include('include/databaseConnection.php');


if (isset($_POST['submit'])) {
    	$userID = $_POST['userID'];

  $sqldel=mysqli_query($conn, "delete from `users` WHERE `userID`=$userID");

if($sqldel){
		?>
		<script>
				document.location.href = 'users.php?status=1&msg=User Deleted successfully';
		</script>

		<?php
	}
		else{?>

					<script>
						document.location.href = 'users.php?status=2&msg=Failed To Delete User';
		</script>
		<?php

	}


    }

    $id = $_GET['id'];


    $sql = mysqli_query($conn, "SELECT userID, Name FROM `users` WHERE `userID`='$id'");
    $row = mysqli_fetch_row($sql);

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
<form method="post" action="delUsers.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <input type="hidden" class="form-control" id="userID" name="userID" value="<?php echo $row[0];?>" readonly="true"/>
		</div>
		Are You Sure You want to delete <b style="color: darkred; font-size: 20px;"><?php echo $row[1];?></b> Permanently
	</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-danger" name="submit" value="Confirm" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	</form>
</body>
</html>
