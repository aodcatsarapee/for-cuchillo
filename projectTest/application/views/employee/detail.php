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
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/satitporn.js"></script>
<style type='text/css'>
  .warring{background-color:#FFFF99;color:red;}
  .thcenter th{
    text-align:center;
  }

  .textcolor a:visited{color:white !important;}
</style>
</head>
<body>
<section class="content">
    <div class="container-fluid">
        <div class="alert alert-success hide">
          <strong>Update Data Success</strong>
        </div>
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>ข้อมูลพนักงาน</h2>
                                <input type='hidden' id='check_status'>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                          <!--<a href='javascript:void(0);' onclick="EditEmp(<?php echo $result['user_id']; ?>)" style='margin-right:20px;' class="btn btn-default btn-lg waves-effect waves-light-blue">แก้ไข </a>-->
                          <?php
                            $back=image_asset('icon/back.png');
                            if($this->session->userdata['type'] == '1' || $this->session->userdata['type'] == '2'){
                              echo "<a href=",base_url(),"employee class='btn btn-primary btn-lg waves-effect waves-light'>BACK </a>";
                            }else if($this->session->userdata['type'] == '3'){
                              echo "<a href=",base_url(),"sell class='btn btn-primary btn-lg waves-effect waves-light'>BACK </a>";
                            }
                          ?>
                        </ul>
                    </div>
                    <div class="body" id='mainbody' style="height:600px;">
                      <div class="col-1 col-sm-1 col-md-1">
                      </div>

                      <div class="col-4 col-sm-4 col-md-4">
                        <div class="card">
                          <div class="header">
                              <h2 align=center><?php echo $result['emp_prename']," ",$result['emp_name']," ",$result['emp_lastname']; ?></h2>
                          </div>
                          <div class="body">
                              <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                                  <!-- Wrapper for slides -->
                                  <div class="carousel-inner" role="listbox">
                                      <div class="item active">
                                           <img src="<?php echo base_url(); ?>images/employee/<?php echo $result['emp_picture']; ?>" style="width:300px;height:300px;">
                                          <div class="carousel-caption">
                                              <h2></h2>
                                              <p></p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>

                      <div class="col-1 col-sm-1 col-md-1">
                      </div>

                      <div class="col-6 col-md-4">
                          <?php
                            echo form_open();  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>Username : </label> <input type='text' value=",$result['user_name']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>Password : </label> <input type='text' value=",$result['user_password']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>ตำแหน่ง : </label> <input type='text' value=",$result['position_name']," class='form-control' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>รหัสบัตรประชาชน : </label> <input type='text' value=",$result['emp_idcard']," class='form-control _number' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>อายุ : </label> <input type='text' value=",$result['emp_age']," class='form-control _number' disabled>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label for='comment'>ที่อยู่:</label>";
                                echo "<textarea class='form-control' rows='5' id='comment' disabled>",$result['emp_address'],"</textarea>";
                              echo "</div>";
                            echo "</div>";

                            echo "<div class='row clearfix'>";
                              echo "<div class='form-line'>";
                                echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' value=",$result['emp_tel']," class='form-control _number' disabled>";
                              echo "</div>";
                            echo "</div>";
                            echo form_close();
                          ?>
                      </div>
                    </div>
              </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>

<!-- Start Edit Emp -->
<div class="modal fade" id="editEmp" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#336699;">
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
          <h4 class="modal-title" style="text-align:center;color:white;">แก้ไขข้อมูลส่วนตัว</h4>
        </div>
        <div class="modal-body">

          <?php
          echo form_open_multipart('employee/update_byEmp/');  //1.ตำแหน่งโฟร์เดอร์ที่จะวิ่งไป(ชื่อไฟล์ตรง Controllers) 2.ไฟล์ที่จะให้วิ่งไป(ชื่อ method ท่ี่เรียกใช้)
          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<input type='hidden' id='edit_userid' name='edit_userid' class='form-control'>";
              echo "<input type='hidden' id='edit_usernameV2' name='edit_usernameV2' class='form-control _number' required>";
              echo "<label>Username : </label> <input type='text' id='edit_username' name='edit_username' readyonly class='form-control _number' required>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label>Password : </label> <input type='text' id='edit_password' name='edit_password' class='form-control' maxlength='10' required>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<label>คำนำหน้า : </label>";
            echo "<input type='radio' id='edit_prename1' name='edit_prename' class='with-gap' value='นาย'>";
            echo "<label for='prename'>นาย</label>";

            echo "<input type='radio' id='edit_prename2' name='edit_prename' class='with-gap' value='นาง'>";
            echo "<label for='prename1'>นาง</label>";

            echo "<input type='radio' id='edit_prename3' name='edit_prename' class='with-gap' value='นางสาว'>";
            echo "<label for='prename2'>นางสาว</label>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label>ชื่อ : </label> <input type='text' id='edit_fristname' name='edit_fristname' class='form-control' required>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label>นามสกุล : </label> <input type='text' id='edit_lastname' name='edit_lastname' class='form-control' required>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label>รหัสบัตรประชาชน : </label> <input type='text' id='edit_id_card' name='edit_id_card' class='form-control _number' maxlength='13' required>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label>อายุ : </label> <input type='text' id='edit_age' name='edit_age' class='form-control _number'>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label for='comment'>ที่อยู่:</label>";
              echo "<textarea class='form-control' rows='5' id='edit_address' name='edit_address'></textarea>";
            echo "</div>";
          echo "</div>";

          echo "<div class='input-group'>";
            echo "<div class='form-line'>";
              echo "<label>เบอร์โทรศัพท์ : </label> <input type='text' id='edit_tel' name='edit_tel' class='form-control _number' maxlength='10'>";
            echo "</div>";
          echo "</div>";

            echo "<div class='form-group'>";
              echo "<input type='hidden' id='old_emp_picture' name='old_emp_picture'>";
              echo "<label for='exampleFormControlFile1'>Example file input</label>";
              echo "<input type='file' class='form-control-file' id='Edit_emp_picture' name='Edit_emp_picture'>";
            echo "</div>";
            ?>

          <span style='padding-left:400px;'></span>
        </div>
        <div class="modal-footer">
          <?php
          echo "<input type='submit' class='btn btn-success' value='Update' name='Update' id='Update'>";
          echo form_close();
          //<button type="button" class="btn btn-success" id='updateEmp'>UPDATE</button>
          ?>
        </div>
      </div>

    </div>
  </div>
<!-- End Edit Emp -->

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/notifications.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap-notify.js"></script>
<!--
-->
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
  $(document).ready(function(){
    $(window).resize(function() {
      var windowWidth = jQuery(window).width();
      if(windowWidth < '975' ){
        $("#mainbody").css('height','1000px');
      }else{
        $("#mainbody").css('height','600px');
      }
    });
  });

  function EditEmp(id){
    var idEdit = id;
    $("#editEmp").modal();
    $.ajax({
      url: "<?php echo base_url() ?>employee/form_update/",
      type: "POST",
      data: {
        "idEdit" : idEdit
      },
      dataType: 'json',
      //openloading : true,
      success: function(data){
          $("#edit_userid").val(data.user_id);
          $("#edit_username").click();
          $("#edit_usernameV2").val(data.user_name);
          $("#edit_username").val(data.user_name);
          $("#edit_password").val(data.user_password);
          var Eprename = data.emp_prename;
          if(Eprename == "นาย"){
            $("#edit_prename1").prop("checked", true);
            //$("#edit_prename2").prop("checked", false);
            //$("#edit_prename3").prop("checked", false);
          }else if(Eprename == "นาง"){
            //$("#edit_prename1").prop("checked", false);
            $("#edit_prename2").prop("checked", true);
            //$("#edit_prename3").prop("checked", false);
          }else{
            //$("#edit_prename1").prop("checked", false);
            //$("#edit_prename2").prop("checked", false)
            $("#edit_prename3").prop("checked", true);
          }

          $("#edit_fristname").val(data.emp_name);
          $("#edit_lastname").val(data.emp_lastname);
          $("#edit_id_card").val(data.emp_idcard);
          $("#edit_age").val(data.emp_age);
          $("#edit_address").val(data.emp_address);
          $("#edit_tel").val(data.emp_tel);
          $("#edit_position").val(data.user_position);
          $("#old_emp_picture").val(data.emp_picture);
      },
      error: function(){
        alert('Error....');
        $("#mdClose").click();
      }
    });
  }
</script>
