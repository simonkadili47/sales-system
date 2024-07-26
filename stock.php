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

    <title>view Stock record</title>
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

<!-- Edit Stock Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Edit Stock Details</h4>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>

	<!-- Del Stock Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Delete Stock Details</h4>
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
                   <h4 class="page-header"> <?php echo strtoupper("STOCK RECORDS |" ." ".htmlentities($_SESSION['username']));?></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
						
			  <ul class="nav nav-tabs">
                    <li><a href="products.php">Product List</a></li>
                    <li  class="active"><a href="updateStock.php">Add Stock</a></li>
              </ul>

<br/>


<div class="row">
<?php
include('include/displayMessage.php')
?>
<div class="col-lg-12">
						<br>
          <?php  $todayDate = date("Y-m-d");
?>
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                       <b style="font-size:15px; font-family:Times New Roman, Times, serif;">STOCK RECORD</b>
		   <div style="float:right;">
<button class="btn btn-primary button1" data-toggle="modal"  data-target="#addStock">
<i class="glyphicon glyphicon-plus-sign"></i> Enter Stock </button>
</div> <br><br>

				                       </div>


                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table id="stock-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>


										    <th>Stock ID</th>
											<th>Product Name</th>
											<th>Quantity Stocked</th>
											<th>Restock Date</th>
											<th>Attendant</th>
											<?php if($_SESSION['role']=='admin'){
											echo'<th>Edit</th>';
											echo'<th>Delete</th>';}?>

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$result = mysqli_query($conn,"select stock.stockID, format(quantityStocked,2), stock.restockDate, stock.attendant,
products.productName   from stock   inner join products on stock.productID = products.productID" );

	while ($row = mysqli_fetch_assoc($result)):
        echo '<tr>';
           echo '<td>'.$row['stockID'].'</td>';
           echo '<td>'.strtoupper($row['productName']).'</td>';
           echo '<td>'.$row['format(quantityStocked,2)'].'</td>';
           echo '<td>'.$row['restockDate'].'</td>';
           echo '<td>'.strtoupper($row['attendant']).'</td>';
if($_SESSION['role']=='admin'){
           echo '<td>
                    <a class="btn btn-small btn-primary"
                       data-toggle="modal"
                       data-target="#exampleModal"
                       data-whatever="'.$row['stockID'].' ">Edit</a>
    </td>';
					  echo '<td>
                    <a class="btn btn-small btn-danger"
                       data-toggle="modal"
                       data-target="#delModal"
                       data-whatever="'.$row['stockID'].' ">Del</a>
</td>';}

        echo '</tr>';
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
            </div>
            <!-- /.row -->
<!--a href="stock_report.php">
<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary">
<i class="fa fa-pdf" aria-hidden="true"></i>PRINT FILE</button>
</a-->


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
<?php include('include/footer.php');?>
 

</body>
<!--function to call table-->
<script>$(document).ready(function(){
	var table = $('#stock-table').DataTable();
});


$('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editStock.php",
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
                url: "delStock.php",
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
