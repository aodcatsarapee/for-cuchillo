function site_url(url){
        var bu = "<?php echo base_url(); ?>";
        url = (url)?url:"";
        return bu + "index.php/" + url;
    }

$(document).ready(function(){
    $('#show_debtor').on('click',function(){
      var cus_id = $("#cus_id").val();
      //var baseurl = <?php echo base_url();?>

      $.ajax({
        type : "POST",
        datatype : "json",
        url : site_url("debtor/data"),
        data : {"cus_id" : $("#cus_id").val(), "sell_order_id" : $("#cus_id").val()},
        success : function(data){
          console.log(data);

          $("#testajax").val();
        }
      });
    });
});
