<?php
session_start();
include('include/databaseConnection.php');
include('include/checkLogin.php');
check_login();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product</title>

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
<?php
include('modals.php');

?>
<!-- Edit Product Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Edit Product Details</h4>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>

	<!-- Del Product Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Delete Product Details</h4>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>

 <!-- Navigation -->
 <?php include('include/leftbar.php');?>

    <div id="wrapper">
       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <h4 class="page-header"> <?php echo strtoupper(" Product Records |" ." ".htmlentities($_SESSION['username']));?></h4>
                </div>
            </div>




                        <ul class="nav nav-tabs">
                        <li class="active"><a href="products.php">Product List</a></li>
                            <li><a href="stock.php">Add Stock</a></li>

                        </ul>

<br/>
<div class="row">
<?php
include('include/displayMessage.php')
?>

   <div class="col-lg-12">

                    <div class="panel panel-default" >
                        <div class="panel-heading">

						<b style="font-size:15px;">  PRODUCTS</b>
												<div style="float:right;">
<button class="btn btn-primary button1" data-toggle="modal" data-target="#addProduct">
<i class="glyphicon glyphicon-plus-sign"></i> Add Product</button>
</div>
 <br>
 <br>
						</div>


                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="product-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
											<th>Product ID</th>
											<th>Product</th>
                                            <th>Description</th>
                                            <th>Production cost</th>
											<th>Product Price</th>
											<th>Available Quantity(Units)</th>
											<?php if($_SESSION['role']=='admin'){
											echo'<th>Edit</th>';
											echo'<th>Delete</th>';}?>

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
 $result = mysqli_query($conn, 
    "select 
    products.productID, 
    products.productName, 
    products.description, 
    products.productPrice, 
    products.productionCost, 
    coalesce((select sum(quantityStocked) from stock where stock.productID=products.productID),0)-coalesce((select sum(quantitySold)
 from sales where sales.productID=products.productID),0) as qty from products");
$count = 1;
 while ($row = mysqli_fetch_assoc($result)):
        echo '<tr>';
           echo '<td>'.$count.'</td>';
           echo '<td>'.strtoupper($row['productName']).'</td>';
           echo '<td>'.strtoupper($row['description']).'</td>';
           echo '<td>'.number_format($row['productionCost'],0).'</td>';
           echo '<td>'.number_format($row['productPrice'],0).'</td>';
           
           echo '<td>'.$row['qty'].'</td>';
		   if($_SESSION['role']=='admin'){
           echo '<td>
                    <a class="btn btn-small btn-primary"
                       data-toggle="modal"
                       data-target="#exampleModal"
                       data-whatever="'.$row['productID'].' ">Edit</a>
    </td>';
					  echo '<td>
                    <a class="btn btn-small btn-danger"
                       data-toggle="modal"
                       data-target="#delModal"
                       data-whatever="'.$row['productID'].' ">Del</a>
		   </td>';}

        echo '</tr>';
        $count++;
     endwhile;

?>





                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            <!--/div-->
			</div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
<?php include('include/footer.php');?>


</body>
<!--function to call table-->
<script>
$(document).ready(function(){
	var table = $('#product-table').DataTable();
});


$('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editProducts.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    });

	$('#delModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "delProducts.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    });


		</script>
</html>
