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
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>รายรับ - รายจ่าย
                                    <button class="btn btn-success " style="float: right;" data-toggle='modal'
                                            data-target='#addaccount'>เพิ่มรายรับ - รายจ่าย
                                    </button>

                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body" style="min-height: 600px;">
                        <table class="table table-responsive table-bordered table-hover" id="data-table">
                            <thead class="bg-primary">
                            <tr>
                                <th width="10%" class="text-center">ลำดับ</th>
                                <th>รายละเอียด</th>
                                <th class="text-center">รายรับ</th>
                                <th class="text-center">รายจ่าย</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $this->db->order_by('account_id','DESC');
                            $account = $this->db->get('account')->result();
                            foreach ($account as $list) {

                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $list->account_detail; ?></td>
                                    <td class="text-center"> <?php echo number_format($list->account_income, 2); ?> </td>
                                    <td class="text-center"> <?php echo number_format($list->account_expenses, 2); ?> </td>
                                    <td class="text-center"> <?php echo $list->account_type; ?> </td>
                                    <td width="25%" class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-warning  "
                                           onclick="update(<?php echo $list->account_id; ?>)"> เเก้ไข </a>

                                        <button class="btn btn-danger "  data-toggle='modal'
                                                data-target='#delete' onclick="del(<?php echo $list->account_id ?>)"> ลบ
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
            <div class="modal-header" style="background-color:green;">
                <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                <h4 class="modal-title" style="text-align:center;color:white;">เพิ่มรายรับ - รายจ่าย</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo base_url() . 'account/add' ?>"
                      enctype="multipart/form-data">

                    <div class="form-group ">
                        <label class="col-sm-3 control-label">ประเภท :</label>
                        <div class="col-sm-7">
                            <select name="account_type" id="account_type_edit" class="form-control"
                                    style="background-color: #E9E9E9;" required="required">
                                <option value="">เลือกประเภท</option>
                                <option value="รายรับ">รายรับ</option>
                                <option value="รายจ่าย">รายจ่าย</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">จำนวนเงิน :</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="number" name="money" id="money"
                                   placeholder="เช่น  100 200 300  " required="required"
                                   style="background-color: #E9E9E9;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">รายละเอียด :</label>
                        <div class="col-sm-7">
                            <textarea name="account_detail" id="account_detail" class="form-control" rows="4"
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
            <div class="modal-header" style="background-color:#FF9600;">
                <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                <h4 class="modal-title" style="text-align:center;color:white;">เเก้ไขข้อมูลรายรับ - รายจ่าย</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo base_url() . 'account/edit' ?>"
                      enctype="multipart/form-data">

                    <div class="form-group ">
                        <label class="col-sm-3 control-label">ประเภท :</label>
                        <div class="col-sm-7">
                            <input type="text" name="account_type_edit" id="test" value="" class="form-control"
                                   style="background-color: #E9E9E9;"  readonly>
                            <input type="hidden" name="account_id" id="account_id" value="">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">จำนวนเงิน :</label>
                        <div class="col-sm-7">
                            <input class="form-control" type="number" name="money_edit" id="money_edit" value=""
                                   placeholder="เช่น  100 200 300  " required="required"
                                   style="background-color: #E9E9E9;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group  ">
                        <label class="col-sm-3 control-label">รายละเอียด :</label>
                        <div class="col-sm-7">
                            <textarea name="account_detail_edit" id="account_detail_edit" class="form-control" rows="4"
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
                <h4 class="modal-title" style="color:white;">ลบข้อมูลรายรับ - รายจ่าย</h4>
            </div>
            <div class="modal-body">
                    <h2 class="text-center"> ต้องการลบข้อมูลใช่หรือไม่? </h2>
                <br>
                <br>
                <div class="text-center"><button class="btn btn-danger " id="check_del"> ลบข้อมูล</button> <button type="button"  class="  btn btn-default" data-dismiss="modal">ยกเลิก</button></div>
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
            url: "account/update_account/" + id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#editaccount').modal('show');

                $("#account_detail_edit").val(data.account.account_detail);
                $("#test").attr('value' ,data.account.account_type);

                $("#account_id").attr('value' ,data.account.account_id);

                if (data.account.account_type == 'รายรับ') {
                    $("#money_edit").attr('value', data.account.account_income);
                } else {
                    $("#money_edit").attr('value', data.account.account_expenses);
                }
            }
        });

    }

    function del(id) {
        $('#check_del').click(function () {
            $.ajax({
                url: "account/delete/" + id,
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


