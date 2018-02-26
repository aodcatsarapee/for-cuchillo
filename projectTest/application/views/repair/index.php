<html>
<head>
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>Frontend/css/bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<link href="<?php echo base_url(); ?>Frontend/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Frontend/css/waves.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/animate.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/morris.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>Frontend/css/all-themes.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

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
                        <table id="example" class='table table-striped table-bordered' cellspacing='0' width='100%'>
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
                                      if($re['repair_status'] == '4'){
                                        echo "<td style='width:390px;'><button type='button' onclick='ShowDetail(",$re['repair_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp; <button type='button' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editRepairAjax(",$re['repair_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button> &nbsp;<button type='button' onclick='conclude_repair(",$re['repair_id'],")' class='btn bg-black waves-effect'><i class='material-icons'>settings</i><span>CONCLUDE</span></button> &nbsp;<button type='button'  onclick='deleteData(",$re['repair_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
                                        /*echo "<td style='width:150px;'>".anchor("repair/detail/".$re['repair_id'],$show),"<button type='button' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editRepairAjax(",$re['repair_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button><img id='myImgConclude' onclick='javascript:conclude_repair(",$re['repair_id'],")' src=",base_url('Frontend/images/icon/check.png'),">"?><img style="padding-left:5px;" src="<?php echo base_url(); ?>Frontend/images/icon/del.png" onclick="deleteData(<?php echo $re['repair_id']; ?>)"></td>*/
                                      }else{
                                        echo "<td style='width:270px;'><button type='button' onclick='ShowDetail(",$re['repair_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp; <button type='button' data-toggle='modal' data-target='#editEmp' id='idEdit' onclick='editRepairAjax(",$re['repair_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button> &nbsp;<button type='button'  onclick='deleteData(",$re['repair_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
                                      }
                                      //echo "<td style='width:270px;'><button type='button' onclick='ShowDetail(",$re['repair_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp;<button type='button'  onclick='deleteData(",$re['repair_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
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
            <li role="presentation" class="active"><a href="#home" id="basictab" data-toggle="tab">Basic Data</a></li>
            <li role="presentation"><a href="#profile" data-toggle="tab">Detail & Picture</a></<li></li>
          </ul>
          <?php
          echo form_open_multipart('repair/insert','id="frmInsertRepair"');
          echo "<div class='tab-content'>";
            echo "<div role='tabpanel' class='tab-pane fade in active' id='home'>";
              echo "<br>";
              echo "<div class='form-group'>";
                  echo "<input type='hidden' name='emp_name' class='form-control' value=",$this->session->userdata['name'],">";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>ชื่อลูกค้า : </label> <input type='text' name='cus_name' class='form-control'>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>เบอร์โทรศัพท์ลูกค้า : </label> <input type='text' name='cus_tel' class='form-control _number' maxlength='10'>";
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
                  echo "<label>ป้ายทะเบียนรถ : </label><input type='text' name='repair_label' class='form-control' maxlength='50'>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label for='comment'>สาเหตุที่ต้องการซ่อม:</label>";
                  echo "<textarea class='form-control' rows='5' id='address' name='repair_cause' maxlength='200'></textarea>";
                echo "</div>";
              echo "</div>";
            echo "</div>";

            echo "<div role='tabpanel' class='tab-pane fade' id='profile'>";
              echo "<br>";
              echo "<div class='input-group'>";

              echo "<label>อะไหล่ที่ใช้ :  </label>";
              echo "<select class='selectpicker form-control' id='re_product_name' name='re_product_name' title='กรุณาเลือกอะไหล่' data-live-search='true'>";
                foreach ($product as $_product) {
                  echo "<optgroup label=",$_product['band_name'],">";
                  echo "<option value=",$_product['product_id'],">",$_product['product_name'],"</option>";
                }
              echo "</select>";

              echo "<button type='button' class='AddPro btn btn-primary btn-xs waves-effect waves-light'>";
                  echo "<i class='material-icons'>search</i>";
                  echo "<span>ADD</span>";
              echo "</button>";

              echo "<table id='addproductstable' class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                echo "<thead>";
                  echo "<tr>";
                    echo "<th>ชื่อสินค้า</th>";
                    echo "<th>จำนวนที่ใช้</th>";
                    echo "<th>Action</th>";
                  echo "</tr>";
                echo "</thead>";

                echo "<tbody id='data'>";
                echo "</tbody>";
              echo "</table>";

              /*echo "<label>อะไหล่ที่ใช้ : </label>";
              ?>
              <select id='optgroup' name="optgroup[]" class='ms' multiple='multiple'>";
                <?php
                foreach($product as $_product){
                  echo "<optgroup label=",$_product['band_name'],">";
                  echo "<option value=",$_product['product_id'],">",$_product['product_name'],"</option>";
                }
              echo "</select>";*/
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
          echo form_open_multipart('repair/update', 'id="frmEditRepair"');
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

          echo "<label>อะไหล่ที่ใช้ :  </label>";
          echo "<select class='selectpicker form-control' id='re_product_name' name='re_product_name' title='กรุณาเลือกอะไหล่' data-live-search='true'>";
          foreach ($product as $_product) {
              echo "<optgroup label=",$_product['band_name'],">";
              echo "<option value=",$_product['product_id'],">",$_product['product_name'],"</option>";
          }
          echo "</select>";

          echo "<button type='button' class='AddPro btn btn-primary btn-xs waves-effect waves-light'>";
          echo "<i class='material-icons'>search</i>";
          echo "<span>ADD</span>";
          echo "</button>";

          echo "<table id='addproductstable' class='table table-striped table-bordered' cellspacing='0' width='100%'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>ชื่อสินค้า</th>";
          echo "<th>จำนวนที่ใช้</th>";
          echo "<th>Action</th>";
          echo "</tr>";
          echo "</thead>";

          echo "<tbody id='data'>";
          echo "</tbody>";
          echo "</table>";

          /*echo "<label>อะไหล่ที่ใช้ : </label>";
          ?>
          <select id='optgroup' name="optgroup[]" class='ms' multiple='multiple'>";
            <?php
            foreach($product as $_product){
              echo "<optgroup label=",$_product['band_name'],">";
              echo "<option value=",$_product['product_id'],">",$_product['product_name'],"</option>";
            }
          echo "</select>";*/
          echo "</div>";

          echo "<div class='input-group'>";
          echo "<label>สถานะ : </label><select id='edit_repair_status' name='edit_repair_status' class='form-control'>";
          foreach($status as $repair_status){
              echo "<option value=",$repair_status['re_status_id'],">",$repair_status['re_status_name'],"</option>";
          }
          echo "</select>";
          echo "</div>";

          echo "<div class='row clearfix'>";
            echo "<div class='col-sm-12'>";
              echo "<label>ค่าแรงช่าง : </label> <input type='text' id='pay_repair' name='pay_repair' class='form-control _number' required>";
            echo "</div>";
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
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
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
    //$('#optgroup').multiSelect();
    //$('#Editoptgroup').multiSelect();

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

    $(".AddPro").click(function(){
        var formid = $(this).parents("form").attr('id');
        var id = $("#"+formid+" #re_product_name").val();

      $.ajax({
        url: "<?php echo base_url() ?>repair/add_pro",
        type: "POST",
        data: {
          "product_id" : id
        },
        dataType: 'json',
        openloading : true,
        success: function(data){
          var num = 1;
          if(data != null){
            $("#"+formid+" #data").append('<tr><td><input type="text" class="hidden" id="proid" name="proid[]" value="'+data.product_id+'"/><input type=text name="proname[]" id="proname'+ num +'"   value=' + data.product_name + ' readonly></td><td><input id="proqty" name="proqty[]" type=number min=1 max=100 value=1></td><td><button type=button onclick="deleteDetailList(this)" class=btn bg-red waves-effect><i class=material-icons>report_problem</i><span>DELETE</span></button></td></tr>');
          }

        },
        error: function(){
          alert('Error....');
          $("#mdCloseCus").click();
        }
      });
    });

    $("SaveData").click(function(){
      $.ajax({
        url: "<?php echo base_url() ?>repair/add_pro",
        type: "POST",
        data: {
          "product_id" : id
        },
        dataType: 'json',
        openloading : true,
        success: function(data){
          for(var item in proname1){
              //console.log(proname1[item].value);
          }
        },
        error: function(){
          alert('Error....');
          $("#mdCloseCus").click();
        }
      });
    });

});

