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
      echo "<th colspan='9'>ข้อมูลแบรนด์สินค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addBand'>",$add,"</button></th>";
      //echo "<td align='right'></td>";
    echo "</tr>";
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


    <?php
    echo "<br><br>";
    echo "</div>"; //center-side
?>


<!-- Start Add Band -->
<div class="modal fade" id="addBand" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มข้อมูลแบรนด์สินค้า</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdClose' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();
            echo "<div class='form-group'>";
              echo "<label>ชื่อแบรนด์สินค้า : </label> <input type='text' id='name_band' class='form-control'>";
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
          <h4 class="modal-title">แก้ไขข้อมูลแบรนด์สินค้า</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseEdit' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open();
            echo "<div class='form-group'>";
              echo "<label>รหัสแบรนด์สินค้า : </label> <input type='text' id='Edit_id_band' class='form-control' readonly>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ชื่อแบรนด์สินค้า : </label> <input type='text' id='Edit_name_band' class='form-control'>";
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
