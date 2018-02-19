<?php

class employee extends CI_Model{

  public function _construct(){
    parent_construct();
  }

  public function getRows($sql){
    $result=$this->db->query($sql);
    return $result->num_rows();
  }


}





?>
