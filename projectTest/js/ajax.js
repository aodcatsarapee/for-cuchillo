// JavaScript Document
$(document).ready(function(){
	// ส่วนของจังหวัดเมื่อมีการเปลี่ยนแปลง
	$("#prodcut_cate").change(function(){   //id=cate อ้างอิงจาก id ที่กำหนดใน form
		//$("#pro").empty();//ล้างข้อมูล  id=pro อ้างอิงจาก id ที่กำหนดใน form

		$.ajax({
			  url: "product/selectproduct",//ที่อยู่ของไฟล์เป้าหมาย  (รอการแก้ไข)
			  global: false,
			  type: "POST",//รูปแบบข้อมูลที่จะส่ง
			  data: ({ID : $(this).val(),TYPE : "product"}), //ข้อมูลที่ส่ง  { ชื่อตัวแปร : ค่าตัวแปร }
			  dataType: "JSON", //รูปแบบข้อมูลที่ส่งกลับ xml,script,json,jsonp,text
			  async:false,
			  success: function(jd) { //แสดงข้อมูลเมื่อทำงานเสร็จ โดยใช้ each ของ jQuery

							var opt="<option value=\"0\" selected=\"selected\">---สินค้า---</option>";
							$.each(jd, function(key, val){
								opt +="<option value='"+ val["product_id"] +"'>"+val["product_name"]+"</option>"
    						});
							$("#prodcut").html( opt );//เพิ่มค่าลงใน Select ของ product
		   	  }
		});
	});

//ส่วนของ function เพื่อเพิ่มข้อมูลประเภทสินค้าข้าไปก่อน
function Add(){
		$.ajax({
			  url: "sell",
			  global: false,
			  type: "POST",
			  data: ({TYPE : "product_cate"}),
			  dataType: "JSON",
			  async:false,
			  success: function(jd) {
					//console.log(jd);
							var opt="<option value=\"0\" selected=\"selected\">---เลือกประเภทสินค้า---</option>";
							$.each(jd, function(key, val){
								opt +="<option value='"+ val["cate_id"] +"'>"+val["cate_name"]+"</option>"
    						});
							$("#prodcut_cate").html( opt );
		   	  }
		});
});
