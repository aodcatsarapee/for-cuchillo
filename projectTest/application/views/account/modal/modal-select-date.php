
<div class="modal  fade" id="modal-select-date-account">
  <div class="modal-dialog " style="width: 500px;">
    <div class="modal-content ">
      <div class="modal-header" style="background-color:#336699;">
        <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
        <h4 class="modal-title" style="text-align:center;color:white;">เลือกวันที่</h4>
      </div>
      <div class="modal-body" id="insert" style="font-size: 15px;">

           <div class="date_alert" style=" color: red; margin-left: 510px; "> </div>

          <form class="form-horizontal" method="POST" id="select-date_account" name="select-date_account" enctype="multipart/form-data" >
           <div class="form-group ">
            <label class="col-sm-3 control-label" >วันที่ :</label>
            <div class="col-sm-7">

                <input type='date'  name='date_start' id='date_start' class='form-control' style="background-color:#E9E9E9;" >

            </div>
          </div>
              <br>

          <div class="form-group ">
            <label class="col-sm-3 control-label" >ถึง :</label>
            <div class="col-sm-7">

               <input type='date'  name='date_end' id='date_end' class='form-control'  style="background-color:#E9E9E9;" >

            </div>
          </div>

           <input type="submit" class="btn btn-default" value=" ตกลง " style="float: right;font-size: 15px;">
        </form>
        <br><br>
      </div>

    </div>
  </div>
</div>
