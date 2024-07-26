<?php
//error_reporting(0);
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

    <title>view sales record</title>

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
	<!-- Edit sales Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Edit Sales Details</h4>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>

	<!-- Del Sales Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Delete Sales Details</h4>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>




    <div id="wrapper">
<?php
     include('include/leftbar.php');
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
      <h4 class="page-header"> <?php echo strtoupper("SALES | "." ".htmlentities($_SESSION['username']));?></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Today's Total Sales</strong></div>
				<div class="panel-body">
<a href="#" style="height:50px; width:100%; border-radius:0px;   box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
" class="btn btn-success btn-lg btn-block btn-huge">
			Tzs <?php
			$date=date("Y-m-d");
			$salesQuery = mysqli_query($conn, "select sum(amountPaid) from sales where date='$date'");
			$resultsales = mysqli_fetch_array($salesQuery);
			echo number_format($resultsales[0],2);
						?></a>
				</div>
			</div>
		</div>

</div>

<?php

include('include/displayMessage.php');

?>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Sales
                    <button style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#enterSale"> 
                        <i class="glyphicon glyphicon-plus-sign"></i> Enter Sale  </button><br><br>                        </div>

  <div class="panel-body">

							<br/>
                            <div class="dataTable_wrapper table-responsive">
                                <table  id="sales-table" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Production Cost</th>
                                            <th>Selling Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
											<th>Profit</th>
                                           
                                            <th>Date</th>
											<?php if($_SESSION['role']=='admin'){
											echo'<th>Edit</th>';
											echo'<th>Delete</th>';}?>


                                        </tr>
                                    </thead>
                                    <tbody>


										<?php

  $todayDate = date("Y-m-d");


    $query= "select salesID, customerName, sellingPrice*quantitySold as totalAmount, sellingPrice, quantitySold, date,
    (select productName from products where products.productID = sales.productID) as productName,
    (select productionCost from products where products.productID = sales.productID) as productionCost
    from sales";

	$result = mysqli_query($conn, $query);
    $count = 1;

		while ($row = mysqli_fetch_assoc($result)):
        echo '<tr>';
           echo '<td>'.$count.'</td>';
           echo '<td>'.strtoupper($row['customerName']).'</td>';
           echo '<td>'.strtoupper($row['productName']).'</td>';
           echo '<td>'.number_format($row['productionCost'],0).'</td>';
           echo '<td>'.number_format($row['sellingPrice'],0).'</td>';
           echo '<td>'.number_format($row['quantitySold'],0).'</td>';
           echo '<td>'.number_format($row['totalAmount'],0).'</td>';
           echo '<td>'.number_format(($row['sellingPrice']-$row['productionCost'])*$row['quantitySold'],0).'</td>';
           
           echo '<td>'.$row['date'].'</td>';
		    if($_SESSION['role']=='admin'){

          echo '<td>
                    <a class="btn btn-small btn-primary"
                    
                       data-toggle="modal"
                       data-target="#exampleModal"
                       data-whatever="'.$row['salesID'].' ">Edit</a>
    </td>';
					  echo '<td>
                    <a class="btn btn-small btn-danger"
                       data-toggle="modal"
                       data-target="#delModal"
		data-whatever="'.$row['salesID'].' ">Del</a>
		   </td>';}else{
            echo '<td>
                    <a class="btn btn-small btn-primary disabled"
                    
                       data-toggle="modal"
                       data-target="#exampleModal"
                       data-whatever="'.$row['salesID'].' ">Edit</a>
    </td>';
                      echo '<td>
                    <a class="btn btn-small btn-danger disabled"
                       data-toggle="modal"
                       data-target="#delModal"
        data-whatever="'.$row['salesID'].' ">Del</a>
           </td>';
           }

        echo '</tr>';
        $count++;
     endwhile;

?>

                                    </tbody>
                                </table>
								<!-- Del sales Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Delete sales Details</h4>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>

								      </div>


                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-12 -->

            </div>

</div>
            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->
    </div>

		</div>

 
			 <script>
			 $(document).ready(function(){
	var table = $('#sales-table').DataTable();
});
			$('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editSales.php",
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
                url: "delSales.php",
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

<?php include('include/footer.php');?>


</body>
</html>
