<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
echo js_asset('thaibath.js');
/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set font

//$pdf->SetFont('angsanaupc', '', 10); // อันนี้สระลอย

//กำหนดรายละเอียดของ pdf
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Sattiporn Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('thsarabun ', '', 15); //ภาษาไทยใช้ได้

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example

//ส่วนหัวของ Report
$title = <<<EOD
<h2>ร้าน สถิตย์พรอะไหล่<h3>227 หมู่.2 ต.ตลาดใหญ่ อ.ดอยสะเก็ด จ.เชียงใหม่ 50220</h3></h2>

<h3>ใบแจ้งการชำระเงิน</h3>
EOD;
$uptitle = <<<EOD
<h1>ใบแจ้งการชำระเงิน<h1>
EOD;
$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);

$detail_debtor = '<p>ชื่อผู้ซื้อ : '.$detail['cus_name'].'</p>';
$detail_debtor .= '<p>ที่อยู่ : '.$detail['cus_address'].'</p>';
$pdf->WriteHTMLCell(0, 0, '', '', $detail_debtor, 0, 1, 0, true, 'L', true);
//$pdf->WriteHTMLCell(0, 0, '', '', $uptitle, 0, 1, 0, true, 'C', true);
$table = '<table>'; //style="border:1px solid black; padding:1px;"
$table .= '<tr style="background-color:#ccc;">
                <th style="border:1px solid black;">ลำดับ</th>
                <th colspan="3" style="border:1px solid black;">รายการ</th>
								<th style="border:1px solid black;">จำนวนสินค้า</th>
                <th style="border:1px solid black;">หน่วยละ</th>
                <th style="border:1px solid black;">จำนวนเงิน</th>

          </tr>';
          foreach ($product as $pro) {
						$numno+=1;
						$vat = $pro['sell_detail_price'] * 0.10;
						$prototal = $pro['sell_detail_price'] + $vat;
						$sumDetail = $prototal*$pro['sell_detail_amount'];
            $table .= '<tr>
                            <td style="border-left:1px solid black;border-right:1px solid black;">'.$numno.'</td>
                            <td colspan="3" style="=text-align:left;">'.$pro['sell_detail_name'].'</td>
														<td style="text-align:right;border-left:1px solid black;border-right:1px solid black;">'.$pro['sell_detail_amount'].' อัน</td>
                            <td style="text-align:right;border-right:1px solid black;">'.number_format($prototal).' บาท</td>
                            <td style="border-right:1px solid black; text-align:right;">'.number_format($prototal*$pro['sell_detail_amount']).' บาท</td>
                      </tr>';
          }
					$ee =count($product)*2;
					$loop = 10 - $ee;
					for($i=0; $i<$loop; $i++){
						$table .= '<tr>
														<td style="border-left:1px solid black;"></td>
														<td colspan="3" style="border-left:1px solid black;"></td>
														<td style="border-left:1px solid black;"></td>
														<td style="border-left:1px solid black;"></td>
														<td style="border-left:1px solid black;border-right:1px solid black;"></td>
											</tr>';
					}
					$baht=$pro['sell_total'];

					//$numthai = ThaiBaht('1000');
					$table .= '<tr>
													<td style="border-top:1px solid black;text-align:left;"><b>หมายเหตุ</b></td>
													<td style="border-top:1px solid black;" id=numthai></td>
													<td style="border-top:1px solid black;"></td>
													<td style="border-top:1px solid black;border-right:1px solid black;"></td>
													<td style="border-top:1px solid black;"></td>
													<td style="border-top:1px solid black;border-right:1px solid black;text-align:right;">รวมราคาทั้งสิ้น</td>
													<td style="border-top:1px solid black;border-right:1px solid black;text-align:right;">'.sum($sumDetail).' บาท</td>
										</tr>';
					$table .= '<tr>
													<td></td>
													<td></td>
													<td></td>
													<td style="border-right:1px solid black;"></td>
													<td colspan="2" style="border-bottom:1px solid black;border-right:1px solid black;text-align:right;">ผ่อนชำระ 6 เดือน เดือนละ</td>
													<td style="border-right:1px solid black;border-bottom:1px solid black;text-align:right;">'.ceil($pro['sell_total']/6).' บาท</td>
										</tr>';
					$table .= '<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td style="border-bottom:1px solid black;border-left:1px solid black;"></td>
													<td style="border-bottom:1px solid black;border-right:1px solid black;text-align:right;">รวมเงินทั้งสิ้น</td>
													<td style="border-right:1px solid black;border-bottom:1px solid black;text-align:right;">'.$pro['sell_total'].' บาท</td>
										</tr>';
