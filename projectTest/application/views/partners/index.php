
<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/23/2018
 * Time: 14:38
 */
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>ร้านค้า

                                    <button class="btn btn-success " style="float: right;" data-toggle='modal'
                                            data-target='#addaccount'>เพิ่มร้านค้า
                                    </button>


                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" style="min-height: 600px;">
                        <table class="table table-responsive table-bordered table-hover" id="data-table">
                            <thead>
                            <tr>
                                <th width="10%" class="text-center">ลำดับ</th>
                                <th>ชื่อ</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $this->db->order_by('partners_id', 'DESC');
                            $account = $this->db->get('partners')->result();
                            foreach ($account as $list) {

                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $list->partners_name; ?></td>
                                    <td class="text-center"> <?php echo $list->partners_detail; ?> </td>
                                    <td width="25%" class="text-center">
                                        <button class="btn btn-warning " data-toggle='modal'
                                                onclick="update(<?php echo $list->partners_id ?>)"> เเก้ไข
                                        </button>
                                        <button class="btn btn-danger " data-toggle='modal'
                                                data-target='#delete' onclick="del(<?php echo $list->partners_id ?>)"> ลบ
                                        </button>

                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
</section>
<div class="modal fade" id="addaccount" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color:#336699;">
            <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
            <h4 class="modal-title" style="text-align:center;color:white;">เพิ่มร้านค้า</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo base_url() . 'partners/add' ?>"
                      enctype="multipart/form-data">

                    <br/>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">ชื่อ :</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" name="partners_name" id="partners_name"
                                   placeholder="กรอกชื่อร้านค้า " required="required"
                                   style="background-color: #E9E9E9;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">รายละเอียด :</label>
                        <div class="col-sm-7">
                            <textarea name="partners_detail" id="partners_detail" class="form-control" rows="4"
                                      required="required" style="background-color: #E9E9E9;"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value=" บันทึกข้อมูล "
                           style="float: right;font-size: 15px;">
                </form>
                <br>
                <br>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editaccount" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color:#336699;">
            <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
            <h4 class="modal-title" style="text-align:center;color:white;">แก้ไขข้อมูลร้านค้า</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo base_url() . 'partners/edit' ?>"
                      enctype="multipart/form-data">

                    <input type="hidden" name="partners_id" id="partners_id" value="">

                    <br/>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">ชื่อ :</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="text" name="partners_name_edit" id="partners_name_edit"
                                   placeholder="กรอกชื่อร้านค้า " required="required"
                                   style="background-color: #E9E9E9;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">รายละเอียด :</label>
                        <div class="col-sm-7">
                            <textarea name="partners_detail_edit" id="partners_detail_edit" class="form-control" rows="4"
                                      required="required" style="background-color: #E9E9E9;"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-warning" value=" บันทึกข้อมูล "
                           style="float: right;font-size: 15px;">
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FB483A;">
                    <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                    <h4 class="modal-title" style="color:white;">ลบข้อมูลร้านค้า</h4>
                </div>
                <div class="modal-body">
                    <h2 class="text-center"> ต้องการลบข้อมูลใช่หรือไม่? </h2>
                    <br>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-danger " id="check_del"> ลบข้อมูล</button>
                        <button type="button" class="  btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/waves.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/admin.js"></script>
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--Frontend/js/index.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.sparkline.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.categories.js"></script>-->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/morris.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Frontend/js/jquery.slimscroll.js"></script>
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--Frontend/js/bootstrap-select.js"></script>-->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
    $(function () {
        $('#data-table').DataTable({});
    })

    function update(id) {
        $.ajax({
            url: "partners/update/" + id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#editaccount').modal('show');
                $("#partners_detail_edit").val(data.partners.partners_detail);
                $("#partners_name_edit").attr('value', data.partners.partners_name);
                $("#partners_id").attr('value', data.partners.partners_id);
            }
        });

    }

    function del(id) {
        $('#check_del').click(function () {
            $.ajax({
                url: "partners/delete/" + id,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    $('#delete').modal('hide');
                    location.reload();
                }
            });
        })
    }
</script>
</body>

</html>
