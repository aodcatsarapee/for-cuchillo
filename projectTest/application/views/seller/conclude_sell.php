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
  <?php require("modal/modal-select-date.php") ?>

  <?php require("modal/modal-alert-select-date.php") ?>

  <?php require("modal/modal-alert-error-date.php") ?>
<section class="content">
    <div class="container-fluid">
      <div class="alert alert-success hide">
        <strong>Save success</strong>
      </div>
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>ยอดขายสินค้า (เงินสด)</h2>
                                <button type="button" class="btn btn-success " id="insert" data-toggle="modal"
                                        data-target="#modal-select-date-account"
                                        style="float: right;">
                                    <spen class="glyphicon glyphicon-plus"></spen>
                                    เลือกวันที่
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                      <?php
                        ?>

                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>ชื่อสินค้า</th>
                                  <th>จำนวนที่ขาย</th>
                                  <th>วันที่ทำการขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $num=1;
                              foreach($detail as $_detail){
                                  echo "<tr>";
                                    echo "<td>".$num."</td>";
                                    echo "<td>".$_detail['sell_detail_name']."</td>";
                                    echo "<td>".$_detail['sell_detail_amount'],"</td>";
                                    echo "<td style='width:150px;'>".$_detail['sell_detail_date'],"</td>";
                                  echo "</tr>";
                                  $num++;
                              }
                              ?>
                            </tbody>
                        </table>
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">เปลี่ยนสถานะการชำระเงิน</h4>
        </div>
        <div class="modal-body">
          <?php
          echo form_open('sell/change_status/'.$data['sell_id']);  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
          echo "<div class='row clearfix'>";
            echo "<div class='form-line'>";
              echo "<label for='position'>สถานะ : </label>";
              echo "<select class='form-control' id='Status' name='Status' style='height:34px;'>";
                echo "<option value='1'>ชำระเงินเรียบร้อย</option>";
              echo "</select>";
            echo "</div>";
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

  <div class="modal fade" id="showHis" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color:#336699;">
            <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
            <h4 class="modal-title" style="text-align:center;color:white;">ข้อมูลรายละเอียดการส่งสินค้า</h4>
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


<script>
$('#example').DataTable( {
        "order": [[3, "desc" ]]
    } );

    $("#select-date_account").submit(function (event) {
        event.preventDefault();

        if ($("#date_start").val() == "" || $("#date_end").val() == "") {

            $("#alert_select-date").modal('show');

        } else {
            if ($("#date_start").val() > $("#date_end").val()) {

                $("#alert-error-date").modal('show');

            } else {
                var id = $("#id").val();
                var date_start = $("#date_start").val();
                var date_end = $("#date_end").val();
                window.open('conclude_sell_detail?id=' + id + '&date_start=' + date_start + '&date_end=' + date_end + '', '_blank')
            }
        }
    });


    $("#showHis").on("hidden.bs.modal", function(){
      $("#showHis").find("#data").html("");
    });

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

    function showDetailAjax (idShow){
        var idShow = idShow;
        $("#showHis").modal('show');
        $.ajax({
          url: "<?php echo base_url() ?>sell/detail_approve/",
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

</script>