$table .= '</table>';

$tableEE = '<table style="border:1px solid black; padding:1px;">';
	$tableEE .= '<tr>
									<td style="border-left:1px solid black;"></td>
									<td colspan="3" style="border-left:1px solid black;"></td>
									<td style="border-left:1px solid black;"></td>
									<td style="border-left:1px solid black;"></td>
									<td style="border-left:1px solid black;border-right:1px solid black;"></td>
						</tr>';
$tableEE .= '</table>';

$pdf->WriteHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);

$text = '<p></p>';
$text .= '<p>ผู้ออกใบแจ้งการชำระเงิน <br><br> ______________________ <br>('.$detail['emp_prename'].' '.$detail['emp_name'].' '.$detail['emp_lastname'].')</p>';
//$text .= '<p>(นาย สรวิศ ศิรินาม)</p>';
$pdf->WriteHTMLCell(0, 0, '', '', $text, 0, 1, 0, true, 'C', true);

// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>
<script>


function ThaiNumberToText(Number)
{
	Number = Number.replace (/๐/gi,'0');
	Number = Number.replace (/๑/gi,'1');
	Number = Number.replace (/๒/gi,'2');
	Number = Number.replace (/๓/gi,'3');
	Number = Number.replace (/๔/gi,'4');
	Number = Number.replace (/๕/gi,'5');
	Number = Number.replace (/๖/gi,'6');
	Number = Number.replace (/๗/gi,'7');
	Number = Number.replace (/๘/gi,'8');
	Number = Number.replace (/๙/gi,'9');
	return 	ArabicNumberToText(Number);
}
function ArabicNumberToText(Number)
{
	var Number = CheckNumber(Number);
	var NumberArray = new Array ("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า", "สิบ");
	var DigitArray = new Array ("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
	var BahtText = "";
	if (isNaN(Number))
	{
		return "ข้อมูลนำเข้าไม่ถูกต้อง";
	} else
	{
		if ((Number - 0) > 9999999.9999)
		{
			return "ข้อมูลนำเข้าเกินขอบเขตที่ตั้งไว้";
		} else
		{
			Number = Number.split (".");
			if (Number[1].length > 0)
			{
				Number[1] = Number[1].substring(0, 2);
			}
			var NumberLen = Number[0].length - 0;
			for(var i = 0; i < NumberLen; i++)
			{
				var tmp = Number[0].substring(i, i + 1) - 0;
				if (tmp != 0)
				{
					if ((i == (NumberLen - 1)) && (tmp == 1))
					{
						BahtText += "เอ็ด";
					} else
					if ((i == (NumberLen - 2)) && (tmp == 2))
					{
						BahtText += "ยี่";
					} else
					if ((i == (NumberLen - 2)) && (tmp == 1))
					{
						BahtText += "";
					} else
					{
						BahtText += NumberArray[tmp];
					}
					BahtText += DigitArray[NumberLen - i - 1];
				}
			}
			BahtText += "บาท";
			if ((Number[1] == "0") || (Number[1] == "00"))
			{
				BahtText += "ถ้วน";
			} else
			{
				DecimalLen = Number[1].length - 0;
				for (var i = 0; i < DecimalLen; i++)
				{
					var tmp = Number[1].substring(i, i + 1) - 0;
					if (tmp != 0)
					{
						if ((i == (DecimalLen - 1)) && (tmp == 1))
						{
							BahtText += "เอ็ด";
						} else
						if ((i == (DecimalLen - 2)) && (tmp == 2))
						{
							BahtText += "ยี่";
						} else
						if ((i == (DecimalLen - 2)) && (tmp == 1))
						{
							BahtText += "";
						} else
						{
							BahtText += NumberArray[tmp];
						}
						BahtText += DigitArray[DecimalLen - i - 1];
					}
				}
				BahtText += "สตางค์";
			}
			return BahtText;
		}
	}
}

function CheckNumber(Number){
	var decimal = false;
	Number = Number.toString();
	Number = Number.replace (/ |,|บาท|฿/gi,'');
	for (var i = 0; i < Number.length; i++)
	{
		if(Number[i] =='.'){
			decimal = true;
		}
	}
	if(decimal == false){
		Number = Number+'.00';
	}
	return Number
}
</script>
