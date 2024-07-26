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

  <title>Generate Reports</title>

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

  <div class="page-container">



   <?php include('include/leftbar.php')?>



   <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">

        <div class="col-lg-12">

          <h4 class="page-header"> <?php echo strtoupper("reports | "." ".htmlentities($_SESSION['username']));?></h4>

        </div>

        <!-- /.col-lg-12 -->

      </div>

      <!-- /.row -->

      <?php

      include('include/displayMessage.php');?>

      <div class="row">

        <div class="col-lg-12">

          <div class="panel panel-default">

            <div class="panel-heading">

              Generate Reports

            </div>

            <!-- /.panel-heading -->



            <div class="panel-body">



              <div class="list-group">

                <i class="list-group-item list-group-item-action active">Select Report Type</i>

                <a href="" data-toggle="modal" data-target="#SalesReport"  class="list-group-item list-group-item-action">Sales Report</a>

                <a href="" data-toggle="modal" data-target="#modalStock"  class="list-group-item list-group-item-action">Stocks Report</a>


                <a href="productsReport.php" class="list-group-item list-group-item-action">Print Product List</a>

              </div>



              <br/>









              <!-- Sales Modal -->

              <div class="modal fade" id="SalesReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"

              aria-hidden="true">

              <div class="modal-dialog" role="document">

                <div class="modal-content">

                  <div class="modal-header text-center">

                    <h4 class="modal-title w-100 font-weight-bold">Print Sales Report</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                      <span aria-hidden="true">&times;</span>

                    </button>

                  </div>

                  <div class="modal-body mx-3">

                   <form action="salesReport.php" method="post">

                    <div class="'row">

                      <div class="md-form mb-4">

                        <label data-error="wrong" data-success="right" for="defaultForm-pass">From Date</label><br>

                        <input type="date" name="from_date" id="defaultForm-pass" class="form-control validate" max="<?php echo $current_date = date('Y-m-d'); ?>" required>

                      </div>



                      <div class="md-form mb-4">

                        <label data-error="wrong" data-success="right" for="defaultForm-pass">To Date</label><br>

                        <input type="date" name="to_date" id="defaultForm-pass" class="form-control validate" max="<?php echo $current_date = date('Y-m-d'); ?>" required>

                      </div>

                    </div>



                    <div class="modal-footer d-flex justify-content-center">

                      <button type="submit" name="submitDate" class="btn btn-default">Print</button>

                    </div>



                    <!--/div-->

                  </form>



                </div>

              </div>

            </div>

          </div>

<!-- Stock Modal -->

<div class="modal fade" id="modalStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

  <div class="modal-content">

    <div class="modal-header text-center">

      <h4 class="modal-title w-100 font-weight-bold">Print Stock Report</h4>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

      </button>

    </div>

    <div class="modal-body mx-3">

     <form action="stockReport.php" method="post">



      <div class="md-form mb-4">

        <div class="'row">

          <div class="md-form mb-4">

            <label data-error="wrong" data-success="right" for="defaultForm-pass">From Date</label><br>

            <input type="date" name="from_date" id="defaultForm-pass" class="form-control validate" max="<?php echo $current_date = date('Y-m-d'); ?>" required>

          </div>



          <div class="md-form mb-4">

            <label data-error="wrong" data-success="right" for="defaultForm-pass">To Date</label><br>

            <input type="date" name="to_date" value = "" id="defaultForm-pass" class="form-control validate" max="<?php echo $current_date = date('Y-m-d'); ?>" required>

          </div>

        </div>

      </div>



    </div>

    <div class="modal-footer d-flex justify-content-center">

      <button type="submit" name="submit" class="btn btn-default">Print</button>

    </div>

  </form>

</div>

</div>

</div>




</div>

<!-- /.panel -->



</div>

<!-- /.col-lg-12 -->



</div>

<!-- /.row -->







</div>

<!-- /#page-wrapper -->



</div>



</div>
<?php include('include/footer.php');?>

</div>


</body>



</html>

