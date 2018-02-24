<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/23/2018
 * Time: 14:36
 */

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('Pdf');
    }

    public function index()
    {
        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header", $data);
        $this->load->view("account/index");
    }

    public function add()
    {
        {
            $account_type = $_POST['account_type'];
            $account_detail = $_POST['account_detail'];
            $money = $_POST['money'];

            if ($account_type == 'รายรับ') {

                $account = array(

                    "account_detail" => $account_detail,
                    "account_income" => $money,
                    "account_type" => $account_type,
                    "account_datasave" => date('Y-m-d H:i:s'),
                );

                $this->db->insert('account', $account);
            } else {
                $account = array(

                    "account_detail" => $account_detail,
                    "account_expenses" => $money,
                    "account_type" => $account_type,
                    "account_datasave" => date('Y-m-d H:i:s'),
                );

                $this->db->insert('account', $account);

            }
        }
        redirect(base_url() . 'account');
    }

    public function update_account($account_id)
    {
        $this->db->where('account_id', $account_id);
        $data['account'] = $this->db->get('account')->row();
        echo json_encode($data);
    }

    public function edit()
    {
        $account_id = $this->input->post('account_id');
        $account_type = $this->input->post('account_type_edit');
        $account_detail = $this->input->post('account_detail_edit');
        $money = $this->input->post('money_edit');

        if ($account_type == 'รายรับ') {
            $account = array(
                "account_detail" => $account_detail,
                "account_income" => $money,
                "account_type" => $account_type,
                "account_datasave" => date('Y-m-d H:i:s'),
            );

            $this->db->where('account_id', $account_id);
            $this->db->update('account', $account);
        } else {
            $account = array(
                "account_detail" => $account_detail,
                "account_expenses" => $money,
                "account_type" => $account_type,
                "account_datasave" => date('Y-m-d H:i:s'),
            );

            $this->db->where('account_id', $account_id);
            $this->db->update('account', $account);

        }
        redirect(base_url() . 'account');
    }

    public function delete($account_id)
    {
        $this->db->where('account_id', $account_id);
        $this->db->delete('account');
        $data['status'] = true;
        echo json_encode($data);
    }
    public function Account_all_1()
    {


        // สร้าง object สำหรับใช้สร้าง pdf
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // กำหนดรายละเอียดของ pdf
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Account');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        $pdf->setPrintHeader(false);

        // กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // กำหนด margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // กำหนดการแบ่งหน้าอัตโนมัติ
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // กำหนดรูปแบบการปรับขนาดของรูปภาพ
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // กำหนดฟอนท์
        // ฟอนท์ freeserif รองรับภาษาไทย
        $pdf->SetFont('freeserif', '', 14, '', true);



        // เพิ่มหน้า pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->AddPage('L', 'A4');

        // กำหนดเงาของข้อความ
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// กำหนดเนื้อหาข้อมูลที่จะสร้าง pdf ในที่นี้เราจะกำหนดเป็นแบบ html โปรดระวัง EOD; โค้ดสุดท้ายต้องชิดซ้ายไม่เว้นวรรค



        $id=$_GET['id'];

        $date_start= date($_GET['date_start']);

        $date_end= date($_GET['date_end']);


        $nice_date_start = date('d-m-Y', strtotime($date_start));

        $nice_date_end = date('d-m-Y', strtotime($date_end));



        $tbl = '<table cellspacing="0" cellpadding="8" >
                   <tr>
                          <th style="border: 1px solid #000000;  text-align:center;" colspan="4" >   ข้อมูลรายรับ-รายจ่าย<br>ระหว่างวันที่ '.$nice_date_start.' ถึงวันที่ '.$nice_date_end.'</th>

                   </tr> ';


        // ถึงวันที่ '.$nice_date_end

        // -----------------------------------------------------------------------------
        $tbl = $tbl . ' <thead> <tr>
         <th  width="20%" style="border: 1px solid #000000;  text-align:center;"><b> รหัสรายรับ-รายจ่าย</b></th>
          <th width="20%"  style="border: 1px solid #000000;  text-align:center;"><b>รายละเอียด</b></th>
          <th width="15%"  style="border: 1px solid #000000;  text-align:center;"><b>รายรับ</b></th>
           <th width="14%"  style="border: 1px solid #000000;  text-align:center;"><b>รายจ่าย</b></th>
          <th width="17%" style="border: 1px solid #000000;  text-align:center;"><b>ประเภท</b></th>
          <th width="14%" style="border: 1px solid #000000;  text-align:center;"><b>ว/ด/ป</b></th>
          
      </tr>  </thead>';


        $this->load->model('Genpdf_models');

        $accounts=$this->Genpdf_models->Account_all_1($id,$date_start,$date_end);

        foreach ($accounts as $value) {
            # code...
            $date=date_create($value['account_datasave']);

            $date_format = date_format($date,"d-m-Y");


            $tbl .='
    <tbody>
    <tr nobr="true">
    <td width="20%"  style="border: 1px solid #000000;  text-align:center">'.$value['account_id'].' </td>
    <td width="20%" style="border: 1px solid #000000;  text-align:center">'.$value['account_detail'].' </td>
    ';


            if($value['account_income']!=0){

                $tbl .='
    <td width="15%" style="border: 1px solid #000000;  text-align:center">'.number_format($value['account_income'],2).' บาท</td>
    <td  width="14%" style="border: 1px solid #000000;  text-align:center"> - </td>
    ';
            }else{
                $tbl .='
    <td width="15%"  style="border: 1px solid #000000;  text-align:center"> - </td>
    <td   width="14%" style="border: 1px solid #000000;  text-align:center"> '.number_format($value['account_expenses'],2).' บาท </td>
    ';

            }

            $tbl .='
    <td  width="17%" style="border: 1px solid #000000;  text-align:center">'.$value['account_type'].' </td>
    <td style="border: 1px solid #000000;  text-align:center">'.$date_format.'</td>

    </tr>

    ';


        }

        if(count($accounts)==0){

            $tbl = $tbl . '
      <tr>
          <td  width="20%" style="border: 1px solid #000000;  text-align:center; ">รวม</td>
          <td  width="20%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td  width="15%" style="border: 1px solid #000000;  text-align:center"> 0 บาท</td>
          <td width="14%" style="border: 1px solid #000000;  text-align:center"> 0 บาท </td>
          <td  width="17%" style="border: 1px solid #000000;  text-align:center"> - </td>
          <td style="border: 1px solid #000000;  text-align:center"> - </td>
          
      </tr>

      ';

        }else{
            $total1=0;
            $total2=0;
            foreach ($accounts as $key => $value) {

                $total1+=$value['account_income'];
                $total2+=$value['account_expenses'];


                if ($value === end($accounts)) {

                    $tbl = $tbl . ' 
     <tr>
           <td style="border: 1px solid #000000;  text-align:center; ">รวม</td>
           <td style="border: 1px solid #000000;  text-align:center"> - </td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total1,2).' บาท</td>
           <td style="border: 1px solid #000000;  text-align:center"> '.number_format($total2,2).' บาท </td>
            <td style="border: 1px solid #000000;  text-align:center"> - </td>
             <td style="border: 1px solid #000000;  text-align:center"> - </td>        
          
      </tr>
<tbody>
      ';

                }
            }
        }

        $tbl = $tbl . '</table>';




        $pdf->writeHTML($tbl, true, false, false, false, '');


        // สร้างข้อเนื้อหา pdf ด้วยคำสั่ง writeHTMLCell()
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// write some JavaScript code
        $js = <<<EOD

EOD;

// force print dialog
        $js .= 'print(true);';

// set javascript
        $pdf->IncludeJS($js);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('amount_detail.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
    }
}