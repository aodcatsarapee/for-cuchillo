<html>
<head>
<title>ระบบจัดการร้าน สถิตพรอะไหล่ : ข้อมูลรถยอดนิยมที่เข้ามาซ่อม</title>
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
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


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
                                <h2>ข้อมูลรถยอดนิยมที่เข้ามาซ่อม</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                      <?php echo form_open('repair/history'); ?>
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
                       <!-- Form code ends -->
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>ประเภทของรถ</th>
                                <th>แบนรด์ของรถ</th>
                                <th>จำนวนครั้ง</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            $num=1;
                              foreach ($history as $_history) {
                                echo "<tr>";
                                  echo "<td>",$num,"</td>";
                                  echo "<td>",$_history['repair_type_name'],"</td>";
                                  echo "<td>",$_history['repair_band_name'],"</td>";
                                  echo "<td>",$_history['total_type'],"</td>";
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
                              <div class="modal-header" style="background-color:skyblue;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">ข้อมูลขายสินค้า</h4>
                                <!--<button type="button" style="margin-left:500px;" class="btn btn-default" id='mdCloseCus' data-dismiss="modal">Close</button>-->
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
  var Startdate_hide = $("#Startdate_hide").val();
  var Enddate_hide = $("#Enddate_hide").val();
  //var  printCounter = 0;
  $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          {
            extend: 'print',
            messageTop: function () {
              return '<h2 style=text-align:center;>ข้อมูลวันที่ : ' + Startdate_hide + ' - '+ Enddate_hide+'</h2>';
            }
          }
      ]
  });

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
