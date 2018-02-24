<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
require_once APPPATH."/third_party/tcpdf/tcpdf.php";
$CI = & get_instance();
class Pdf extends TCPDF 
{
    public function __construct() {
        parent::__construct();
    }



    public function load($param = NULL) {
        return new FPDF($param);
    }

    public function loadPDF() {
        return new FPDF('P', 'mm', array(153,203));
    }
    
    public function loadPDFA4() {
        return new FPDF('P', 'mm', 'A4');
    }
    
    public function loadPDFA4L() {
        return new FPDF('L', 'mm', 'A4');
    }
    public function loadPDFA5() {
        return new FPDF('P', 'mm', 'A5');
    }
    public function loadPDFA5L() {
        return new FPDF('L', 'mm', 'A5');
    }

}

