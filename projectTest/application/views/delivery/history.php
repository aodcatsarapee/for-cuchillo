<html>
<head>
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<style type='text/css'>
  .warring{background-color:#FFFF99;color:red;}
  .thcenter th{
    text-align:center;
  }
</style>
</head>
<body>
<section class="content">
    <div class="container-fluid">
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>บันทึกข้อมูลการส่งสินค้า</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                      <?php
                         $show=image_asset('icon/show.png');

                       echo form_open('delivery/history'); ?>
                        <div class="row clearfix">
                          <div class="col-sm-3">
                            <label class="control-label" for="date">วันที่เริ่มต้น</label>
                            <input class="form-control" id="Startdate" name="Startdate"  placeholder="MM/DD/YYY" style="width:200px;" type="text"/>
                            <input class="form-control" id="Startdate_hide" name="Startdate_hide" value="<?php //echo $time['Startdate']; ?>" type="hidden"/>
                          </div>

                          <div class="col-sm-3">
                            <label class="control-label" for="date">วันทีสิ้นสุด</label>
                            <input class="form-control" id="Enddate" name="Enddate" placeholder="MM/DD/YYY" style="width:200px;" type="text"/>
                            <input class="form-control" id="Enddate_hide" name="Enddate_hide" value="<?php //echo $time['Enddate']; ?>" type="hidden"/>
                          </div>

                          <div class="col-sm-3">
                            <input type='submit' style="margin-top:24px;" id='Serach' value='Serach' class="btn btn-primary">
                          </div>
                        </div>
                      </form>
                      <br>
                      <div class="alert alert-info" style='width:400px;'>
                         <strong>วันที่เริ่มต้น : </strong> <?php echo $Start; ?><strong> วันที่สิ้นสุด : </strong> <?php echo $End; ?>
                     </div>
                      <br>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>รหัส Order</th>
                                <th>ชื่อ - นามสกุล ผู้รับสินค้า</th>
                                <th>ที่อยู่ผู้รับสินค้า</th>
                                <th>เบอร์โทรศัพท์ผู้รับสินค้า</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            $num=1;
                            foreach($delivery as $_delivery){
                                echo "<tr>";
                                  echo "<td>".$num."</td>";
                                  echo "<td>".$_delivery['sell_order_id']."</td>";
                                  echo "<td>".$_delivery['member_firstname']." ".$_delivery['member_lastname']."</td>";
                                  echo "<td>".$_delivery['member_address']."</td>";
                                  echo "<td>".$_delivery['member_tel']."</td>";
                                  echo "<td><button class='btn bg-light-blue waves-effect' onclick='showHistoryAjax(",$_delivery['sell_order_id'],")' data-toggle='modal' data-target='#showHis'>DETAIL</button></td>";
                                echo "</tr>";
                                $num++;
                            }
                            ?>
                          </tbody>
                      </table>

                      <?php
                      echo "</div>";
                       ?>
                       <!-- Start change Delivery -->
                       <div class="modal fade" id="changeDelivery" role="dialog">
                           <div class="modal-dialog">

                             <!-- Modal content-->
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">สถานะการส่งสินค้า</h4>
                               </div>
                               <div class="modal-body">

                                 <?php
                                 echo form_open('delivery/change_status/'.$_delivery['sell_order_id']);  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
                                 echo "<div class='form-group'>";
                                   echo "<label for='position'>สถานะ : </label>";
                                   echo "<select class='form-control' id='Status' name='Status' style='height:34px;'>";
                                     echo "<option value='2'>จัดส่งเรียบร้อย</option>";
                                   echo "</select>";
                                 echo "</div>";
                                 ?>

                                 <span style='padding-left:400px;'></span>
                               </div>
                               <div class="modal-footer">
                                 <?php
                                 echo "<input type='submit' class='btn btn-success' value='Change' name='saveProduct1' id='saveProduct1'>";
                                 echo form_close();
                                 ?>
                               </div>
                             </div>

                           </div>
                         </div>
                       <!-- End change Delivery -->

                       <!-- Start Edit Cus -->
                       <div class="modal fade" id="showHis" role="dialog">
                           <div class="modal-dialog">

                             <!-- Modal content-->
                             <div class="modal-content">
                               <div class="modal-header" style="background-color:#336699;">
                                 <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                 <h4 class="modal-title" style="color:white;">ข้อมูลการส่งสินค้า</h4>
                               </div>
                               <div class="modal-body">
                                 <table class='table table-striped table-bordered' cellspacing='0' width='100%'>
                                   </head>
                                   <tr>
                                     <th>ชื่อสินค้า</th>
                                     <th>ราคาต่อชิ้น</th>
                                     <th>จำนวน</th>
                                     <th>ราคารวม</th>
                                   </tr>
                                   </thead>
                                   <tbody id='data'>
                                   </tbody>
                                 </table>
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-success" id='mdCloseCus' data-dismiss="modal">CLOSE</button>
                               </div>
                             </div>

                           </div>
                         </div>
                       <!-- End Add Cus -->
                    </div>
              </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>

<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.categories.js"></script>-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/morris.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</head>
</body>
</html>
<script>
function addCommas(nStr)
{
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}


function showHistoryAjax (idShow){
    var idShow = idShow;
    $.ajax({
      url: "<?php echo base_url() ?>delivery/detail/",
      type: "POST",
      data: {
        "idShow" : idShow
      },
      dataType: 'json',
      success: function(data){
        var sumtotal = 0;
        $.each(data,function( key, value ){
          var total = value.sell_detail_amount * value.sell_detail_price;
          sumtotal = sumtotal + total;
          $("#data").append('<tr><td>' + value.sell_detail_name + '</td><td>' + addCommas(parseFloat(value.sell_detail_price).toFixed(2)) + ' บาท</td><td>' + value.sell_detail_amount + ' ชิ้น</td><td>' + addCommas((total).toFixed(2)) + ' บาท</td></tr>');
        })
          $("#data").append('<tr><td id=sumtotal colspan=4>รวมทั้งหมด ' + addCommas((sumtotal).toFixed(2)) + ' บาท</td></tr>');
          $("#sumtotal").css('text-align','right');
      },
      error: function(){
        alert('Error....');
        $("#mdCloseCus").click();
      }
    });
  }


$(document).ready(function(){
  $('#example').DataTable();

  $(".modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("");
  });

  var date_input=$('input[name="Startdate"]'); //our date input has the name "date"
  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
  var options={
    format: 'yyyy-mm-dd',
    container: container,
    todayHighlight: true,
    autoclose: true,
  };
  date_input.datepicker(options);

  var date_input=$('input[name="Enddate"]'); //our date input has the name "date"
  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
  var options={
    format: 'yyyy-mm-dd',
    container: container,
    todayHighlight: true,
    autoclose: true,
  };
  date_input.datepicker(options);

});
</script>
