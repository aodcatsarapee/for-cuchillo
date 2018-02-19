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
<?php
$type=$this->session->userdata['type'];
?>
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
                                <h2>จัดการข้อมูลสินค้า</h2>
                            </div>
                            <button type='button' style="float:right;" class='btn bg-teal waves-effect' data-toggle='modal' data-target='#addProduct'><i class='material-icons'>forum</i><span>เพิ่มข้อมูล</span></button>
                        </div>
                    </div>
                    <div class="body table-responsive" style="height:600px;">
                      <?php
                          $add=image_asset('icon/add.png');
                          $show=image_asset('icon/show.png');
                          $edit=image_asset('icon/edit.png');
                          $del=image_asset('icon/del.png');

                      ?>
                          <table id="example" class="display" cellspacing="0" width="100%">
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
                                           if($type == '3'){
                                             echo "<td style='width:300px;'><button type='button' onclick='ShowDetail(",$pro['product_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp; <button type='button' data-toggle='modal' data-target='#editProduct' id='idEdit' onclick='editProductAjax(",$pro['product_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button>"."</td>";
                                           }else{
                                             echo "<td style='width:300px;'><button type='button' onclick='ShowDetail(",$pro['product_id'],")' class='btn bg-light-green waves-effect'><i class='material-icons'>search</i><span>DETAIL</span></button>&nbsp; <button type='button' data-toggle='modal' data-target='#editProduct' id='idEdit' onclick='editProductAjax(",$pro['product_id'],")' class='btn bg-orange waves-effect'><i class='material-icons'>content_cut</i><span>EDIT</span></button> &nbsp;<button type='button'  onclick='deleteData(",$pro['product_id'],")' class='btn bg-red waves-effect'><i class='material-icons'>report_problem</i><span>DELETE</span></button></td>";
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

<!-- Start Add Product -->
<div class="modal fade" id="addProduct" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">เพิ่มข้อมูลสินค้า</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#home" data-toggle="tab">Basic Data</a></li>
            <li role="presentation"><a href="#profile" data-toggle="tab">Detail & Picture</a></<li></li>
        </ul>
          <?php
          echo form_open_multipart('product/insert');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='tab-content'>";
              echo "<div role='tabpanel' class='tab-pane fade in active' id='home'>";
                echo "<br>";
                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>รหัสบาร์โค้ด : </label> <input type='text' id='barcode_product' name='barcode_product' class='form-control' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>ชื่อสินค้า : </label> <input type='text' id='name_product' name='name_product' class='form-control' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' id='cost_product' name='cost_product' class='form-control _number' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' id='price_product' name='price_product' class='form-control _number' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label>จำนวนสินค้า : </label> <input type='text' id='quantity_product' name='quantity_product' class='form-control _number' required>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='form-group form-float'>";
                    echo "<label>ประเภทของสินค้า : <select id='cate_product' name='cate_product' class='form-control show-tick' data-live-search='true' style='height:34px;'>";
                      foreach($cate as $product_cate){
                        echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
                      }
                    echo "</select>";
                echo "</div>";

                echo "<div class='form-group form-float'>";
                  echo "<label>แบนด์ของสินค้า : </label> <select id='band_product' name='band_product' class='form-control show-tick' data-live-search='true' style='height:34px;'>";
                      foreach($band as $band_cate){
                        echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
                      }
                  echo "</select>";
                echo "</div>";
              echo "</div>";

              echo "<div role='tabpanel' class='tab-pane fade' id='profile'>";
                echo "<br>";

                echo "<div class='input-group'>";
                  echo "<div class='form-line'>";
                    echo "<label for='comment'>Detail:</label>";
                    echo "<textarea class='form-control' rows='5' id='detail_product' name='detail_product'></textarea>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='form-group'>";
                  echo "<label for='exampleFormControlFile1'>Example file input</label>";
                  echo "<input type='file' class='form-control-file' id='product_picture' name='product_picture'>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          ?>
          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='Save' name='saveProduct1' id='saveProduct1'>";
          //<button type="button" class="btn btn-success" id='saveProduct'>SAVE</button>
          echo form_close();
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Add Product -->

<!-- Start Edit Product -->
<div class="modal fade" id="editProduct" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">แก้ไขข้อมูลสินค้า</h4>
        </div>
        <div class="modal-body">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
          <li role="presentation" class="active"><a href="#homeEdit" data-toggle="tab">Basic Data</a></li>
          <li role="presentation"><a href="#profileEdit" data-toggle="tab">Detail & Picture</a></<li></li>
        </ul>
          <?php
          echo form_open_multipart('product/update');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='tab-content'>";
            echo "<div role='tabpanel' class='tab-pane fade in active' id='homeEdit'>";
              echo "<br>";
              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<input type='hidden' id='Edit_id_product' name='Edit_id_product'>";
                  echo "<label>รหัสบาร์โค้ด : </label> <input type='text' id='Edit_barcode_product' name='Edit_barcode_product' class='form-control' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>ชื่อสินค้า : </label> <input type='text' id='Edit_name_product' name='Edit_name_product' class='form-control' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' id='Edit_cost_product' name='Edit_cost_product' class='form-control _number' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' id='Edit_price_product' name='Edit_price_product' class='form-control _number' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label>จำนวนสินค้า : </label> <input type='text' id='Edit_quantity_product' name='Edit_quantity_product' class='form-control _number' required>";
                echo "</div>";
              echo "</div>";

              echo "<div class='form-group form-float'>";
                echo "<label>ประเภทของสินค้า : <select id='Edit_cate_product' name='Edit_cate_product' class='form-control' style='height:34px;'>";
                  foreach($cate as $product_cate){
                    echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
                  }
                echo "</select>";
              echo "</div>";

              echo "<div class='form-group form-float'>";
                echo "<label>แบนด์ของสินค้า : </label> <select id='Edit_band_product' name='Edit_band_product' class='form-control' style='height:34px;'>";
                    foreach($band as $band_cate){
                      echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
                    }
                echo "</select>";
              echo "</div>";

            echo "</div>";

            echo "<div role='tabpanel' class='tab-pane fade' id='profileEdit'>";
              echo "<br>";

              echo "<div class='input-group'>";
                echo "<div class='form-line'>";
                  echo "<label for='comment'>Detail:</label>";
                  echo "<textarea class='form-control' rows='5' id='Edit_detail_product' name='Edit_detail_product'></textarea>";
                echo "</div>";
              echo "</div>";

              echo "<div class='form-group'>";
                echo "<input type='hidden' id='old_product_picture' name='old_product_picture'>";
                echo "<label for='exampleFormControlFile1'>Example file input</label>";
                echo "<input type='file' class='form-control-file' id='Edit_product_picture' name='Edit_product_picture'>";
              echo "</div>";

            echo "</div>";




          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
            echo "<input type='submit' name='updateProduct1' class='btn btn-success' value='Update' id='updateProduct1'>";
            echo form_close();
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Edit Product -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/form-validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/sell.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
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

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>-->
</head>
</body>
</html>
<script>
$(document).ready(function(){
    $('#example').DataTable();

    $("#saveProduct").click(function (){
        var barcode_product = $("#barcode_product").val();
        var name_product  = $("#name_product").val();
        var cost_product  = $("#cost_product").val();
        var price_product  = $("#price_product").val();
        var quantity_product = $("#quantity_product").val();
        var cate_product  = $("#cate_product").val();
        var band_product  = $("#band_product").val();
        var product_picture  = $("#product_picture").val();
        $.ajax({
          url: "<?php echo base_url() ?>product/insert",
          type: "POST",
          data: {
            "Pro_barcode" : barcode_product,
            "Pro_name" : name_product,
            "Pro_cost" : cost_product,
            "Pro_price" : price_product,
            "Pro_quantity" : quantity_product,
            "Pro_cate" : cate_product,
            "Pro_band" : band_product,
            "Pro_picture" : product_picture
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("เพิ่มข้อมูลสินค้าสำเร็จ");
              $("#mdClose").click();
              location.reload();
          },
          error: function(){
            alert('Error....');
            $("#mdClose").click();
          }
        });
    })

    $("#updateProduct").click(function (){
        var up_id = $("#Edit_id_product").val();
        var up_barcode = $("#Edit_barcode_product").val();
        var up_name = $("#Edit_name_product").val();
        var up_cost  = $("#Edit_cost_product").val();
        var up_quantity = $("#Edit_quantity_product").val();
        var up_price  = $("#Edit_price_product").val();
        var up_cate  = $("#Edit_cate_product").val();
        var up_band  = $("#Edit_band_product").val();
        var old_pic = $("#old_product_picture").val();
        $.ajax({
          url: "<?php echo base_url() ?>product/update",
          type: "POST",
          data: {
            "up_id" : up_id,
            "up_barcode" : up_barcode,
            "up_name" : up_name,
            "up_cost" : up_cost,
            "up_price" : up_price,
            "up_quantity" : up_quantity,
            "up_cate" : up_cate,
            "up_band" : up_band,
            "old_pic" : old_pic
          },
          dataType: 'json',
          openloading : true,
          success: function(data){
              alert("แก้ไขข้อมูลสินค้าสำเร็จ");
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

function ShowDetail(id){
  var Detailid = id;
  window.location = '<?php echo base_url(); ?>product/detail/'+ Detailid;
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
        url: "<?php echo base_url() ?>product/delete_cate",
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

function editProductAjax (idProductEdit){
    var idEdit = idProductEdit;
    //$("#editProduct").modal('show');
    $.ajax({
      url: "<?php echo base_url() ?>product/form_update/",
      type: "POST",
      data: {
        "idEdit" : idEdit
      },
      dataType: 'json',
      success: function(data){
          $("#Edit_id_product").val(data.product_id);
          $("#Edit_barcode_product").val(data.product_barcode);
          $("#Edit_name_product").val(data.product_name);
          $("#Edit_cost_product").val(data.product_cost);
          $("#Edit_price_product").val(data.product_price);
          $("#Edit_quantity_product").val(data.product_quantity);
          var cate = data.product_cate;
          $('#Edit_cate_product option[value=' + cate + ']').attr('selected','selected');
          var band = data.product_band;
          $('#Edit_band_product option[value=' + band + ']').attr('selected','selected');
          $("#old_product_picture").val(data.product_picture);
          $("#Edit_detail_product").val(data.product_detail);
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
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
            url: "<?php echo base_url() ?>product/delete",
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

}//)
</script>
