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
                                <h2>ประวัติรายการสินค้าที่ลูกค้าสั่ง (หลังร้าน)</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                      <?php
                      $show=image_asset('icon/show.png');

                      //<!-- Form code begins -->
                    echo form_open('sell/history');
                      ?>
                        <div class="row">
                          <div style="-webkit-flex-basis: 0;float:left;margin-left:20px;">
                            <label class="control-label" for="date">วันที่เริ่มต้น</label>
                            <input class="form-control" id="Startdate" name="Startdate"  placeholder="MM/DD/YYY" style="width:200px;" type="text"/>
                          </div>
                          <div style="-webkit-flex-basis: 0;float:left;margin-left:20px;">
                            <label class="control-label" for="date">วันทีสิ้นสุด</label>
                            <input class="form-control" id="Enddate" name="Enddate" placeholder="MM/DD/YYY" style="width:200px;" type="text"/>
                          </div>
                          <button class="btn btn-primary" style="margin-top:26px;margin-left:15px;" name="submit" id="submit" type="submit">Submit</button>
                        </div>
                      </form>
                       <!-- Form code ends -->

                       <br>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>ลูกค้าที่ซื้อ</th>
                                <th>ราคาทั้งหมด</th>
                                <th>สถานะการชำระเงิน</th>
                                <th>ประเภทการขาย</th>
                                <th>พนักงานที่ขาย</th>
                                <th>วันที่ขายสินค้า</th>
                                <th>เวลาที่ขายสินค้า</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                              $num=1;
                              foreach($product_sell as $pro_sell){
                                if($pro_sell['sell_type'] == '1'){
                                  $type = 'หลังร้าน (เงินสด)';
                                }else if($pro_sell['sell_type'] == '2'){
                                  $type = 'หลังร้าน (เงินเชื่อ)';
                                }else if($pro_sell['sell_type'] == '3'){
                                  $type = 'หลังร้าน (อะไหล่ซ่อม)';
                                }
                                echo "<tr>";
                                  echo "<td>",$num,"</td>";
                                  echo "<td>",$pro_sell['cus_name'],"</td>";
                                  echo "<td>",$pro_sell['pay_status'],"</td>";
                                  echo "<td>",$pro_sell['sell_status'],"</td>";
                                  echo "<td>",$type,"</td>";
                                  echo "<td>",$pro_sell['emp_name'],"</td>";
                                  echo "<td>",$pro_sell['sell_date'],"</td>";
                                  echo "<td>",$pro_sell['sell_time'],"</td>";
                                  echo "<td><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#showHis' id='idShowHistory' onclick='showHistoryAjax(",$pro_sell['sell_order_id'],")'>",$show,"</button></td>";
                                echo "</tr>";
                                $num++;
                              }
                            ?>
                          </tbody>
                      </table>
                      <?php
                      echo "</div>";
                      ?>
                      <!-- Start Detail His -->
                      <div class="modal fade" id="showHis" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#336699;">
                                <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                <h4 class="modal-title" style="text-align:center;">รายละเอียดที่ลูกค้าสั่ง</h4>
                              </div>
                              <div class="modal-body" id='data'>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" id='mdCloseCus' data-dismiss="modal">CLOSE</button>
                              </div>
                            </div>

                          </div>
                        </div>
                      <!-- End Detail His -->
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

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.categories.js"></script>-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/morris.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</head>
</body>
</html>
<script>
function showHistoryAjax (idShow){
    var idShow = idShow;
    $("#showHis").click();
    $.ajax({
      url: "<?php echo base_url() ?>sell/history_detail/",
      type: "POST",
      data: {
        "idShow" : idShow
      },
      dataType: 'json',
      success: function(data){
        $.each(data,function( key, value ){
          $("#data").append("ชื่อสินค้า : ",value.sell_detail_name," : ");
          $("#data").append(" จำนวน ",(addCommas(value.sell_detail_amount)),"  * ");
          var debtor = value.sell_detail_type;
          if(debtor == '2'){
              $("#data").append(" ",(addCommas(value.sell_detail_pricePay))," :: ");
              $("#data").append(" รวมราคา ",addCommas((value.sell_detail_pricePay * value.sell_detail_amount)),"</p>");
          }else{
            $("#data").append(" ",(addCommas(value.sell_detail_price))," :: ");
            $("#data").append(" รวมราคา ",addCommas((value.sell_detail_price * value.sell_detail_amount)),"</p>");
          }
        })
      },
      error: function(){
        alert('Error....');
        $("#mdCloseCus").click();
      }
    });
}

$(document).ready(function(){
    $('#example').DataTable( {
      "order": [[ 0, "desc" ]]
    } );

    $(".modal").on("hidden.bs.modal", function(){
      $(".modal-body").html("");
    });

    /*$("#submit").click(function (){
        var StartDate = $("#Startdate").val();
        var EndDate  = $("#Enddate").val();
        $.ajax({
          url: "<?php echo base_url() ?>sell/history",
          type: "POST",
          data: {
            "StartDate" : StartDate,
            "EndDate" : EndDate
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("เพิ่มข้อมูลผู้ใช้สำเร็จ");
              //$("#mdCloseCus").click();
              location.reload();
          },
          error: function(){
            alert('Error....');
            //$("#mdCloseCus").click();
          }
        });
        //$("#Startdate").val(StartDate);
    })*/

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
