<?php
if(isset($_SESSION['msg'])){
    ?>
 <div class="col-lg-12">
    <div class="alert alert-success">
                <?php echo $_SESSION['msg']; unset($_SESSION['msg']) ?>
    </div>
</div>

    <?php

}elseif(isset($_SESSION['error_msg'])){
 ?>
 <div class="col-lg-12">
    <div class="alert alert-danger">
                <?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']);?>
    </div>
</div>

    <?php
}
?>