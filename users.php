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

    <title>Users</title>

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
    <!-- Edit User Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="memberModalLabel">Edit User Details</h4>
                </div>
                <div class="dash">
                   <!-- Content goes in here -->
               </div>
           </div>
       </div>
   </div>	

   <!-- Del Users Modal -->
   <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Delete User Details</h4>
            </div>
            <div class="dash">
               <!-- Content goes in here -->
           </div>
       </div>
   </div>
</div>	
<div id="wrapper">

    <?php 
            //Navigation
    include('include/leftbar.php');

    		//modals 
    include('modals.php');
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
             <h4 class="page-header">  
                <?php echo strtoupper("Users |"." ".htmlentities($_SESSION['username']));?>
            </h4>
        </div>
    </div>

    <div class="row">

        <?php
        include('include/displayMessage.php')
        ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manager Users
                    <button style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#addUser"> 
                        <i class="glyphicon glyphicon-plus-sign"></i> Add User  </button><br><br>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper table-responsive">
                            <table id="user-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Del</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $result = mysqli_query($conn, "select * from users");
                                  $count = 1;
                                  while ($row = mysqli_fetch_assoc($result)):
                                    echo '<tr>';
                                    echo '<td>'.$count.'</td>';
                                    echo '<td>'.strtoupper($row['name']).'</td>';
                                    echo '<td>'.strtoupper($row['username']).'</td>';
                                    echo '<td>'.strtoupper($row['role']).'</td>';
                                    echo '<td>
                                    <a class="btn btn-small btn-primary"
                                    data-toggle="modal"
                                    data-target="#exampleModal"
                                    data-whatever="'.$row['userID'].' ">Edit</a>
                                    </td>';
                                    echo '<td>
                                    <a class="btn btn-small btn-danger"
                                    data-toggle="modal"
                                    data-target="#delModal"
                                    data-whatever="'.$row['userID'].' ">Del</a>
                                    </td>';

                                    echo '</tr>';
                                    $count++;
                                endwhile;?>

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



</div>
<!-- /#page-wrapper -->

</div>

<?php include('include/footer.php')?>

<script>
    $(document).ready(function(){
       var table = $('#user-table').DataTable();
   });

    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

          $.ajax({
            type: "GET",
            url: "editUsers.php",
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
            url: "delUsers.php",
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
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });

    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
  }

  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
  }
</script>

</body>

</html>
