<html>
<head>
<title>ข้อมูลสินค้าทั้งหมดของ ร้านสถิตพรอะไหล่</title>
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
//echo css_asset('bootstrap.min.css');
$add=image_asset('icon/add.png');
$edit=image_asset('icon/edit.png');
$del=image_asset('icon/del.png');
echo "<div class='col-md-10'>";
    echo "<table class='table'>";
    echo "<thead class='thead-dark'>";
    echo "<tr class='thcenter'>";
      echo "<th colspan='9'>ข้อมูลประเภทสินค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addCate'>",$add,"</button></th>";
      //echo "<td align='right'></td>";
    echo "</tr>";
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
                     echo "<td><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editCate' id='idCateEdit' onclick='editCateAjax(",$cate['cate_id'],")'>",$edit,"</button>".anchor("product/delete_cate/".$cate['cate_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
                   echo "</tr>";
               }
          ?>
        </tbody>
    </table>


    <?php
          //echo $this->pagination->create_links();
    echo "<br><br>";
    //echo anchor("owner/home","กลับหน้าแรก");
    echo "</div>"; //center-side
?>


<!-- Start Add Categories -->
<div class="modal fade" id="addCate" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มข้อมูลประเภทสินค้า</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdClose' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();
            echo "<div class='form-group'>";
              echo "<label>ชื่อประเภทสินค้า : </label> <input type='text' id='name_cate' class='form-control'>";
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
        <div class="modal-header">
          <h4 class="modal-title">แก้ไขข้อมูลสินค้า</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseEdit' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
              echo "<label>รหัสประเภทสินค้า : </label> <input type='text' id='Edit_id_cate' class='form-control' readonly>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ชื่อประเภทสินค้า : </label> <input type='text' id='Edit_name_cate' class='form-control'>";
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
