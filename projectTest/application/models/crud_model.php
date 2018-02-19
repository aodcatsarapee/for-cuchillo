<?php
class crud_model extends CI_Model
{
    public function _construct()
    {
      parent::_construct();
    }

    public function create_member($data){
        $this->db->insert('member',$data);
        return $insert_id=$this->db->insert_id();
    }

    public function getuser($data){
        $where=array('member_username'=>$username,'member_password'=>$password);
        $result=$this->db->where($where)->get('member')->row_array();

        return $result;
    }

}



?>
