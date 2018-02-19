<?php 	

		class Produce_models extends CI_Model
	{

        public function insert_sotck_new($stock)
		{
			$this->db->insert('stock_detail',$stock);
			
			$id = $this->db->insert_id();

			return (isset($id)) ? $id : FALSE;	
		}

    }