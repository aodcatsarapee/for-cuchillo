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
  .thcenter th{text-align:center;}
  #myImg {border-radius: 5px;cursor: pointer;transition: 0.3s;}
  #myImg:hover {opacity: 0.7;}
  #myImgUpdate {border-radius: 5px;cursor: pointer;transition: 0.3s;}
  #myImgUpdate:hover {opacity: 0.7;}
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
                        </div>
                    </div>
                    <div class="body">
                      <?php
                      $add=image_asset('icon/add.png');
                      $edit=image_asset('icon/edit.png');
                      $del=image_asset('icon/del.png');
                      echo "<table class='table'>";
                        echo "<thead class='thead-dark'>";
                          echo "<tr class='thcenter'>";
                            echo "<th colspan='9'>ข้อมูลผู้ใช้<img id='myImg' style='float:right;' class='data-toggle='modal' data-target='#addCus' src=",base_url('Frontend/images/icon/add.png'),"></th>";
                            //echo "<th colspan='9'>ข้อมูลผู้ใช้<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addCus'>",$add,"</button></th>";
                          echo "</tr>";
                        echo "</thead>";
                      echo "</table>";
                      ?>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>#</th>
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
                              $num = 1;
                              foreach($customer as $_data){
                                  echo "<tr>";
                                    echo "<td>".$num."</td>";
                                    echo "<td>".$_data['cus_id']."</td>";
                                    echo "<td>".$_data['cus_cardid']."</td>";
                                    echo "<td>".$_data['cus_name']."</td>";
                                    echo "<td>".$_data['cus_address']."</td>";
                                    echo "<td>".$_data['cus_tel']."</td>";
                                    echo "<td align='center'><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editCus' id='idEditCus' onclick='editCusAjax(",$_data['cus_id'],")'>",$edit,"</button>"?><img src="<?php echo base_url(); ?>Frontend/images/icon/del.png" onclick="deleteData(<?php echo $_data['cus_id']; ?>)"></td>
                                  <?php
                                  echo "</tr>";
                                  $num++;
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
                          <div class="modal-dialog modal-sm !Important">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#FFFF99;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align:center;">เพิ่มข้อมูลผู้ใช้</h4>
                              </div>
                              <div class="modal-body">

                                <?php
                                echo form_open();
                                  echo "<div class='row clearfix'>";
                                    echo "<div class='col-sm-12'>";
                                      echo "<label class='form-label'>รหัสบัตรประชาชน :</label>";
                                      echo "<input type='text' maxlength='13' id='addCus_cardid' class='form-control' required>";
                                    echo "</div>";
                                  echo "</div>";

                                  echo "<div class='row clearfix'>";
                                    echo "<div class='col-sm-12'>";
                                      echo "<label>ชื่อ - นามสกุล : </label> <input type='text' id='addCus_name' class='form-control' required>";
                                    echo "</div>";
                                  echo "</div>";

                                  echo "<div class='row clearfix'>";
                                    echo "<div class='col-sm-12'>";
                                      echo "<label>ที่อยู่ : </label><textarea id='addCus_address' class='form-control' required> </textarea>";
                                    echo "</div>";
                                  echo "</div>";

                                  echo "<div class='row clearfix'>";
                                    echo "<div class='col-sm-12'>";
                                      echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='addCus_tel' class='form-control' maxlength='10' required>";
                                    echo "</div>";
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
                                  echo "<div class='form-group form-float'>";
                                    echo "<div class='form-line'>";
                                      echo "<input type='hidden' id='editCus_id'>";
                                      echo "<label>รหัสบัตรประชาชน : </label> <input type='text' maxlength='13' id='editCus_cardid' class='form-control'>";
                                    echo "</div>";
                                  echo "</div>";

                                  echo "<div class='form-group form-float'>";
                                    echo "<div class='form-line'>";
                                      echo "<label>ชื่อ - นามสกุล : </label> <input type='text' id='editCus_name' class='form-control'>";
                                    echo "</div>";
                                  echo "</div>";

                                  echo "<div class='form-group form-float'>";
                                    echo "<div class='form-line'>";
                                        echo "<label>ที่อยู่ : </label> <input type='text' id='editCus_address' class='form-control'>";
                                    echo "</div>";
                                  echo "</div>";

                                  echo "<div class='form-group form-float'>";
                                    echo "<div class='form-line'>";
                                      echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='editCus_tel' class='form-control' maxlength='10'>";
                                    echo "</div>";
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
                    </div>
              </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>

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
$('#example').dataTable();

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
        url: "<?php echo base_url() ?>customer/delete",
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
    $("#myImg").click(function (){
      $("#addCus").modal('show');
    })

    $("#myImgUpdate").click(function (){
      $("#editCus").modal('show');
    })

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
              $("#addCus").modal('hide');
              $(".alert").removeClass('hide');
              setTimeout(function(){ $(".alert").addClass('hide'); }, 800);
              setTimeout(function(){ location.reload(); }, 1000);
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
