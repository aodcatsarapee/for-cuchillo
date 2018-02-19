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
echo "<div class='col-md-9'>";

      /*echo "<table  border='0' align='center' cellspacing='1' class='display' id='example'>";
      echo "<thead>";
        echo "<tr>";
          echo "<th align='center'>id</th>";
          echo "<th align='center'>name</th>";
          echo "<th align='center'>city</th>";
          echo "<th align='center'>img</th>";
          echo "<th align='center'>date</th>";
          echo "<th align='center'>edit</th>";
          echo "<th align='center'>del</th>";
        echo "</tr>";
      echo "</thead>";*/




      /*echo "<table class='table'>";
      echo "<thead class='thead-dark'>";
      echo "<tr class='thcenter'>";
        echo "<th colspan='5'>จัดการข้อมูลสินค้า</th>";
        echo "<td align='right'><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#addProduct'>",$add,"</button></td>";
      echo "</tr>";
      echo "<tr class='thcenter'>";
        echo "<th>รหัสบาร์โค้ด</th>";
        echo "<th>ชื่อสินค้า</th>";
        echo "<th>ราคาต้นทุน/ชิ้น</th>";
        echo "<th>ราคา/ชิ้น</th>";
        echo "<th>จำนวนคงเหลือ</th>";
        echo "<th>Action</th>";
      echo "</tr>";
      echo "</thead>";*/
      /*echo "<button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#addProduct'>",$add,"</button>";
      echo "<table  border='0' align='center' cellspacing='1' class='display' id='example'>";
      echo "<thead>";
        echo "<tr>";
          echo "<th>รหัสบาร์โค้ด</th>";
          echo "<th>ชื่อสินค้า</th>";
          echo "<th>ราคาต้นทุน/ชิ้น</th>";
          echo "<th>ราคา/ชิ้น</th>";
          echo "<th>จำนวนคงเหลือ</th>";
          echo "<th>Action</th>";
        echo "</tr>";
      echo "</thead>";

   if(count($product)==0){
      echo "<tbody>";
      echo "<tr>";
        echo "<td colspan='5' align='center'><b>ไม่มีข้อมูลสินค้า</b></td>";
      echo "</tr>";
      echo "</tbody>";
    }else{
      foreach($product as $pro){
            echo "<tbody>";
            echo "<tr align='center '>";
              echo "<td>".$pro['product_barcode']."</td>";
              //echo "<td>".$detail['product_name']."</td>";
              echo "<td>".anchor("product/detail/".$pro['product_id'],$pro['product_name']),"</td>";
              echo "<td>".number_format($pro['product_cost'])."</td>";
              echo "<td>".number_format($pro['product_price'])."</td> ";
              if($pro['product_quantity']<10){
                echo "<td class='warring'>".number_format($pro['product_quantity'])."</td>";
              }else{
                echo "<td>".$pro['product_quantity']."</td>";
              }
              echo "<td align='center'><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editProduct' id='idProductEdit' onclick='editProductAjax(",$pro['product_id'],")'>",$edit,"</button>".anchor("product/delete/".$pro['product_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
            echo "</tr>";
            echo "</tbody>";
        }
        //echo "</tbody>";
      echo "</table>";
    }*/

    echo "<table class='table'>";
    echo "<thead class='thead-dark'>";
    echo "<tr class='thcenter'>";
      echo "<th colspan='9'>จัดการข้อมูลสินค้า<button type='button' style='background-color:white;float:right;' class='btn' data-toggle='modal' data-target='#addProduct'>",$add,"</button></th>";
      //echo "<td align='right'></td>";
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
                     //echo "<td>".$detail['product_name']."</td>";
                     echo "<td>".anchor("product/detail/".$pro['product_id'],$pro['product_name']),"</td>";
                     echo "<td>".number_format($pro['product_cost'])."</td>";
                     echo "<td>".number_format($pro['product_price'])."</td> ";
                     if($pro['product_quantity']<10){
                       echo "<td class='warring'>".number_format($pro['product_quantity'])."</td>";
                     }else{
                       echo "<td>".$pro['product_quantity']."</td>";
                     }
                     echo "<td align='center'><button type='button' style='background-color:white;' class='btn' data-toggle='modal' data-target='#editProduct' id='idProductEdit' onclick='editProductAjax(",$pro['product_id'],")'>",$edit,"</button>".anchor("product/delete/".$pro['product_id'],$del,array("onclick"=>"javascript:return confirm('คุณต้องการลบหรือไม่ ?');"))."</td>";
                   echo "</tr>";
               }
          ?>
        </tbody>
    </table>


    <?php
          //echo $this->pagination->create_links();
    echo "<br><br>";
    echo anchor("owner/home","กลับหน้าแรก");
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
          echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
              echo "<label>รหัสบาร์โค้ด : </label> <input type='text' id='barcode_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ชื่อสินค้า : </label> <input type='text' id='name_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' id='cost_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' id='price_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>จำนวนสินค้า : </label> <input type='text' id='quantity_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ประเภทของสินค้า : <select id='cate_product' class='form-control' style='height:34px;'>";
                foreach($cate as $product_cate){
                  echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
                }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>แบนด์ของสินค้า : </label> <select id='band_product' class='form-control' style='height:34px;'>";
                  foreach($band as $band_cate){
                    echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
                  }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label for='exampleFormControlFile1'>Example file input</label>";
              echo "<input type='file' class='form-control-file' id='product_picture'>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='saveProduct'>SAVE</button>
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
          echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
            echo "<div class='form-group'>";
              echo "<input type='hidden' id='Edit_id_product'>";
              echo "<label>รหัสบาร์โค้ด : </label> <input type='text' id='Edit_barcode_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ชื่อสินค้า : </label> <input type='text' id='Edit_name_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ต้นทุนสินค้า/ชิ้น : </label> <input type='text' id='Edit_cost_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ราคาขาย/ชิ้น : </label> <input type='text' id='Edit_price_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>จำนวนสินค้า : </label> <input type='text' id='Edit_quantity_product' class='form-control'>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>ประเภทของสินค้า : <select id='Edit_cate_product' class='form-control' style='height:34px;'>";
                foreach($cate as $product_cate){
                  echo "<option value=",$product_cate['cate_id'],">",$product_cate['cate_name'],"</option>";
                }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label>แบนด์ของสินค้า : </label> <select id='Edit_band_product' class='form-control' style='height:34px;'>";
                  foreach($band as $band_cate){
                    echo "<option value=",$band_cate['band_id'],">",$band_cate['band_name'],"</option>";
                  }
              echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
              echo "<label for='exampleFormControlFile1'>Example file input</label>";
              echo "<input type='file' class='form-control-file' id='product_picture'>";
            echo "</div>";
          echo form_close();
          ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='updateProduct'>SAVE</button>
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
        //var product_picture  = $("#id_card").val();
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
            "Pro_band" : band_product
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
            "up_band" : up_band
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
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
}//)
</script>
