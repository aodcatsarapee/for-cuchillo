<?php
require_once APPPATH."/third_party/tcpdf/tcpdf.php";
class payment_pdf extends TCPDF{

  public function __construct(){
    //$this->ci -& get_instance();
  }

  /*public function Footer() {
      $this->SetFillColorArray(_hex2rgb('#FFF200'));
      $this->SetTextColorArray(_hex2rgb('#000000'));
      $this->SetFont('thsarabun', '', _conversion(18,'px-pt'), '', true);
      $this->Cell(_conversion(250,'px-mm'),0,'ข้อความฝั่งซ้าย',
      0,0,'L',false,'',0,false,'T','B');
      $this->SetFillColorArray(_hex2rgb('#EFE4B0'));
      $this->SetTextColorArray(_hex2rgb('#000000'));
      $this->SetFont('thsarabun', '', _conversion(18,'px-pt'), '', true);
      $this->Cell(_conversion(450,'px-mm'),0,
      'หน้า '.$this->getAliasNumPage().' / '.$this->getAliasNbPages(),
      0,1,'R',false,'',0,false,'T','B');
  }*/
}



?>