function deleteDetailList(tag){
    $(tag).parents('tr').remove();
}

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
          swal("ข้อมูลที่คุณเลือกถูกลบเรียบร้อยแล้ว !", {
            icon: "success",
          }).then((value) => {
            location.reload();
          });
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

function editRepairAjax (idRepairEdit) {
    var idEdit = idRepairEdit;
    $("#editRepair").modal('show');
    $.ajax({
        url: "<?php echo base_url() ?>repair/form_update/",
        type: "POST",
        async: false,
        data: {
            "idEdit": idEdit
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_id").val(data.repair_id);
            $("#edit_cus_name").val(data.customer_name);
            $("#edit_cus_tel").val(data.customer_tel);
            $("#edit_repair_label").val(data.repair_label);
            $("#edit_repair_cause").val(data.repair_cause);
            //$("#edit_repair_product").val(data.repair_product);
            $("#old_pic").val(data.repair_picture);
            var type = data.repair_type;
            $('#edit_repair_type option[value=' + type + ']').attr('selected', 'selected');
            var band = data.repair_band;
            $('#edit_repair_band option[value=' + band + ']').attr('selected', 'selected');
            var status = data.repair_status;
            $('#edit_repair_status option[value=' + status + ']').attr('selected', 'selected');

            if(data.repair_product != ""){
                var tblobj = $(addproductstable);
                var products = (data.repair_product).split(',');
                products.pop();
                for(var i in products){
                    var detail = products[i].split(':'); // 0 id 1 name 2 qty
                    var template = '<tr><td><input type="text" class="hidden" id="proid" name="proid[]" value="'+detail[0]+'"><input type="text" name="proname[]" id="proname1" value="'+detail[1]+'" *ทั่วไป(ใช้ได้หลายรุ่น)="" readonly=""></td><td><input id="proqty" name="proqty[]" type="number" min="1" max="100" value="'+detail[2]+'"></td><td><button type="button" onclick="deleteDetailList(this)" class="btn" bg-red="" waves-effect=""><i class="material-icons">report_problem</i><span>DELETE</span></button></td></tr>';
                    tblobj.find("tbody").append(template);
                }
            }
        },
        error: function () {
            alert('Error....');
            $("#mdClose").click();
        }
    });
}

