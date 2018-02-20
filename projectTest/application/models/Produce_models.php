<?php 	

		class Produce_models extends CI_Model
	{

        public function insert_sotck_new($stock)
		{
			$this->db->insert('stock_detail',$stock);
			
			$id = $this->db->insert_id();

			return (isset($id)) ? $id : FALSE;	
		}

            public function select_product_amount()
            {
                $this->db->select('*');

                $this->db->from('product');

                $sql=$this->db->get();

                return $sql->result_array();

            }
            public function select_stock_detail($stock_detail_id)
            {
                $this->db->select('*');

                $this->db->from('stock');

                $this->db->where('stock_detail_id',$stock_detail_id);

                $sql=$this->db->get();

                return $sql->result_array();

            }

            public function insert_amount($stock_id,$ar)
            {
                $this->db->where("stock_detail_id",$stock_id);
                $this->db->update('stock_detail',$ar);
            }

    }