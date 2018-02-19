function addCommas(nStr)
  {
  	nStr += '';
  	x = nStr.split('.');
  	x1 = x[0];
  	x2 = x.length > 1 ? '.' + x[1] : '';
  	var rgx = /(\d+)(\d{3})/;
  	while (rgx.test(x1)) {
  		x1 = x1.replace(rgx, '$1' + ',' + '$2');
  	}
  	return x1 + x2;
  }
$(document).ready(function(){
    $("#barcode").focus();

    var dis=0;
    $("totaldis").val(dis.toFixed(0));
    var total = $("#total").val();
    var discount = $("#totaldis").val();
    var newtotal = total-dis;
    $("#totalsellbeforecomma").val(newtotal.toFixed(2));
    $("#totalsell").val(addCommas(newtotal.toFixed(2)));

    $("#discount").change(function(){
        var total = $("#total").val();
        var discount = $("#discount").val();
        var dis = (total * discount)/100;
        var newtotal = total-dis;
        $("#totalsell").val(addCommas(newtotal.toFixed(2)));
        // toFixed ทำให้เป็นทศนิยม (2) คือ 2 ตำแหน่ง val เปรียบเสมือนการกำหนดต่าอารมณ์เหมือน = ให้ความคิดกู
    });

    $("#receive").change(function(){
        var total = $("#total").val();
        var receive = $("#receive").val();
        var newtotal = $("#totalsellbeforecomma").val();

          //if(receive<newtotal){
            //alert('คุณกรอกเงินไม่ครบ');
          //  $("#receive").focus();
          //}else{
            var change = receive - newtotal;
            $("#change").val(addCommas(change.toFixed(2)));

            /*if(change<0){
              alert("รับเงินมาไม่ครบตามจำนวน");
            }*/
          //}
    })
})