function getModel(form){
    var data = {
        cus_name: form.cus_name.value ,
        cus_tel: form.cus_tel.value ,
        repair_type: parseInt(form.repair_type.value) ,
        repair_band: parseInt(form.repair_band.value) ,
        repair_label: form.repair_label.value,
        repair_cause: form.address.value
    };

    if(form.proname1 != undefined){
        var pronames = new Array();
        for(var i = 0;i < form.proname1.length; i++){
            var pronameobj = {
                id: (form.proid[parseInt(i)].value),
                name: (form.proname1[parseInt(i)].value),
                qty: parseInt(form.proqty[parseInt(i)].value)
            };
            pronames.push(pronameobj);
        }
        data.products = pronames;
    }

    if(form.repair_picture.files.length == 1){
        data.repair_picture = form.repair_picture.files[0];
    }
    return data;
}

function clearFrmError(frm_id){
    $("#"+frm_id.id+" .form-line").removeClass("error");
    $("#"+frm_id.id+" #tag-error").remove();
}

$(document).on("blur","input,textarea",function(event){
    $(this).parents(".form-line").removeClass("focused");
    $(this).parents(".form-line").removeClass("error");
    $(this).parents(".form-line").parent().find("#tag-error").remove();
});

function validateSaveRepair(model,form){
    var result = true;

    clearFrmError(form);

    if(model.cus_name == ""){
        result = false;
        $(basictab).click();
        $(form.cus_name).parents(".form-line").addClass("focused error");
        $(form.cus_name).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุราระบุชื่อลูกค้า</label>');
    }

    if(model.cus_tel == ""){
        result = false;
        $(basictab).click();
        $(form.cus_tel).parents(".form-line").addClass("focused error");
        $(form.cus_tel).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุณาระบุเบอร์โทรศัพท์ลูกค้า</label>');
    }

    if(model.repair_label == ""){
        result = false;
        $(basictab).click();
        $(form.repair_label).parents(".form-line").addClass("focused error");
        $(form.repair_label).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุราระบุป้ายทะเบียนรถ</label>');
    }

    if(model.repair_cause == ""){
        result = false;
        $(basictab).click();
        $(form.repair_cause).parents(".form-line").addClass("focused error");
        $(form.repair_cause).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุณาระบุสาเหตุที่ต้องการซ่อม</label>');
    }

    return result;
}

