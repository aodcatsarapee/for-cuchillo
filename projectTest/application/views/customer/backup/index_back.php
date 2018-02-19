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



echo "<div class='col-md-10'>";
  echo "<table class='table'>";
    echo "<thead class='thead-dark'>";
      echo "<tr class='thcenter'>";
        echo "<th colspan='9'>ข้อมูลผู้ใช้<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addCus'>",$add,"</button></th>";
      echo "</tr>";
    echo "</thead>";
  echo "</table>";
  ?>
  <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
          <tr>
            <th>รหัสลูกค้า</th>
            <th>รหัสบัตรประชาชน</th>
            <th>ชื่อ - นามสกุล</th>
            <th>ที่อยู่</th>
            <th>เบอร์โทร</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
      <?php
      if(count($customer)==0){
          echo "<tr align='center'>";
            echo "<td colspan='5'>ไม่มีข้อมูลผู้ใช้งาน</td>";
          echo "</tr>";
      }else{
          foreach($customer as $_data){
              echo "<tr align='center'>";
                echo "<td>".$_data['cus_id']."</td>";
                echo "<td>".$_data['cus_cardid']."</td>";
                echo "<td>".$_data['cus_name']."</td>";
                echo "<td>".$_data['cus_address']."</td>";
                echo "<td>".$_data['cus_tel']."</td>";
                echo "<td align='center'><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editCus' id='idEditCus' onclick='editCusAjax(",$_data['cus_id'],")'>",$edit,"</button>".anchor("customer/delete/".$_data['cus_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
              echo "</tr>";
          }
      }
      ?>
      </tbody>
  </table>


  <?php
  echo "</div>";

  ?>

  <!-- Start Add Emp -->
  <div class="modal fade" id="addCus" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">เพิ่มข้อมูลผู้ใช้</h4>
            <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseCus' data-dismiss="modal">Close</button>
          </div>
          <div class="modal-body">

            <?php
            echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
              echo "<div class='form-group'>";
                    echo "<label>รหัสบัตรประชาชน : </label> <input type='text' maxlength='13' id='addCus_cardid' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>ชื่อ - นามสกุล : </label> <input type='text' id='addCus_name' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>ที่อยู่ : </label> <input type='text' id='addCus_address' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='addCus_tel' class='form-control' maxlength='10'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<input type='hidden' id='addCus_type' class='form-control' value='สมาชิก'>";
              echo "</div>";
            echo form_close();
            ?>

            <span style='padding-left:400px;'></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id='saveCus'>SAVE</button>
          </div>
        </div>

      </div>
    </div>
  <!-- End Add Cus -->

  <!-- Start Edit Cus -->
  <div class="modal fade" id="editCus" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">แก้ไขข้อมูลผู้ใช้</h4>
            <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseCus' data-dismiss="modal">Close</button>
          </div>
          <div class="modal-body">

            <?php
            echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
              echo "<div class='form-group'>";
                    echo "<input type='hidden' id='editCus_id'>";
                    echo "<label>รหัสบัตรประชาชน : </label> <input type='text' maxlength='13' id='editCus_cardid' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>ชื่อ - นามสกุล : </label> <input type='text' id='editCus_name' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>ที่อยู่ : </label> <input type='text' id='editCus_address' class='form-control'>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='editCus_tel' class='form-control' maxlength='10'>";
              echo "</div>";
            echo form_close();
            ?>

            <span style='padding-left:400px;'></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id='updateCus'>UPDATE</button>
          </div>
        </div>

      </div>
    </div>
  <!-- End Add Cus -->

</body>
</html>

  <script>
  $('#example').DataTable();
  function editCusAjax (idEditCus){
      var idEditCus = idEditCus;
      $("#editCus").click();
      $.ajax({
        url: "<?php echo base_url() ?>customer/form_update/",
        type: "POST",
        data: {
          "idEditCus" : idEditCus
        },
        dataType: 'json',
        success: function(data){
            $("#editCus_id").val(data.cus_id);
            $("#editCus_cardid").val(data.cus_cardid);
            $("#editCus_name").val(data.cus_name);
            $("#editCus_address").val(data.cus_address);
            $("#editCus_tel").val(data.cus_tel);
        },
        error: function(){
          alert('Error....');
          $("#mdCloseCus").click();
        }
      });
  }

  $(document).ready(function(){
      $("#saveCus").click(function (){
          var cardid = $("#addCus_cardid").val();
          var name  = $("#addCus_name").val();
          var address  = $("#addCus_address").val();
          var tel  = $("#addCus_tel").val();
          var type  = $("#addCus_type").val();
          $.ajax({
            url: "<?php echo base_url() ?>customer/insert",
            type: "POST",
            data: {
              "cus_cardid" : cardid,
              "cus_name" : name,
              "cus_address" : address,
              "cus_tel" : tel,
              "cus_type" : type
            },
            dataType: 'json',
            openloading : true,
            success: function(data){
                alert("เพิ่มข้อมูลผู้ใช้สำเร็จ");
                $("#mdCloseCus").click();
                location.reload();
            },
            error: function(){
              alert('Error....');
              $("#mdCloseCus").click();
            }
          });
      })

      $("#updateCus").click(function (){
          var id = $("#editCus_id").val();
          var cardid = $("#editCus_cardid").val();
          var name  = $("#editCus_name").val();
          var address  = $("#editCus_address").val();
          var tel  = $("#editCus_tel").val();
          $.ajax({
            url: "<?php echo base_url() ?>customer/update",
            type: "POST",
            data: {
              "id" : id,
              "cus_cardid" : cardid,
              "cus_name" : name,
              "cus_address" : address,
              "cus_tel" : tel
            },
            dataType: 'json',
            openloading : true,
            success: function(data){
                alert("แก้ไขข้อมูลผู้ใช้สำเร็จ");
                $("#mdCloseCus").click();
                location.reload();
            },
            error: function(){
              alert('Error....');
              $("#mdCloseCus").click();
            }
          });
      })

  });
  </script>
