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
                                <h2>จัดการข้อมูลประเภทสินค้า</h2>
                            </div>
                            <button type='button' style="float:right;" class='btn bg-teal waves-effect' data-toggle='modal' data-target='#addCate'><i class='material-icons'>forum</i><span>เพิ่มข้อมูล</span></button>
                        </div>
                    </div>
                    <div class="body"  style="height:600px;">
                      <?php
                          $add=image_asset('icon/add.png');
                          $show=image_asset('icon/show.png');
                          $edit=image_asset('icon/edit.png');
                          $del=image_asset('icon/del.png');
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>รหัสประเภทสินค้า</th>
                                  <th>ชื่อประเภทสินค้า</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                               foreach($categories as $cate){
                                     echo "<tr>";
                                       echo "<td>".$cate['cate_id']."</td>";
                                       echo "<td>".$cate['cate_name']."</td>";
                                       echo "<td style='width:200px;'>&nbsp; <button type='button' data-toggle='modal' data-target='#editCate' id='idEdit' onclick='editCateAjax(",$cate['cate_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button>&nbsp;<button type='button'  onclick='deleteData(",$cate['cate_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
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

<!-- Start Add Categories -->
<div class="modal fade" id="addCate" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">เพิ่มข้อมูลประเภทสินค้า</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>ชื่อประเภทสินค้า : </label> <input type='text' id='name_cate' class='form-control'>";
              echo "</div>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='saveCate'>SAVE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Categories -->

<!-- Start Edit Categories -->
<div class="modal fade" id="editCate" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">แก้ไขข้อมูลประเภทสินค้า</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>รหัสประเภทสินค้า : </label> <input type='text' id='Edit_id_cate' class='form-control' disabled>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>ชื่อประเภทสินค้า : </label> <input type='text' id='Edit_name_cate' class='form-control'>";
              echo "</div>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='updateCate'>UPDATE</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Edit Categories -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

    $("#saveCate").click(function (){
        var name_cate = $("#name_cate").val();
        $.ajax({
          url: "<?php echo base_url() ?>product/cate_insert",
          type: "POST",
          data: {
            "name_cate" : name_cate
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("เพิ่มข้อมูลประเภทสินค้าสำเร็จ");
              $("#mdClose").click();
              location.reload();
          },
          error: function(){
            alert('Error....');
            $("#mdClose").click();
          }
        });
    })

    $("#updateCate").click(function (){
        var up_id = $("#Edit_id_cate").val();
        var up_name = $("#Edit_name_cate").val();
        $.ajax({
          url: "<?php echo base_url() ?>product/cate_update",
          type: "POST",
          data: {
            "up_id" : up_id,
            "up_name" : up_name
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("แก้ไขข้อมูลประเภทสินค้าสำเร็จ");
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

function deleteData(id){
  var Delid = id;
  swal({
    title: "คุณต้องการจะลบข้อมูล ?",
    text: "ข้อมูลเมื่อถูกลบไปแล้วจะไม่สามารถกู้คืนได้",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "<?php echo base_url() ?>product/delete_cate",
        type: "POST",
        data: {
          "Del_id" : Delid
        },
        dataType: 'json',
        openloading : true,
        success: function(data){
          swal("ข้อมูลที่คุณเลือกถูกลบเรียบร้อยแล้ว !", {
            icon: "success",
          }).then((value) => {
            location.reload();
          });
        },
        error: function(){
          alert('Error....');
          $("#mdClose").click();
        }
      });
    }
  });
}

function editCateAjax (idCateEdit){
    var idEdit = idCateEdit;
    $("#editEmp").click();
    $.ajax({
      url: "<?php echo base_url() ?>product/form_update_cate/",
      type: "POST",
      data: {
        "idEdit" : idEdit
      },
      dataType: 'json',
      success: function(data){
          $("#Edit_id_cate").val(data.cate_id);
          $("#Edit_name_cate").val(data.cate_name);
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
}//)
</script>
