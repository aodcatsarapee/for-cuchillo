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
<link href="<?php echo base_url(); ?>Frontend/css/multi-select.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.multi-select.js"></script>

<style type='text/css'>
  .warring{background-color:#FFFF99;color:red;}
  .thcenter th{
    text-align:center;
  }
  #myImg {border-radius: 5px;cursor: pointer;transition: 0.3s;}
  #myImg:hover {opacity: 0.7;}

  #myImgConclude {border-radius: 5px;cursor: pointer;transition: 0.3s;}
  #myImgConclude:hover {opacity: 0.7;}
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
                                <h2>จัดการข้อมูลการซ่อม</h2>
                            </div>
                            <button type='button' style="float:right;" class='btn bg-teal waves-effect' data-toggle='modal' data-target='#addRepair'><i class='material-icons'>forum</i><span>เพิ่มข้อมูล</span></button>
                        </div>
                    </div>
                    <div class="body  table-responsive" style="height:600px;">
                        <?php
                            $position=$this->session->userdata['type'];
                            $add=image_asset('icon/add.png');
                            $show=image_asset('icon/show.png');
                            $edit=image_asset('icon/edit.png');
                            $del=image_asset('icon/del.png');
                            $check=image_asset('icon/check.png');
                        ?>
                        <input type='hidden' id='loop'>
                        <input type='hidden' id='num'>
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
                                  <th>Date</th>
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
                                    echo "<td>",$re['repair_date'],"</td>";
                                    if($position == '5'){
                                      if($re['repair_status'] == '4'){
                                        echo "<td style='width:390px;'><button type='button' onclick='ShowDetail(",$re['repair_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp; <button type='button' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editRepairAjax(",$re['repair_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button> &nbsp;<button type='button' onclick='conclude_repair(",$re['repair_id'],")' class='btn bg-black waves-effect'><i class='material-icons'>settings</i><span>CONCLUDE</span></button> &nbsp;<button type='button'  onclick='deleteData(",$re['repair_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
                                        /*echo "<td style='width:150px;'>".anchor("repair/detail/".$re['repair_id'],$show),"<button type='button' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editRepairAjax(",$re['repair_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button><img id='myImgConclude' onclick='javascript:conclude_repair(",$re['repair_id'],")' src=",base_url('Frontend/images/icon/check.png'),">"?><img style="padding-left:5px;" src="<?php echo base_url(); ?>Frontend/images/icon/del.png" onclick="deleteData(<?php echo $re['repair_id']; ?>)"></td>*/
                                      }else{
                                        echo "<td style='width:270px;'><button type='button' onclick='ShowDetail(",$re['repair_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp; <button type='button' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editRepairAjax(",$re['repair_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button> &nbsp;<button type='button'  onclick='deleteData(",$re['repair_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
                                      }
                                    }else{
                                      echo "<td style='width:270px;'><button type='button' onclick='ShowDetail(",$re['repair_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp;<button type='button'  onclick='deleteData(",$re['repair_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
                                    }
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
<div class="modal fade" id="addRepair" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">เพิ่มข้อมูลการซ่อม</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#home" data-toggle="tab">Basic Data</a></li>
            <li role="presentation"><a href="#profile" data-toggle="tab">Detail & Picture</a></<li></li>
          </ul>
          <?php
          echo form_open_multipart('repair/insert');
          echo "<div class='tab-content'>";
            echo "<div role='tabpanel' class='tab-pane fade in active' id='home'>";
              echo "<br>";
              echo "<div class='form-group'>";
                  echo "<input type='hidden' name='emp_name' class='form-control' value=",$this->session->userdata['name'],">";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>ชื่อลูกค้า : </label> <input type='text' name='cus_name' class='form-control' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' name='cus_tel' class='form-control _number' maxlength='10' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                    echo "<label>ชนิดของรถ : </label><select name='repair_type' class='form-control'>";
                        foreach($type as $repair_type){
                          echo "<option value=",$repair_type['repair_type_id'],">",$repair_type['repair_type_name'],"</option>";
                        }
                    echo "</select>";
              echo "</div>";

              echo "<div class='input-group'>";
                    echo "<label>ยี่ห้อของรถ : </label><select name='repair_band' class='form-control'>";
                        foreach($band as $repair_band){
                          echo "<option value=",$repair_band['repair_band_id'],">",$repair_band['repair_band_name'],"</option>";
                        }
                    echo "</select>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>ป้ายทะเบียนรถ : </label><input type='text' name='repair_label' class='form-control' required maxlength='50'>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label for='comment'>สาเหตุที่ต้องการซ่อม:</label>";
                  echo "<textarea class='form-control' rows='5' id='address' name='repair_cause' maxlength='200' required></textarea>";
                echo "</div>";
              echo "</div>";
            echo "</div>";

            echo "<div role='tabpanel' class='tab-pane fade' id='profile'>";
              echo "<br>";
              echo "<div class='input-group'>";
              echo "<label>อะไหล่ที่ใช้ : </label>";
              ?>
              <select id='optgroup' name="optgroup[]" class='ms' multiple='multiple'>";
                <?php
                foreach($product as $_product){
                  echo "<optgroup label=",$_product['band_name'],">";
                  echo "<option value=",$_product['product_id'],">",$_product['product_name'],"</option>";
                }
              echo "</select>";
              echo "</div>";

              echo "<div class='form-group'>";
                    echo "<label>รูปของรถ : </label> <input type='file' name='repair_picture'>";
                    echo "<input type='hidden' name='emp_name' value=",$employee['emp_name'],">";
              echo "</div>";
            echo "</div>";
          echo "</div>";
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='บันทึก' name='saveRepair' id='saveRepair'>";
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
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">แก้ไขข้อมูลการซ่อม</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#homeEdit" data-toggle="tab">Basic Data</a></li>
            <li role="presentation"><a href="#profileEdit" data-toggle="tab">Detail & Picture</a></<li></li>
          </ul>
          <?php
          echo form_open_multipart('repair/update');
            echo "<div class='tab-content'>";
              echo "<div role='tabpanel' class='tab-pane fade in active' id='homeEdit'>";
                echo "<br>";
                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<input type='hidden' name='edit_id' id='edit_id'>";
                    echo "<label>ชื่อลูกค้า : </label> <input type='text' id='edit_cus_name' name='edit_cus_name' class='form-control' required maxlength='100'>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' id='edit_cus_tel' name='edit_cus_tel' class='form-control _number' required maxlength='10'>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<label>ชนิดของรถ : </label><select name='edit_repair_type' id='edit_repair_type' class='form-control'>";
                      foreach($type as $repair_type){
                        echo "<option value=",$repair_type['repair_type_id'],">",$repair_type['repair_type_name'],"</option>";
                      }
                  echo "</select>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<label>ยี่ห้อของรถ : </label><select id='edit_repair_band' name='edit_repair_band' class='form-control'>";
                      foreach($band as $repair_band){
                        echo "<option value=",$repair_band['repair_band_id'],">",$repair_band['repair_band_name'],"</option>";
                      }
                  echo "</select>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>ป้ายทะเบียนรถ : </label><input type='text' id='edit_repair_label' name='edit_repair_label' class='form-control' maxlength='50' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label for='comment'>สาเหตุที่ต้องการซ่อม:</label>";
                    echo "<textarea class='form-control' rows='5' name='edit_repair_cause' id='edit_repair_cause' maxlength='200' required></textarea>";
                  echo "</div>";
                echo "</div>";
               echo "</div>";

               echo "<div role='tabpanel' class='tab-pane fade' id='profileEdit'>";
                 echo "<br>";
                 echo "<div class='input-group'>";
                 echo "<label>อะไหล่ที่ใช้ : </label>";
                 ?>
                 <select id='Editoptgroup' name="Editoptgroup[]" class='ms' multiple='multiple'>";
                   <?php
                   foreach($product as $_product){
                     echo "<optgroup label=",$_product['band_name'],">";
                     echo "<option id='ee' value=",$_product['product_id'],">",$_product['product_name'],"</option>";
                   }
                 echo "</select>";
                 echo "</div>";

                 echo "<div class='input-group'>";
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
              echo "</div>";

            echo "</div>";



            /*echo "<div class='input-group'>";
              echo "<div class='form-line'>";
                 <input type='text' id='edit_repair_product' name='edit_repair_product' class='form-control'>";
              echo "</div>";
            echo "</div>";*/




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

<!-- Start Add Product -->
<div class="modal fade" id="addProduct" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">ข้อมูลสินค้า</h4>
        </div>
        <div class="modal-body">

          <table id="product" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>รหัสบาร์โค้ด</th>
                      <th>ชื่อสินค้า</th>
                      <th>ราคาต้นทุน/ชิ้น</th>
                      <th>ราคา/ชิ้น</th>
                      <th>จำนวนคงเหลือ</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                   foreach($product as $pro){
                         echo "<tr align='center'>";
                           echo "<td>".$pro['product_barcode']."</td>";
                           echo "<td>",$pro['product_name'],"</td>"; //.anchor("product/detail/".$pro['product_id'],
                           echo "<td>".number_format($pro['product_cost'])."</td>";
                           echo "<td>".number_format($pro['product_price'])."</td> ";
                           if($pro['product_quantity']<10){
                             echo "<td class='warring'>".number_format($pro['product_quantity'])."</td>";
                           }else{
                             echo "<td>".$pro['product_quantity']."</td>";
                           }
                           echo "<td align='center'><img id='myImgProduct' style='padding-left:20px;' src=",base_url('Frontend/images/icon/add.png'),"></td>";
                         echo "</tr>";
                     }
                ?>
              </tbody>
          </table>
      </div>
    </div>

  </div>
</div>
<!-- End Add Product -->

<!-- Start Conclude -->
<div class="modal fade" id="Conclude" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:#336699;">
        <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
        <h4 class="modal-title" style="text-align:center;color:white;">สรุปการซ่อม</h4>
      </div>
      <div class="modal-body">
        <?php
          echo form_open('repair/add_conclude/'.$re['repair_id']);
            echo "<input type='hidden' id='how_repair_id' class='form-control'>";
            echo "<div class='row clearfix'>";
              echo "<div class='col-sm-12'>";
                echo "<label class='form-label'>วิธีการซ่อม :</label>";
                echo "<textarea id='how_repair' name='how_repair' class='form-control' required></textarea>";
              echo "</div>";
            echo "</div>";
        ?>
        <span style='padding-left:400px;'></span>
      </div>
    <div class="modal-footer">
    <?php
      echo "<input type='submit' class='btn btn-success' value='Save' name='update_conclude_Repair' id='update_conclude_Repair'>";
      echo form_close();
    ?>
  </div>
</div>

</div>
</div>
<!-- End Edit Conclude -->


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>

<!--
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
function ShowDetail(id){
  var Detailid = id;
  window.location = '<?php echo base_url(); ?>repair/detail/'+ Detailid;
}
$(document).ready(function(){
    $('#optgroup').multiSelect();
    $('#Editoptgroup').multiSelect();

    $('#example').DataTable( {
        "order": [[ 0, "desc" ]]
    } );

    var table = $('#product').DataTable();

    $('#product tbody').on( 'click', 'tr', function () {
        //console.log( table.row( this ).data() );
        var GetPro = table.row( this ).data();
        var IdGetPro = GetPro[0];
        var loop = $("#loop").val();
        var num = $("#num").val();
        if(loop == 0){
          num = 0;
        }else{
          var num = parseInt(num) + parseInt(loop);
        }
        var Test = [];
        Test[num] = GetPro[0];
        $('<input>').attr({
            type: 'hidden',
            id: 'ProductGet' + num ,
            name: 'bar',
            value : Test[num]
        }).appendTo( $("#repair_product "));

        var dataRepair = $("#repair_product ").val();
        if(dataRepair == ""){
          $("#repair_product").val(Test[num]);
        }else{
          var NewDataRepair = dataRepair + ',' + Test[num];
          $("#repair_product").val(NewDataRepair);
        }

        var one = 1;
        $("#loop").val(one);
        $("#num").val(num);

        //$("#repair_product").val(IdGetPro);
        $("#addProduct").modal('hide');
        $("#addRepair").modal('hide');
    } );

    $("#myImg").click(function (){
      $("#addProduct").modal('show');
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
        url: "<?php echo base_url() ?>repair/delete",
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

function conclude_repair(id){
  $("#Conclude").modal('show');
  $("#how_repair_id").val(id);
}

function add_conclude_repair(id){

}

function editRepairAjax (idRepairEdit){
    var idEdit = idRepairEdit;
    $("#editRepair").modal('show');
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
          //$("#edit_repair_product").val(data.repair_product);
          $("#old_pic").val(data.repair_picture);
          var type = data.repair_type;
          $('#edit_repair_type option[value=' + type + ']').attr('selected','selected');
          var band = data.repair_band;
          $('#edit_repair_band option[value=' + band + ']').attr('selected','selected');
          var status = data.repair_status;
          $('#edit_repair_status option[value=' + status + ']').attr('selected','selected');
          var muti = data.repair_product;

      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
}
</script>
