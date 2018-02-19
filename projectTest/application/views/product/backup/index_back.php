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
$show=image_asset('icon/show.png');

echo "<div class='col-md-10'>";
    echo "<table class='table'>";
    echo "<thead class='thead-dark'>";
    echo "<tr class='thcenter'>";
      echo "<th colspan='9'>ข้อมูลสินค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addProduct'>",$add,"</button></th>";
    echo "</tr>";
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
                     echo "<td align='center'>".anchor('product/detail/'.$pro['product_id'],$show)."<button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editProduct' id='idProductEdit' onclick='editProductAjax(",$pro['product_id'],")'>",$edit,"</button>".anchor("product/delete/".$pro['product_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
                   echo "</tr>";
               }
          ?>
        </tbody>
    </table>


    <?php
    echo "</div>"; //center-side
?>


<!-- Start Add Product -->
<div class="modal fade" id="addProduct" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เพิ่มข้อมูลสินค้า</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdClose' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('product/insert');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
              echo "<label>รหัสบาร์โค้ด : </label> <input type='text' id='barcode_product' name='barcode_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ชื่อสินค้า : </label> <input type='text' id='name_product' name='name_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' id='cost_product' name='cost_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' id='price_product' name='price_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>จำนวนสินค้า : </label> <input type='text' id='quantity_product' name='quantity_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ประเภทของสินค้า : <select id='cate_product' name='cate_product' class='form-control' style='height:34px;'>";
                foreach($cate as $product_cate){
                  echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
                }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>แบนด์ของสินค้า : </label> <select id='band_product' name='band_product' class='form-control' style='height:34px;'>";
                  foreach($band as $band_cate){
                    echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
                  }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label for='exampleFormControlFile1'>Example file input</label>";
              echo "<input type='file' class='form-control-file' id='product_picture' name='product_picture'>";
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
        <div class="modal-header">
          <h4 class="modal-title">แก้ไขข้อมูลสินค้า</h4>
          <button type="button" style="margin-left:200px;" class="btn btn-default" id='mdCloseEdit' data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('product/update');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
              echo "<input type='hidden' id='Edit_id_product' name='Edit_id_product'>";
              echo "<label>รหัสบาร์โค้ด : </label> <input type='text' id='Edit_barcode_product' name='Edit_barcode_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ชื่อสินค้า : </label> <input type='text' id='Edit_name_product' name='Edit_name_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' id='Edit_cost_product' name='Edit_cost_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' id='Edit_price_product' name='Edit_price_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>จำนวนสินค้า : </label> <input type='text' id='Edit_quantity_product' name='Edit_quantity_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ประเภทของสินค้า : <select id='Edit_cate_product' name='Edit_cate_product' class='form-control' style='height:34px;'>";
                foreach($cate as $product_cate){
                  echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
                }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>แบนด์ของสินค้า : </label> <select id='Edit_band_product' name='Edit_band_product' class='form-control' style='height:34px;'>";
                  foreach($band as $band_cate){
                    echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
                  }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<input type='hidden' id='old_product_picture' name='old_product_picture'>";
              echo "<label for='exampleFormControlFile1'>Example file input</label>";
              echo "<input type='file' class='form-control-file' id='Edit_product_picture' name='Edit_product_picture'>";
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

function editProductAjax (idProductEdit){
    var idEdit = idProductEdit;
    $("#editEmp").click();
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
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });

}//)
</script>
