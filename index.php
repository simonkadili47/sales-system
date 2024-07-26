    <?php
        session_start();
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Shop Management System</title>

        <!-- Bootstrap Core CSS -->
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
        

    </head>

    <body>

        <div class="container">
            <br><br><br><br>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Shop Management System</h3>
                    </div>
                    <div class="panel-body">
                        <p>sign in<b><i class="text-primary">
                        <?php
                         if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></i></b></p>
                        <form method="POST" action="phpProcessor.php">
                            <fieldset>
                                <div class="form-group">
                                   <input class="form-control" placeholder="Username" required id="username"name="username" type="text" autofocus autocomplete="off">
                               </div>
                               <div class="form-group">
                                <input class="form-control" required placeholder="Password" id="password"name="password" type="password">
                            </div>                       
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" value="login" name="login" class="btn btn-lg btn-primary btn-block">
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../dist/jquery-1.3.2.js" type="text/javascript"></script>
<script src="../dist/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">

</script>
</body>

</html>
