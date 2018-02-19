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
  #myImg {border-radius: 5px;cursor: pointer;transition: 0.3s;}
  #myImg:hover {opacity: 0.7;}
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
                                <h2>จัดการข้อมูลการซ่อม</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body"  style="height:600px;">
                      <?php
                          $add=image_asset('icon/add.png');
                          $show=image_asset('icon/show.png');
                          $edit=image_asset('icon/edit.png');
                          $del=image_asset('icon/del.png');
                          $check=image_asset('icon/check.png');
                            echo "<table class='table'>";
                              echo "<thead class='thead-dark'>";
                                echo "<tr class='thcenter'>";
                                  echo "<th colspan='9'>สรุปข้อมูลการซ่อม</th>";
                                echo "</tr>";
                              echo "</thead>";
                            echo "</table>";
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>อาการที่ต้องซ่อม</th>
                                <th>วันที่บันทึก</th>
                                <th>ประเภทของรถ</th>
                                <th>แบนรด์ของรถ</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            $num = 1;
                            foreach($conclude as $re){
                              echo "<tr>";
                                  echo "<td>",$num,"</td>";
                                  echo "<td>",$re['conclude_title'],"</td>";
                                  echo "<td>",$re['conclude_date']." - ".$re['conclude_time'],"</td>";
                                  echo "<td>",$re['repair_type_name'],"</td>";
                                  echo "<td>",$re['repair_band_name'],"</td>";
                                  echo "<td><img id='myImg' onclick='javascript:detail_conclude(",$re['conclude_repair_id'],")' src=",base_url('Frontend/images/icon/show.png'),"></td>";
                              echo "</tr>";
                              $num++;
                            }
                            ?>
                          </tbody>
                      </table>

                      <!-- Start Detail Conclude -->
                      <div class="modal fade" id="detailConclude" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#336699;">
                                <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                <h4 class="modal-title" style="text-align:center;color:white;">รายละเอียดข้อมูลสรุปการซ่อม</h4>
                              </div>
                              <div class="modal-body">
                                <?php
                                  echo form_open();
                                    echo "<div class='row clearfix'>";
                                      echo "<div class='form-line'>";
                                        echo "<label>วิธีการซ่อม : </label> <textarea id='fixRepair' class='form-control' disabled></textarea>";
                                      echo "</div>";
                                    echo "</div>";
                                    echo "<div class='row clearfix'>";
                                      echo "<div class='form-line'>";
                                        echo "<label>อะไหล่ที่ใช้ซ่อม : </label> <textarea id='productRepair' rows='5' class='form-control' disabled></textarea>";
                                      echo "</div>";
                                    echo "</div>";
                                  echo form_close();
                                ?>
                              </div>
                            </div>

                          </div>
                        </div>
                      <!-- End Add Product -->

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
</body>
</html>
<script>
function detail_conclude(id){
  $.ajax({
    url: "<?php echo base_url() ?>repair/conclude_detail/",
    type: "POST",
    data: {
      "idDetail" : id
    },
    dataType: 'json',
    success: function(data){
        //$("#fixRepair").append("<span>",data.conclude_detail,"</span>");
        $("#fixRepair").val(data.conclude_detail);
        var order_id = data.conclude_order_id;
        //$("#productRepair").append("<span>",data.conclude_product,"</span>");

        $.ajax({
          url: "<?php echo base_url() ?>repair/conclude_product/",
          type: "POST",
          data: {
            "idProduct" : order_id
          },
          dataType: 'json',
          success: function(pro){
              //$("#fixRepair").append("<span>",data.conclude_detail,"</span>");
              for(var i=0; i<pro.length; i++){
                $("#productRepair").append("<span>",pro[i].sell_detail_name," จำนวน : ",pro[i].sell_detail_amount," \n","</span>");
                //$("#productRepair").val(pro[i].sell_detail_name,"<br></span>");
              }


              $("#detailConclude").modal('show');
          },
          error: function(){
            alert('Error....');
            $("#mdClose").click();
          }
      })
    },
    error: function(){
      alert('Error....');
      $("#mdClose").click();
    }
  })
}

$(document).ready(function(){
    $('#example').DataTable();
});
</script>
