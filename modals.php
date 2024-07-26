<script type="text/javascript">
   $(document).ready(function(){
        $('#salesDate').val("<?php echo date('Y-m-d');?>")

        $(".input").keyup(function(){
              var quantitySold = +$(".quantity").val();
              var sellingPrice = +$(".sellingPrice").val();
              var totalAmount = sellingPrice*quantitySold;
              $(".totalAmount").val(totalAmount);
        });
    });

    function setProductDetails(id) {
        let select  = document.getElementById('productDetails'+id)
        let cost    = document.getElementById('productionCost')
        let price   = document.getElementById('sellingPrice')

        let costAmount  = select.getAttribute('data-cost');
        let priceAmount = select.getAttribute('data-price');

        cost.value  = costAmount
        price.value = priceAmount
    }

    $(document).ready(function(){
            $('#salesDate').val("<?php echo date('Y-m-d');?>")

            $(".input").keyup(function(){
          var quantitySold = +$(".quantity").val();
          var sellingPrice = +$(".sellingPrice").val();
          var totalAmount = sellingPrice*quantitySold;

        $(".totalAmount").val(totalAmount);

      });
        });
</script>


<!--logout Modal--> 
<div class="modal fade" id="Logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header text-center">
      <h4 class="modal-title w-100 font-weight-bold">Logout</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-3">
      <form action="logout.php" method="POST">
        <div class="md-form mb-5">Are You Sure You exit?</div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" name="submit" class="btn btn-default">Logout</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<!--Add New User Modal--> 
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header text-center">
      <h4 class="modal-title w-100 font-weight-bold">Add New User</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-3">
      <form action="phpProcessor.php" method="POST">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" >Name</label>

          <input  type="text" name="name" value=""  class="form-control validate" required>
        </div>

        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" >Username</label>

          <input  type="text" name="username"  class="form-control validate" required>
        </div>


        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>

          <input type="text" name="password" placeholder="minimum 6 characters" value = "" id="defaultForm-pass" class="form-control validate" required>
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Confirm Password</label>

          <input type="text" name="ConfirmPassword" placeholder="Renter password" value = "" id="defaultForm-pass" class="form-control validate" required>
        </div>


        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Email Address</label>

          <input type="text" name="emailAddress" value = "" id="defaultForm-pass" class="form-control validate" required>
        </div>

        <input type="hidden" name="department" value = "duka" id="defaultForm-pass" class="form-control validate">


        <div class="form-group">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Select Role (select one):</label>
          <select class="form-control"  name="role" required>
            <option>Admin</option>
            <option>User</option>
          </select>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" name="addUser" class="btn btn-primary">Add User</button>
      </div>
    </form>
  </div>
</div>
</div>

<!--Enter Sale Modal--> 
<div class="modal fade" id="enterSale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header text-center">
      <h4 class="modal-title w-100 font-weight-bold">Enter Sale</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-3">
      <form method="POST" action = "phpProcessor.php" >
        <input type="hidden" name="time" value="<?php echo date("h:i:s")?>">

        <div class="row">
          <div class="col-lg-6">
            <label>Customer Name</label>
          </div>
          <div class="col-lg-6">
            <label>Phone Number</label>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" placeholder="Customer's Name" class="form-control" value="" name="customerName">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" class="form-control" value="" name="custPhoneNo"  maxlength="10" >

              
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <label>
              Product Name
            </label>
          </div>
          <div class="col-lg-6">
            <label>Cost(Unit)<span style="color:red">*</span></label>
          </div>

        </div>

        <div class="row">
          <div class="form-group">
            <div class="col-lg-6">

              <select name="productID" id="products" class="form-control products" required onchange="setProductDetails(this.value)">
                <option>-Product Name-</option>

                <?php
                $productDetails = mysqli_query($conn, 'SELECT * FROM products');
                while ($data = mysqli_fetch_array($productDetails)) { ?>
                  <option id="productDetails<?php echo $data['productID'];?>" value="<?php echo $data['productID'];?>" data-price="<?php echo $data['productPrice'];?>" data-cost="<?php echo $data['productionCost'];?>"> <?php echo $data['productName'];?></option>
                <?php } ?>

              </select>

            </div>
          </div>  
          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" class="form-control productionCost" name="productionCost" id="productionCost" required>
                      </div>
          </div>          
        </div>

        <div class="row">
          <div class="col-lg-6">
            <label>Selling Price <span style="font-size:11px;color:red">*</span>  </label>
          </div>
          <div class="col-lg-6">
            <label> Quantity(Units)<span  style="font-size:11px;color:red">*</span></label>
          </div>
          
        </div>

        <div class="row">

          <div class="col-lg-6">

            <div class="form-group">
              <input type="text" placeholder="selling Price"  name="sellingPrice" class="form-control input sellingPrice" id ="sellingPrice">
            </div>
          </div>
          <div class="col-lg-6">

            <div class="form-group">

              <input type="text"  name="quantitySold" class="form-control input quantity" 
              id="quantity">
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-6">
            <label> Total Amount
              <span style="color:red">*</span></label>
            </div>

            <div class="col-lg-6">
              <label>Sales Date</label>
            </div>
          </div>

          <div class="row">


            <div class="col-lg-6">


              <div class="form-group">

                <input type="text" name="amountPaid" class="form-control input totalAmount" id="totalAmount" value="" readonly>
              </div>
            </div>

            

            <div class="col-lg-6">
              <div class="form-group">

                <input type="date" id="salesDate" name="salesDate" class="form-control datepicker" max="<?php echo $current_date = date('Y-m-d'); ?>" >

              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-center">
          <input type="submit" class="btn btn-success" name="add_single_sales" value="Enter Sales">
          <input type="reset" class="btn btn-primary" name="" value="Clear">
        </div>
      </form>
    </div>
  </div>
