<?php
  if($this->session->userdata['type'] == '1' OR $this->session->userdata['type'] == '2'){
 ?>
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
<link href="<?php echo base_url(); ?>Frontend/css/bootstrap-select.css" rel="stylesheet">
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
        <strong>Save Success</strong>
      </div>
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>จัดการข้อมูลผู้ใช้</h2>
                            </div>
                            <button type='button' style="float:right;" class='btn bg-teal waves-effect' data-toggle='modal' data-target='#addEmp'><i class='material-icons'>forum</i><span>เพิ่มข้อมูล</span></button>
                        </div>
                    </div>
                    <div class="body">
                    <?php
                      $add=image_asset('icon/add.png');
                      $edit=image_asset('icon/edit.png');
                      $del=image_asset('icon/del.png');
                      $show=image_asset('icon/show.png');
                      $change=image_asset('icon/change.png');
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>รหัสผู้ใช้งาน</th>
                                <th>ยูสเซอร์ผู้ใช้งาน</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th>ตำแหน่ง</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach($result as $detail){
                                $position = "";
                                if($detail['user_position'] == '1'){
                                  $position = "ผู้ดูแลระบบ";
                                }else if($detail['user_position'] == '2'){
                                  $position = "เจ้าของกิจการ";
                                }else if($detail['user_position'] == '3'){
                                  $position = "พนักงานขาย";
                                }else if($detail['user_position'] == '4'){
                                  $position = "พนักงานส่งของ";
                                }else if($detail['user_position'] == '5'){
                                  $position = "พนักงานซ่อม";
                                }
                                echo "<tr>";
                                  echo "<td>".$detail['user_id']."</td>";
                                  echo "<td>".$detail['user_name']."</td>";
                                  echo "<td>",$detail['emp_name']."</td>";
                                  echo "<td>".$position."</td>";
                                  echo "<td colspan='2'>"?><button type="button" data-toggle='modal' data-target='#editEmp' id='idEdit' onclick="editEmpAjax(<?php echo $detail['user_id']; ?>)" class="btn bg-orange waves-effect"><i class="material-icons">content_cut</i><span>EDIT</span></button> &nbsp;<button type="button"  onclick="deleteData(<?php echo $detail['user_id']; ?>)" class="btn bg-red waves-effect"><i class="material-icons">report_problem</i><span>DELETE</span></button></td>
                                <?php
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

<!-- Start Add Emp -->
<div class="modal fade" id="addEmp" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">เพิ่มข้อมูลผู้ใช้</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#home" data-toggle="tab">Basic Data</a></li>
        </ul>
          <?php
          echo form_open_multipart('employee/insert');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='tab-content'>";
              echo "<div role='tabpanel' class='tab-pane fade in active' id='home'>";
                echo "<br>";
                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>Username : </label> <input type='text' id='username' name='username' class='form-control' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>Password : </label> <input type='text' id='password' name='password' class='form-control' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='form-group form-float'>";
                  echo "<label for='position'>ตำแหน่ง : </label>";
                  echo "<select class='form-control show-tick' id='position' name='position' style='height:34px;'>";
                    echo "<option value='2'>เจ้าของกิจการ</option>";
                    echo "<option value='3'>พนักงานขาย</option>";
                    echo "<option value='4'>พนักงานขนส่ง</option>";
                    echo "<option value='5'>พนักงานซ่อม</option>";
                  echo "</select>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          ?>
          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='บันทึก' name='saveProduct1' id='saveProduct1'>";
          echo form_close();
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Emp -->

<!-- Start Edit Emp -->
<div class="modal fade" id="editEmp" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">แก้ไขข้อมูลผู้ใช้</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#home" data-toggle="tab">Basic Data</a></li>
        </ul>
        <?php
          echo form_open_multipart('employee/update');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='tab-content'>";
              echo "<div role='tabpanel' class='tab-pane fade in active' id='home'>";
                echo "<br>";
            echo "<div class='input-group'>";
              echo "<div class='form-line'>";
                echo "<input type='hidden' id='edit_userid' name='edit_userid' class='form-control'>";
                echo "<label>Username : </label> <input type='text' id='edit_username' name='edit_username' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='input-group'>";
              echo "<div class='form-line'>";
                echo "<label>Password : </label> <input type='text' id='edit_password' name='edit_password' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label for='position'>ตำแหน่ง : </label>";
              echo "<select class='form-control' id='position' name='position' style='height:34px;'>";
                echo "<option value='2' id='position_owner'>เจ้าของกิจการ</option>";
                echo "<option value='3' id='position_sell'>พนักงานขาย</option>";
                echo "<option value='4' id='position_delivery'>พนักงานขนส่ง</option>";
                echo "<option value='5' id='position_fix'>พนักงานซ่อม</option>";
              echo "</select>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='Update' name='Update' id='Update'>";
          echo form_close();
          //<button type="button" class="btn btn-success" id='updateEmp'>UPDATE</button>
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Edit Emp -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
</head>
</body>
</html>
<script>
$(document).ready(function(){
    $('#example').DataTable();

    $("#saveEmp").click(function (){
        var username = $("#username").val();
        var password  = $("#password").val();
        var prename  = $("input[name=prename]:checked").val();
        var fristname  = $("#fristname").val();
        var lastname  = $("#lastname").val();
        var id_card  = $("#id_card").val();
        var age  = $("#age").val();
        var address  = $("#address").val();
        var tel  = $("#tel").val();
        var position  = $("#position").val();
        $.ajax({
          url: "<?php echo base_url() ?>employee/insert",
          type: "POST",
          data: {
            "username" : username,
            "password" : password,
            "prename" : prename,
            "fristname" : fristname,
            "lastname" : lastname,
            "id_card" : id_card,
            "age" : age,
            "address" : address,
            "tel" : tel,
            "position" : position
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("เพิ่มข้อมูลพนักงานสำเร็จ");
              $("#mdClose").click();
              location.reload();
          },
          error: function(){
            alert('Error....');
            $("#mdClose").click();
          }
        });
    })

    $("#updateEmp1").click(function (){
        var user_id = $("#edit_userid").val();
        var username = $("#edit_username").val();
        var password  = $("#edit_password").val();
        var prename  = $("#edit_prename").val();
        var fristname  = $("#edit_fristname").val();
        var lastname  = $("#edit_lastname").val();
        var id_card  = $("#edit_id_card").val();
        var age  = $("#edit_age").val();
        var address  = $("#edit_address").val();
        var tel  = $("#edit_tel").val();
        var position  = $("#position").val();
        var baseSalary = $("#edit_baseSalary").val();
        $.ajax({
          url: "<?php echo base_url() ?>employee/update",
          type: "POST",
          data: {
            "user_id" : user_id,
            "username" : username,
            "password" : password,
            "prename" : prename,
            "fristname" : fristname,
            "lastname" : lastname,
            "id_card" : id_card,
            "age" : age,
            "address" : address,
            "tel" : tel,
            "position" : position,
            "baseSalary" : baseSalary
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("แก้ไขข้อมูลพนักงานสำเร็จ");
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
        url: "<?php echo base_url() ?>employee/delete",
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

function editEmpAjax (IdEdit){
    var idEdit = IdEdit;
    $("#editEmp").click();
    $.ajax({
      url: "<?php echo base_url() ?>employee/form_update/",
      type: "POST",
      data: {
        "idEdit" : idEdit
      },
      dataType: 'json',
      //openloading : true,
      success: function(data){
          $("#edit_userid").val(data.user_id);
          $("#edit_username").val(data.user_name);
          $("#edit_password").val(data.user_password);
          var Eposition = data.user_position;
          if(Eposition == '1'){

          }else if(Eposition == '2'){
            $("#position_owner").prop("selected", true);
            $("#position_sell").prop("selected", false);
            $("#position_delivery").prop("selected", false);
            $("#position_fix").prop("selected", false);
          }else if(Eposition == '3'){
            $("#position_owner").prop("selected", false);
            $("#position_sell").prop("selected", true);
            $("#position_delivery").prop("selected", false);
            $("#position_fix").prop("selected", false);
          }else if(Eposition == '4'){
            $("#position_owner").prop("selected", false);
            $("#position_sell").prop("selected", false);
            $("#position_delivery").prop("selected", true);
            $("#position_fix").prop("selected", false);
          }else if(Eposition == '5'){
            $("#position_owner").prop("selected", false);
            $("#position_sell").prop("selected", false);
            $("#position_delivery").prop("selected", false);
            $("#position_fix").prop("selected", true);
          }

          $("#edit_position").val(data.user_position);
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
}//)
</script>
<?php
}else{
  redirect('admin');
}
?>
