<html>
<head>
<title>ข้อมูลพนักงานในร้าน สถิตย์พรอะไหล่</title>
<style type='text/css'>
  .warring{background-color:#FFFF99;color:red;}
  .thcenter th{
    text-align:center;
  }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
<body>
<?php
$add=image_asset('icon/add.png');
$edit=image_asset('icon/edit.png');
$del=image_asset('icon/del.png');
$show=image_asset('icon/show.png');

echo "<div class='col-md-10'>";
  echo "<table class='table'>";
    echo "<thead class='thead-dark'>";
      echo "<tr class='thcenter'>";
        echo "<th colspan='9'>ข้อมูลประเภทสินค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addEmp'>",$add,"</button></th>";
      echo "</tr>";
    echo "</thead>";
  echo "</table>";
  ?>
  <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
          <tr>
            <th>รหัสพนักงาน</th>
            <th>ยูสเซอร์พนักงาน</th>
            <th>ชื่อพนักงาน</th>
            <th>นามสกุลพนักงาน</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        <?php
        foreach($result as $detail){
            echo "<tr>";
              echo "<td>".$detail['user_id']."</td>";
              echo "<td>".$detail['user_name']."</td>";
              echo "<td>",$detail['emp_name']."</td>";
              echo "<td>".$detail['emp_lastname']."</td>";
              echo "<td>".($detail['emp_status'] == '0'?'ไม่ทำงานแล้ว':'ยังทำงานอยู่')."</td>";
              echo "<td>".anchor('employee/detail/'.$detail['user_id'],$show)."<button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editEmpAjax(",$detail['user_id'],")'>",$edit,"</button>".anchor("employee/delete/".$detail['user_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
  </table>


<?php
echo "</div>";
?>

<!-- Start Add Emp -->
<div class="modal fade" id="addEmp" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มข้อมูลพนักงาน</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdClose' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('employee/insert');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
                echo "<label>Username : </label> <input type='text' id='username' name='username' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>Password : </label> <input type='text' id='password' name='password' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label for='sel1'>คำนำหน้า : ";
              echo "<label class='radio-inline'><input type='radio' id='prename' name='prename' value='นาย'>นาย</label>";
              echo "<label class='radio-inline'><input type='radio' id='prename' name='prename' value='นาง'>นาง</label>";
              echo "<label class='radio-inline'><input type='radio' id='prename' name='prename' value='นางสาว'>นางสาว</label>";
              echo "</select>";
              echo "</label>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>ชื่อ : </label> <input type='text' id='fristname' name='fristname' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>นามสกุล : </label> <input type='text' id='lastname' name='lastname' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>รหัสบัตรประชาชน : </label> <input type='text' id='id_card' name='id_card' class='form-control' maxlength='13'>";
            echo "</div>";

              echo "<div class='form-group'>";
                echo "<label>อายุ : </label> <input type='text' id='age' name='age' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<label for='comment'>ที่อยู่:</label>";
                echo "<textarea class='form-control' rows='5' id='address' name='address'></textarea>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='tel' name='tel' class='form-control' maxlength='10'>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<label for='position'>ตำแหน่ง : </label>";
                echo "<select class='form-control' id='position' name='position' style='height:34px;'>";
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
            echo "<div class='form-group'>";
                echo "<input type='hidden' id='edit_userid' name='edit_userid' class='form-control'>";
                echo "<label>Username : </label> <input type='text' id='edit_username' name='edit_username' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>Password : </label> <input type='text' id='edit_password' name='edit_password' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label for='sel1'>คำนำหน้า : ";
              echo "<label class='radio-inline'><input type='radio' id='edit_prename1' name='edit_prename' value='นาย'>นาย</label>";
              echo "<label class='radio-inline'><input type='radio' id='edit_prename2' name='edit_prename' value='นาง'>นาง</label>";
              echo "<label class='radio-inline'><input type='radio' id='edit_prename3' name='edit_prename' value='นางสาว'>นางสาว</label>";
              echo "</select>";
              echo "</label>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>ชื่อ : </label> <input type='text' id='edit_fristname' name='edit_fristname' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>นามสกุล : </label> <input type='text' id='edit_lastname' name='edit_lastname' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>รหัสบัตรประชาชน : </label> <input type='text' id='edit_id_card' name='edit_id_card' class='form-control' maxlength='13'>";
            echo "</div>";

              echo "<div class='form-group'>";
                echo "<label>อายุ : </label> <input type='text' id='edit_age' name='edit_age' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<label for='comment'>ที่อยู่:</label>";
                echo "<textarea class='form-control' rows='5' id='edit_address' name='edit_address'></textarea>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='edit_tel' name='edit_tel' class='form-control' maxlength='10'>";
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

</body>
</html>
<script>
$(document).ready(function(){
    $('#example').DataTable();

    $("#saveEmp").click(function (){
        var username = $("#username").val();
        var password  = $("#password").val();
        var prename  = $("#prename").val();
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
