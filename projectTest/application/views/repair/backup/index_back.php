<style type='text/css'>
  .thcenter th{
    text-align:center;
  }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<?php
    $add=image_asset('icon/add.png');
    $show=image_asset('icon/show.png');
    $edit=image_asset('icon/edit.png');
    $del=image_asset('icon/del.png');
    echo "<div class='col-md-10'>";
      echo "<table class='table'>";
        echo "<thead class='thead-dark'>";
          echo "<tr class='thcenter'>";
            echo "<th colspan='9'>ข้อมูลการซ่อม<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addRepair'>",$add,"</button></th>";
          echo "</tr>";
        echo "</thead>";
      echo "</table>";
?>
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th>#</th>
          <th>ชื่อลูกค้า</th>
          <th>เบอร์โทรลูกค้า</th>
          <th>ชนิด</th>
          <th>ยี่ห้อ</th>
          <th>ป้ายทะเบียน</th>
          <th>สถานะ</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach($repair as $re){
        echo "<tr>";
            echo "<td>",$re['repair_id'],"</td>";
            echo "<td>",$re['customer_name'],"</td>";
            echo "<td>",$re['customer_tel'],"</td>";
            foreach($type as $ty){
              if($re['repair_type']==$ty['repair_type_id']){
                  echo "<td>",$ty['repair_type_name'],"</td>";
              }
            }

            foreach($band as $bd){
              if($re['repair_band']==$bd['repair_band_id']){
                  echo "<td>",$bd['repair_band_name'],"</td>";
              }
            }

            echo "<td>",$re['repair_label'],"</td>";

            foreach($status as $stus){
              if($re['repair_status']==$stus['re_status_id']){
                  echo "<td>",$stus['re_status_name'],"</td>";
              }
            }
            echo "<td>".anchor("repair/detail/".$re['repair_id'],$show),"<button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editRepair' id='idRepairEdit' onclick='editRepairAjax(",$re['repair_id'],")'>",$edit,"</button>".anchor("repair/delete/".$re['repair_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
</table>

<?php
echo "</div>"; //col-md-8
//echo "</div>"; //ปิด row

echo "</div>"; //ปิด container

?>
<!-- Start Add Emp -->
<div class="modal fade" id="addRepair" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มข้อมูลการซ่อม</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdClose' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('repair/insert');
            echo "<div class='form-group'>";
                  echo "<label>ชื่อลูกค้า : </label> <input type='text' name='cus_name' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' name='cus_tel' class='form-control' maxlength='10'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>ชนิดของรถ : </label><select name='repair_type' class='form-control'>";
                      foreach($type as $repair_type){
                        echo "<option value=",$repair_type['repair_type_id'],">",$repair_type['repair_type_name'],"</option>";
                      }
                  echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>ยี่ห้อของรถ : </label><select name='repair_band' class='form-control'>";
                      foreach($band as $repair_band){
                        echo "<option value=",$repair_band['repair_band_id'],">",$repair_band['repair_band_name'],"</option>";
                      }
                  echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>ป้ายทะเบียนรถ : </label><input type='text' name='repair_label' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>สาเหตุที่ต้องการซ่อม : </label>";
                  echo "<p><textarea name='repair_cause' cols='50' rows='10'></textarea></p>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>อะไหล่ที่ใช้ : </label> <input type='text' name='repair_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>รูปของรถ : </label> <input type='file' name='repair_picture'>";
                  echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";
            echo "</div>";
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='Save' name='saveRepair' id='saveRepair'>";
          echo form_close();
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Cus -->

<!-- Start Edit Repair -->
<div class="modal fade" id="editRepair" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">แก้ไขข้อมูลการซ่อม</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdClose' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('repair/update');
            echo "<div class='form-group'>";
                  echo "<input type='hidden' name='edit_id' id='edit_id'>";
                  echo "<label>ชื่อลูกค้า : </label> <input type='text' id='edit_cus_name' name='edit_cus_name' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' id='edit_cus_tel' name='edit_cus_tel' class='form-control' maxlength='10'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>ชนิดของรถ : </label><select name='edit_repair_type' id='edit_repair_type' class='form-control'>";
                      foreach($type as $repair_type){
                        echo "<option value=",$repair_type['repair_type_id'],">",$repair_type['repair_type_name'],"</option>";
                      }
                  echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>ยี่ห้อของรถ : </label><select id='edit_repair_band' name='edit_repair_band' class='form-control'>";
                      foreach($band as $repair_band){
                        echo "<option value=",$repair_band['repair_band_id'],">",$repair_band['repair_band_name'],"</option>";
                      }
                  echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
                echo "<label>ป้ายทะเบียนรถ : </label><input type='text' id='edit_repair_label' name='edit_repair_label' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>สาเหตุที่ต้องการซ่อม : </label>";
                  echo "<p><textarea name='edit_repair_cause' id='edit_repair_cause' cols='50' rows='10'></textarea></p>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>อะไหล่ที่ใช้ : </label> <input type='text' id='edit_repair_product' name='edit_repair_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>สถานะ : </label><select id='edit_repair_status' name='edit_repair_status' class='form-control'>";
                      foreach($status as $repair_status){
                        echo "<option value=",$repair_status['re_status_id'],">",$repair_status['re_status_name'],"</option>";
                      }
                  echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
                  echo "<label>รูปของรถ : </label> <input type='file' name='repair_picture'>";
                  echo "<input type='hidden' name='old_pic' id='old_pic'>";
            echo "</div>";
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='Save' name='updateRepair' id='updateRepair'>";
          echo form_close();
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Edit Repair -->

<script>
$(document).ready(function(){
    $('#example').DataTable();

});

function editRepairAjax (idRepairEdit){
    var idEdit = idRepairEdit;
    $("#editEmp").click();
    $.ajax({
      url: "<?php echo base_url() ?>repair/form_update/",
      type: "POST",
      data: {
        "idEdit" : idEdit
      },
      dataType: 'json',
      success: function(data){
          $("#edit_id").val(data.repair_id);
          $("#edit_cus_name").val(data.customer_name);
          $("#edit_cus_tel").val(data.customer_tel);
          $("#edit_repair_label").val(data.repair_label);
          $("#edit_repair_cause").val(data.repair_cause);
          $("#edit_repair_product").val(data.repair_product);
          $("#old_pic").val(data.repair_picture);
          var type = data.repair_type;
          $('#edit_repair_type option[value=' + type + ']').attr('selected','selected');
          var band = data.repair_band;
          $('#edit_repair_band option[value=' + band + ']').attr('selected','selected');
          var status = data.repair_status;
          $('#edit_repair_status option[value=' + status + ']').attr('selected','selected');
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
}
</script>
