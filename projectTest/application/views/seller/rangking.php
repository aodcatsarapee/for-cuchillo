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
  .data-table-container {
  padding: 10px;
}

.dt-buttons .btn {
  margin-right: 3px;
}

</style>
</head>
<body>
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
                            <div class="col-xs-12 col-sm-6">
                                <h2>ข้อมูลจัดอันดับสินค้าขายดี</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive"  style="height:600px;">
                      <?php echo form_open('sell/ranking'); ?>
                        <div class="row clearfix">
                          <div class="col-sm-2">
                            <select class="form-control show-tick" id='cate' name='cate' style="width:150px;">
                                <option value="All"> Select Categories </option>
                                <?php
                                  foreach ($cate as $_cate) {
                                    echo "<option value=",$_cate['cate_id'],">",$_cate['cate_name'],"</option>";
                                  }
                                ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <select class="form-control show-tick" id='band' name='band' style="width:150px;">
                                <option value="All"> Select Band </option>
                                <?php
                                  foreach ($band as $_band) {
                                    echo "<option value=",$_band['band_id'],">",$_band['band_name'],"</option>";
                                  }
                                ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                              <select class="form-control show-tick" id='month' name='month' style="width:150px;">
                                  <option value=""> Select Month </option>
                                  <option value="01">มกราคม</option>
                                  <option value="02">กุมภาพันธ์</option>
                                  <option value="03">มีนาคม</option>
                                  <option value="04">เมษายน</option>
                                  <option value="05">พฤษภาคม</option>
                                  <option value="06">มิถุนายน</option>
                                  <option value="07">กรกฎาคม</option>
                                  <option value="08">สิงหาคม</option>
                                  <option value="09">กันยายน</option>
                                  <option value="10">ตุลาคม</option>
                                  <option value="11">พฤศจิกายน</option>
                                  <option value="12">ธันวาคม</option>
                              </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control show-tick" id='year' name='year' style="width:150px;">
                                    <option value=""> Select Year </option>
                                    <option value="2017">2560</option>
                                    <option value="2018">2561</option>
                                    <option value="2019">2562</option>
                                    <option value="2020">2563</option>
                                    <option value="2021">2564</option>
                                    <option value="2022">2565</option>
                                </select>
                              </div>
                              <input type='submit' style="margin-left:20px;" id='Serach' value='Serach' class="btn btn-primary">
                          </div>
                      </form>
                      <input type='hidden' id='Searchmonth' value="<?php echo $time['month']; ?>">
                      <input type='hidden' id='Searchyear' value="<?php echo $time['year']; ?>">
                      <input type='hidden' id='Searchcate' value="<?php echo $time['cate']; ?>">
                      <input type='hidden' id='Searchband' value="<?php echo $time['band']; ?>">
                      <!-- <label> [ประเภทสินค้า] : <?php echo $time['cate']; ?> [แบรนด์สินค้า] : <?php echo $time['band']; ?> [เดือนที่] : <?php echo $time['month']; ?> [ปี] : <?php echo $time['year']; ?></label><br>  -->
                      <?php
                        $num=1;
                      ?>
                      <table id="example" class="table table-hover table-striped table-bordered data-table" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>ชื่อสินค้า</th>
                                <th>ประเภทสินค้า</th>
                                <th>แบรนด์สินค้า</th>
                                <th>จำนวนที่ขายได้</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($ranking as $rking) {
                              echo "<tr>";
                                  echo "<td>$num</td>";
                                  echo "<td>",$rking['sell_detail_name'],"</td>";
                                  echo "<td>",$rking['cate_name'],"</td>";
                                  echo "<td>",$rking['band_name'],"</td>";
                                  echo "<td>",$rking['sell_detail_amount'],"</td>";
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
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
</head>
</body>
</html>
<script>

$(document).ready(function(){
  $(window).on('load', function(){
    var Getmonth = $("#Searchmonth").val();
    var Getyear = $("#Searchyear").val();
    var Getcate = $("#Searchcate").val();
    var Getband = $("#Searchband").val();

    if(Getmonth != ""){
      $('#month option[value=' + Getmonth + ']').attr('selected','selected');
    }

    if(Getyear != ""){
      $('#year option[value=' + Getyear + ']').attr('selected','selected');
    }

    if(Getcate != ""){
      $('#cate option[value=' + Getcate + ']').attr('selected','selected');
    }

    if(Getband != ""){
      $('#band option[value=' + Getband + ']').attr('selected','selected');
    }

  });


  $('table.data-table').DataTable({
});

});
</script>
