
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <h1 class="text-center" style="margin-top:100px;">ใบสั้งชื่อสินค้า</h1>
        <form action="<?php echo base_url('order/add');?>" method="POST" role="form" >
             <p class="error" style="text-align: center;"> </p>  
             
            <table class="table table-bordered  ">
            <thead class="bg-success">
              <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ยีห้อ</th>
                <th style="text-align: center;">จำนวน</th>
              </tr>
            </thead>
              <tbody>
               <?php 
               
               
               $i=0;  foreach ($rs as $product) {?>   
                <tr>
                  <td width="20%">                                                          
                             <input type="text" class="form-control" id="product_id" name="product_id[]"  class="form-control" value="P<?php   echo $product['product_id'] ?>" disabled  >
                              <input type="hidden" class="form-control" id="product_id" name="product_id[]"  class="form-control" value="<?php   echo $product['product_id'] ?>"   >
                   </td>
        
                   <td width="40%">
                            <input type="text" class="form-control" id="product_name" name="product_name[]" placeholder="Input field" value="<?php  echo $product['product_name']; ?>" disabled  >
                            <input type="hidden" class="form-control" id="product_name" name="product_name[]" placeholder="Input field" value="<?php  echo $product['product_name']; ?>"   >

                  </td>
                  <td>
                   <input type="text" class="form-control"  class="form-control" value="<?php   echo $product['band_name'] ?>" disabled  >
                   <input type="hidden" class="form-control" id="product_type" name="product_type[]" placeholder="Input field" value="<?php  echo $product['band_name']; ?>"   >
                   </td>
                  <td width="20%">
                      <div class="row">
                      <div class="col-md-5" >
                            <input type="number" class="form-control " name="product_amount[]" id="product_amount<?php echo $i; ?>" placeholder="จำนวน" min="0" value="0" style="text-align: right; width:200px;" onchange="check_amount()">
                      </div>
                      <div class="col-md-5" >
                          
                      </div>
                      </div>
                  </td>
                 
                </tr>
                 
                 <input type="hidden" name="number"  id='number' class="form-control" value="<?php echo count($rs); ?>">
                <?php $i++;} ?>
              </tbody>
              
            </table>
             <button type="submit" id="submit_dis" class="btn btn-success" style="float: right;font-size: 15px;" disabled > บันทึก</button>

           
         </form>

        </div>
    </div>
</div>
</div><input type="hidden" name="number_check"  id='number_check' class="form-control" value="<?php echo count($rs); ?>">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<script>
function check_amount() {

  var test = [];
	var amount_count = $("#number_check").val();
	var check_con = 0;
	for (var i = 0; i < amount_count; i++) {
		if ($("#product_amount" + i).val() != 0) {
      $('#submit_dis').removeAttr("disabled");
      check_con++;
    }
  }
  if( check_con == 0 ){
    $('#submit_dis').prop("disabled", true);
  }


}



</script>