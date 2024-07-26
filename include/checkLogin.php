<?php
function check_login()
{
 if(!isset($_SESSION['username']) and !isset($_SESSION['role']) ){
 header("Location:index.php");}
}
?>