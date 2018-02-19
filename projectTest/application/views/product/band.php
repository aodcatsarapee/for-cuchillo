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
                                <h2>จัดการข้อมูลแบรนด์สินค้า</h2>
                            </div>
                        </div>
                        <!--<ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul> -->
                    </div>
                    <div class="body"  style="height:600px;">
                      <?php
                          $add=image_asset('icon/add.png');
                          $show=image_asset('icon/show.png');
                          $edit=image_asset('icon/edit.png');
                          $del=image_asset('icon/del.png');
                            echo "<table class='table'>";
                              echo "<thead class='thead-dark'>";
                                echo "<tr class='thcenter'>";
                                  echo "<th colspan='9'>ข้อมูลแบรนด์สินค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addBand'>",$add,"</button></th>";
                                echo "</tr>";
                              echo "</thead>";
                            echo "</table>";
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>รหัสแบรนด์สินค้า</th>
                                  <th>ชื่อแบรนด์สินค้า</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                               foreach($band as $_band){
                                     echo "<tr>";
                                       echo "<td>".$_band['band_id']."</td>";
                                       echo "<td>".$_band['band_name']."</td>";
                                       echo "<td><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editBand' id='idBandEdit' onclick='editBandAjax(",$_band['band_id'],")'>",$edit,"</button>".anchor("product/delete_band/".$_band['band_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
                                     echo "</tr>";
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

<!-- Start Add Band -->
<div class="modal fade" id="addBand" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">เพิ่มข้อมูลแบรนด์สินค้า</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                //echo "<label>ชื่อแบรนด์สินค้า : </label> <input type='text' id='name_band' class='form-control'>";
              echo "</div>";
            echo "</div>";
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>ชื่อแบรนด์สินค้า : </label> <input type='text' id='name_band' class='form-control'>";
              echo "</div>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='saveBand'>SAVE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Band -->

<!-- Start Edit Band -->
<div class="modal fade" id="editBand" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">แก้ไขข้อมูลแบรนด์สินค้า</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>รหัสแบรนด์สินค้า : </label> <input type='text' id='Edit_id_band' class='form-control' disabled>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>ชื่อแบรนด์สินค้า : </label> <input type='text' id='Edit_name_band' class='form-control'>";
              echo "</div>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='updateBand'>UPDATE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Edit Band -->

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
$(document).ready(function(){
    $('#example').DataTable();

    $("#saveBand").click(function (){
        var name_band = $("#name_band").val();
        $.ajax({
          url: "<?php echo base_url() ?>product/band_insert",
          type: "POST",
          data: {
            "name_band" : name_band
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("เพิ่มข้อมูลแบรนด์สินค้าสำเร็จ");
              $("#mdClose").click();
              location.reload();
          },
          error: function(){
            alert('Error....');
            $("#mdClose").click();
          }
        });
    })

    $("#updateBand").click(function (){
        var up_id = $("#Edit_id_band").val();
        var up_name = $("#Edit_name_band").val();
        $.ajax({
          url: "<?php echo base_url() ?>product/band_update",
          type: "POST",
          data: {
            "up_id" : up_id,
            "up_name" : up_name
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("แก้ไขข้อมูลแบรนด์สินค้าสำเร็จ");
              $("#mdCloseEdit").click();
              location.reload();
          },
          error: function(){
            alert('Error....');
            $("#mdClose").click();
          }
        });
    })

});

function editBandAjax (idBandEdit){
    var idEdit = idBandEdit;
    $("#editEmp").click();
    $.ajax({
      url: "<?php echo base_url() ?>product/form_update_band/",
      type: "POST",
      data: {
        "idEdit" : idEdit
      },
      dataType: 'json',
      success: function(data){
          $("#Edit_id_band").val(data.band_id);
          $("#Edit_name_band").val(data.band_name);
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
}//)
</script>