</div>


<!--Add products Modal-->	
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header text-center">
      <h4 class="modal-title w-100 font-weight-bold">Add New Product</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-3">
     <form action="phpProcessor.php" method="POST">
      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" >Product Name</label>
        <input type="text" name="productName" class="form-control validate">
      </div>

      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" >Description</label>
        <input type="text" name="description" class="form-control validate">
      </div>

      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" for="defaultForm-email">Production Cost</label>
        <input  type="text" name="productionCost" class="form-control validate">
      </div>

      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" for="defaultForm-email">Price</label>
        <input  type="text" name="productPrice" class="form-control validate">
      </div>

    </div>
    <div class="modal-footer d-flex justify-content-center">
      <button type="submit" name="addProduct" class="btn btn-default">Add Product</button>
    </div>
  </form>
</div>
</div>
</div>

<!--Add Stock Modal-->	
<div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header text-center">
      <h4 class="modal-title w-100 font-weight-bold">Add Stock</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-3">
     <form action="phpProcessor.php" method="POST">
      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right">Product Name</label>

        <select name="productID" id="products" class="form-control">
          <option value="0">-Product Name-</option>

          <?php
          $goods = mysqli_query($conn, 'SELECT * FROM products');
          while ($data = mysqli_fetch_array($goods)) { ?>
            <option value="<?php echo $data['productID'];?>"> <?php echo $data['productName']; ?> </option>
          <?php } ?>

        </select>
      </div>


      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" >Quantity</label>

        <input  type="text" name="newQuantity" min="1" class="form-control validate">
      </div>
      <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" for="defaultForm-email">Attendant</label>

        <input  type="text" name="attendant"  value="<?php echo strtoupper($_SESSION['username'])?>" class="form-control validate" readonly>
      </div>


      <div class="md-form mb-4">
        <label data-error="wrong" data-success="right" for="defaultForm-pass">Date</label>

        <input type="date" name="restockDate" value = "" id="defaultForm-pass" class="form-control validate" max="<?php echo $current_date = date('Y-m-d'); ?>">
      </div>

    </div>
    <div class="modal-footer d-flex justify-content-center">
      <button type="submit" name="addStock" class="btn btn-default">Add Stock</button>
    </div>
  </form>
</div>
</div>
</div>

<!--Change Passowrd Modal-->	
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Change User Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form method="POST" action="change_password.php" >


          <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" >Current Password</label>

            <input  type="password" name="currentPassword" id="currentPassword" class="form-control validate">
          </div>


          <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-pass">New Password</label>

            <input type="password" name="newPassword" value = "" id="newPassword" class="form-control validate">
          </div>


          <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-pass">Confirm Password</label>

            <input type="password" name="confirmPassword" value = "" id="confirmPassword" class="form-control validate">
          </div>

          <div class="modal-footer d-flex justify-content-center">
            <button type="submit" name="submit" class="btn btn-default">Change Password</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 





