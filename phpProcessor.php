<?php
session_start();

include('include/databaseConnection.php');
// include('include/checkLogin.php');
// check_login();
// error_reporting(0);


//LOGIN USERS
if(isset($_POST['login'])){

  //assign sent username and password to variables
  $username =$_POST['username'];
  $password =SHA1($_POST['password']);

  //prepare mysql statements and select from db
	$stmt = $conn->prepare("SELECT username, password, role FROM `users` WHERE username=? AND password=?");
	$stmt->bind_param('ss',$username, $password);
	
	if($stmt->execute()){
		$results = $stmt->get_result();
		$num_rows =$results->num_rows;
		$row = $results->fetch_row();
	}

  if($num_rows>0){
	$_SESSION['username'] = $username;
	$_SESSION['role'] = $row[2];
	header("location:dashboard.php");

  }else{
		$_SESSION['msg'] = "Wrong username or password";
		header("location:index.php");
		exit();
  }
}


//ADD STOCK
if(isset($_POST['addStock'])){
	//$productName=$_POST['productName'];
	$productID=$_POST['productID'];
	$newQuantity=$_POST['newQuantity'];
	$restockDate=$_POST['restockDate'];
	$attendant=$_POST['attendant'];

	if(!preg_match('/[0-9]/', $newQuantity)){
		$_SESSION['msg']="Invalid Qunatity Enetered";
			header('location:stock.php');
			exit();
	}

	$stmt = $conn->prepare("insert into stock (productID, quantityStocked, restockDate,attendant ) values (?,?,?,?)");
	$stmt->bind_param('isss', $productID,  $newQuantity, $restockDate, $attendant);
	if($stmt->execute()){
		$_SESSION['msg']="Stock Added Successfully";
			header('location:stock.php');
			exit();

	}else{
		$_SESSION['msg']="Failed to add Stock, Please try again";
			header('location:stock.php');
			exit();
	}

}

//ADD NEW PRODUCT
if(isset($_POST['addProduct'])){
	$productName=$_POST['productName'];
	$description=$_POST['description'];
	$productionCost=$_POST['productionCost'];
	$productPrice=$_POST['productPrice'];
	$sqlFetch = $conn->prepare("select productName from products where productName=?");
	$sqlFetch->bind_param('s',$productName);
	$sqlFetch->execute();
	$sqlFetch->store_result();

	if($sqlFetch->num_rows>0){
	    header('location:products.php?status=1&msg=Product Already Exists');
	    exit();
	      }else {
	        //if product doesnt exit insert it into the db
	      $sql = $conn->prepare("insert into products (productName,description, productionCost, productPrice) values (?,?,?,?)");
	      $sql->bind_param("ssdd", $productName, $description, $productionCost, $productPrice);

	      if($sql->execute()) {
	      		header('location:products.php?status=1&msg=product Added Succesfully');
	      		exit();
	      				} else {
	      		header('location:products.php?status=1&msg=Fail To add products');
	      		exit();
	      				}

	}

}


//ADD SALES
if(isset($_POST['add_single_sales'])){

	$productID=$_POST['productID'];
	$customerName=mysqli_real_escape_string($conn, $_POST['customerName']);
	$quantity=$_POST['quantitySold'];
	$sellingPrice=$_POST['sellingPrice'];
	$amountPaid = $_POST['amountPaid'];
	$date=$_POST['salesDate'];
	$attendant=$_SESSION['username'];
	$custPhoneNo=mysqli_real_escape_string($conn, $_POST['custPhoneNo']);
	$time=$_POST['time'];
	$salesDate= $date.' '.$time;



	//inserting sales
	$sqlInsert = "insert into sales (
	productID, 
	customerName, 
	quantitySold, 
	amountPaid,
	attendant,
	sellingPrice,
	date) values (?,?,?,?,?,?,?)";

	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt,$sqlInsert);
	mysqli_stmt_bind_param($stmt,"sssssss", $productID, $customerName, $quantity, $amountPaid, $attendant, $sellingPrice, $date);
	$result = mysqli_stmt_execute($stmt);


	if($result) {

	?>
	                    <script>
	document.location.href = 'sales.php?status=1&msg=Sales Added Succesfully';
						</script>
	<?php

					} else {
						?>
						<script>

			  document.location.href = 'sales.php?status=2&msg=Sales Not Entered';
						</script>

					<?php
	}
}

//ADD NEW User
if (isset($_POST['addUser'])) {
	  $name = mysqli_real_escape_string($conn, $_POST['name']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$emailAddress =mysqli_real_escape_string($conn, $_POST['emailAddress']);
		$password =$_POST['password'];
		$confirmPassword =$_POST['ConfirmPassword'];
		$department= $_POST['department'];
		$role = strtolower($_POST['role']);

	//validate username and email
		if(!preg_match('/^[a-z`A-Z ]*$/', $name) || !preg_match('/^[a-zA-Z ]*$/', $username)){
			$_SESSION['msg']="Invalid characters in username or Name";
			header('location:users.php?status=1');
			exit();
		}

	//validate email address
	if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
		$_SESSION['msg']="Invalid Email Address";
			header('location:users.php?status=1');
			exit();
	}


//check username if already exists
$sqlselect= $conn->prepare("SELECT username FROM users WHERE username=?");
$sqlselect->bind_param('s',$username);

if($sqlselect->execute()){
	$results = $sqlselect->get_result();
	$num_rows =$results->num_rows;}

if($num_rows>0){
		$_SESSION['msg']= 'Username Already Exists';
		header('location:users.php');
		exit();}

if($password != $confirmPassword){
		$_SESSION['msg']= 'Passwords Miss match';
		header('location:users.php');
		exit();}

if(strlen($password)<6){
		$_SESSION['msg']= 'Password should atleast 6 characters';
		header('location:users.php');
		exit();}


$password = SHA1($password);


$stmt = $conn->prepare("INSERT INTO users (name,username,password,email_address,role,department) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $name, $username, $password,$emailAddress,$role,$department);

 if($stmt->execute()){
	$_SESSION['msg'] = 'User added Succesfully';
 	header('location:users.php');
 	exit();

 }else{
	$_SESSION['msg'] = 'Fail To Add...Try Again';
 	header('location:users.php');
 	exit(); 
}

}

?>
