 <?php
 include('include/databaseConnection.php');

 if (isset($_POST['submit'])) {
 	$userID = $_POST['userID'];
 	$name = $_POST['Name'];
 	$username= $_POST['username'];
 	$password= $_POST['password'];
 	$emailAddress = $_POST['emailAddress'];

 	$sqlupdate=mysqli_query($conn, "UPDATE `users` SET `name` = '$name', `username` = '$username',`password` = '$password',
 		`email_address`='$emailAddress' WHERE `userID`=$userID");

 	if($sqlupdate){
		$_SESSION['msg'] = 'User Updated Successfully';
		header('location:users.php');
	
 	}
 	else{
		 
		$_SESSION['error_msg'] = 'Failed To Update user';
		header('location:users.php');

 	}
 }

 $id = $_GET['id'];
 $sql = mysqli_query($conn, "select * from users WHERE `userID`='$id'");
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
 	<form method="post" action="editUsers.php" role="form">
 		<div class="modal-body">
 				<input type="hidden" id="userID" name="userID" value="<?php echo $row['userID'];?>"/>

 			<div class="form-group">
 				<label for="itemName">Name</label>
 				<input type="text" class="form-control" id="Name" name="Name" value="<?php echo $row['name'];?>" />
 			</div>

 			<div class="form-group">
 				<label for="itemName">Username</label>
 				<input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username'];?>" />
 			</div>
 			<div class="form-group">
 				<label >Password</label>
 				<input type="text" class="form-control" id="password" name="password" value="<?php echo $row['password'];?>" />
 			</div>
 			<div class="form-group">
 				<label for="attendant">Email Address</label>
 				<input type="text" class="form-control" id="emailAddress" name="emailAddress" value="<?php echo $row['email_address'];?>" />
 			</div>

 		</div>
 		<div class="modal-footer">
 			<input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
 			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 		</div>
 	</form>
 </body>
 </html>
