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
                                <h2>จัดการข้อมูลสมาชิก</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                    <?php
                      $add=image_asset('icon/add.png');
                      $edit=image_asset('icon/edit.png');
                      $del=image_asset('icon/del.png');
                      $show=image_asset('icon/show.png');
                      echo "<table class='table'>";
                        echo "<thead class='thead-dark'>";
                          echo "<tr class='thcenter'>";
                            echo "<th colspan='9'>ข้อมูลสมาชิก</th>";
                          echo "</tr>";
                        echo "</thead>";
                      echo "</table>";
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>รหัสสมาชิก</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>ชื่อสมาชิก</th>
                                <th>นามสกุลสมาชิก</th>
                                <th>Email</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ที่อยู่</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            $num=1;
                            foreach($member as $detail){
                                echo "<tr>";
                                  echo "<td>".$num."</td>";
                                  echo "<td>".$detail['member_id']."</td>";
                                  echo "<td>".$detail['member_username']."</td>";
                                  echo "<td>",$detail['member_password']."</td>";
                                  echo "<td>".$detail['member_firstname']."</td>";
                                  echo "<td>".$detail['member_lastname']."</td>";
                                  echo "<td>".$detail['member_email']."</td>";
                                  echo "<td>".$detail['member_tel']."</td>";
                                  echo "<td>".$detail['member_address']."</td>";
                                  echo "<td>".anchor("member/delete/".$detail['member_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
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

<!-- Start Add Emp -->
<div class="modal fade" id="addEmp" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">เพิ่มข้อมูลพนักงาน</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('employee/insert');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>Username : </label> <input type='text' id='username' name='username' class='form-control' required>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>Password : </label> <input type='text' id='password' name='password' class='form-control' required>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>คำนำหน้า : </label>";
              echo "<input type='radio' name='prename' id='prename' class='with-gap' value='นาย'>";
              echo "<label for='prename'>นาย</label>";

              echo "<input type='radio' name='prename' id='prename1' class='with-gap' value='นาง'>";
              echo "<label for='prename1'>นาง</label>";

              echo "<input type='radio' name='prename' id='prename2' class='with-gap' value='นางสาว'>";
              echo "<label for='prename2'>นางสาว</label>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>ชื่อ : </label> <input type='text' id='fristname' name='fristname' class='form-control' required>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>นามสกุล : </label> <input type='text' id='lastname' name='lastname' class='form-control' required>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>รหัสบัตรประชาชน : </label> <input type='text' id='id_card' name='id_card' class='form-control' maxlength='13' required>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>อายุ : </label> <input type='text' id='age' name='age' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label for='comment'>ที่อยู่:</label>";
                echo "<textarea class='form-control' rows='5' id='address' name='address'></textarea>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='tel' name='tel' class='form-control' maxlength='10' required>";
              echo "</div>";
            echo "</div>";

            echo "<div class='row clearfix'>";
              echo "<label for='position'>ตำแหน่ง : </label>";
              echo "<select class='form-control show-tick' id='position' name='position' style='height:34px;'>";
                echo "<option value='2'>เจ้าของกิจการ</option>";
                echo "<option value='3'>พนักงานขาย</option>";
                echo "<option value='4'>พนักงานขนส่ง</option>";
                echo "<option value='5'>พนักงานซ่อม</option>";
              echo "</select>";
            echo "</div>";

              echo "<div class='form-group'>";
                echo "<label for='exampleFormControlFile1'>Example file input</label>";
                echo "<input type='file' class='form-control-file' id='picture_employee' name='picture_employee'>";
              echo "</div>";

          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='Save' name='save' id='save'>";
          echo form_close();
          //<button type="button" class="btn btn-success" id='saveEmp1'>SAVE</button>
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
        <div class="modal-header">
          <h4 class="modal-title" id='show'>แก้ไขข้อมูลพนักงาน</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseEdit' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('employee/update');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<input type='hidden' id='edit_userid' name='edit_userid' class='form-control'>";
                echo "<label>Username : </label> <input type='text' id='edit_username' name='edit_username' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>Password : </label> <input type='text' id='edit_password' name='edit_password' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>คำนำหน้า : </label>";
              echo "<input type='radio' id='edit_prename1' name='edit_prename' class='with-gap' value='นาย'>";
              echo "<label for='prename'>นาย</label>";

              echo "<input type='radio' id='edit_prename2' name='edit_prename' class='with-gap' value='นาง'>";
              echo "<label for='prename1'>นาง</label>";

              echo "<input type='radio' id='edit_prename3' name='edit_prename' class='with-gap' value='นางสาว'>";
              echo "<label for='prename2'>นางสาว</label>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>ชื่อ : </label> <input type='text' id='edit_fristname' name='edit_fristname' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>นามสกุล : </label> <input type='text' id='edit_lastname' name='edit_lastname' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>รหัสบัตรประชาชน : </label> <input type='text' id='edit_id_card' name='edit_id_card' class='form-control' maxlength='13'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>อายุ : </label> <input type='text' id='edit_age' name='edit_age' class='form-control'>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label for='comment'>ที่อยู่:</label>";
                echo "<textarea class='form-control' rows='5' id='edit_address' name='edit_address'></textarea>";
              echo "</div>";
            echo "</div>";

            echo "<div class='form-group form-float'>";
              echo "<div class='form-line'>";
                echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='edit_tel' name='edit_tel' class='form-control' maxlength='10'>";
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

              echo "<div class='form-group'>";
                echo "<label for='status'>สถานะการทำงาน : </label>";
                echo "<select class='form-control' id='status' name='status' style='height:34px;'>";
                  echo "<option value='0' id='position_0'>ไม่ทำงานแล้ว</option>";
                  echo "<option value='1' id='position_1'>ยังทำงานอยู่</option>";
                echo "</select>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<input type='hidden' id='old_emp_picture' name='old_emp_picture'>";
                echo "<label for='exampleFormControlFile1'>Example file input</label>";
                echo "<input type='file' class='form-control-file' id='Edit_emp_picture' name='Edit_emp_picture'>";
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

    $("#updateEmp").click(function (){
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
            "position" : position
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
          //$("#edit_prename").val(data.emp_prename);
          var Eprename = data.emp_prename;
          if(Eprename == "นาย"){
            $("#edit_prename1").prop("checked", true);
            $("#edit_prename2").prop("checked", false);
            $("#edit_prename3").prop("checked", false);
          }else if(Eprename == "นาง"){
            $("#edit_prename1").prop("checked", false);
            $("#edit_prename2").prop("checked", true);
            $("#edit_prename3").prop("checked", false);
          }else{
            $("#edit_prename1").prop("checked", false);
            $("#edit_prename2").prop("checked", false)
            $("#edit_prename3").prop("checked", true);
          }

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

          var Estaus = data.emp_status;
          if(Estaus == '0'){
            $("#position_0").prop("selected", true);
            $("#position_1").prop("selected", false);
          }else if(Eposition == '1'){
            $("#position_0").prop("selected", false);
            $("#position_1").prop("selected", true);
          }

          $("#edit_fristname").val(data.emp_name);
          $("#edit_lastname").val(data.emp_lastname);
          $("#edit_id_card").val(data.emp_idcard);
          $("#edit_age").val(data.emp_age);
          $("#edit_address").val(data.emp_address);
          $("#edit_tel").val(data.emp_tel);
          $("#edit_position").val(data.user_position);
          $("#old_emp_picture").val(data.emp_picture);
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
