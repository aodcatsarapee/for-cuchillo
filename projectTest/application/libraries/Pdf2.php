<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mpdf
 *
 * @author nut_channarong
 */
class PDF2 {
    //put your code here
    public function pdf2() {
        $CI = & get_instance();
        include_once APPPATH . 'third_party/mpdf/mpdf.php';
    }
    
    public function loadthaiA4() {
        //return new mPDF($mode='th',$format='A4');
        //return new mPDF($mode='tha',$format='A4');
        return new mPDF($mode='thai',$format='A4');
    }
    
     public function loadthaiA4L() {
        //return new mPDF($mode='th',$format='A4');
        //return new mPDF($mode='tha',$format='A4');
        return new mPDF($mode='tha',$format='A4-L');
    }
    
    public function loadthaicustom($width,$height) {
        return new mPDF($mode='th', $format=array($width, $height));
    }
}