$(document).on("submit","#frmInsertRepair",function(event){
    event.preventDefault();
    var frm = frmInsertRepair;
    var modeldata = getModel(frm);
    if(validateSaveRepair(modeldata,frmInsertRepair)){
        $.ajax({
            url: "repair/insert", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            async: false,
            success: function(data)   // A function to be called if request succeeds
            {
                $(".modal").modal('hide');
                location.reload();
            }
        });
    }
});

function getModelEdit(form){
    var data = {
        cus_name: form.edit_cus_name.value ,
        cus_tel: form.edit_cus_tel.value ,
        repair_type: parseInt(form.edit_repair_type.value) ,
        repair_band: parseInt(form.edit_repair_band.value) ,
        repair_label: form.edit_repair_label.value,
        repair_cause: form.edit_repair_cause.value
    };

    if(form.proname1 != undefined){
        var pronames = new Array();
        for(var i = 0;i < form.proname1.length; i++){
            var pronameobj = {
                id: (form.proid[parseInt(i)].value),
                name: (form.proname1[parseInt(i)].value),
                qty: parseInt(form.proqty[parseInt(i)].value)
            };
            pronames.push(pronameobj);
        }
        data.products = pronames;
    }

    if(form.repair_picture.files.length == 1){
        data.repair_picture = form.repair_picture.files[0];
    }
    return data;
}

function validateSaveRepairEdit(model,form){
    var result = true;

    clearFrmError(form);

    if(model.cus_name == ""){
        result = false;
        $(basictab).click();
        $(form.edit_cus_name).parents(".form-line").addClass("focused error");
        $(form.edit_cus_name).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุราระบุชื่อลูกค้า</label>');
    }

    if(model.cus_tel == ""){
        result = false;
        $(basictab).click();
        $(form.edit_cus_tel).parents(".form-line").addClass("focused error");
        $(form.edit_cus_tel).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุณาระบุเบอร์โทรศัพท์ลูกค้า</label>');
    }

    if(model.repair_label == ""){
        result = false;
        $(basictab).click();
        $(form.edit_repair_label).parents(".form-line").addClass("focused error");
        $(form.edit_repair_label).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุราระบุป้ายทะเบียนรถ</label>');
    }

    if(model.repair_cause == ""){
        result = false;
        $(basictab).click();
        $(form.edit_repair_cause).parents(".form-line").addClass("focused error");
        $(form.edit_repair_cause).parents(".form-line").parent().append('<label id="tag-error" class="error" for="email">กรุณาระบุสาเหตุที่ต้องการซ่อม</label>');
    }

    return result;
}

$(document).on("submit","#frmEditRepair",function(event){
    event.preventDefault();
    var frm = frmEditRepair;
    var modeldata = getModelEdit(frm);
    if(validateSaveRepairEdit(modeldata,frmEditRepair)){
        $.ajax({
            url: "repair/update", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            async: false,
            success: function(data)   // A function to be called if request succeeds
            {
                $(".modal").modal('hide');
                location.reload();
            }
        });
    }
});

</script>
