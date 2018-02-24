<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Genpdf_models extends CI_Model {
    
     // Get all details ehich store in "products" table in database.
        public function get_amount_detail($id,$date_start,$date_end)
	{
			
			$this->db->select('SUM(stock_amount) as amount,stock_detail.*,stock.*');
			
			$this->db->from('stock');

			$this->db->join('stock_detail', 'stock.stock_detail_id = stock_detail.stock_detail_id', 'left'); 

			$this->db->group_by('stock.product_id'); 

			$this->db->order_by('stock.product_id', 'ASC');

			$this->db->where('stock_detail.stock_detail_date >=', $date_start);

			$this->db->where('stock_detail.stock_detail_status >=', 'รับสินค้าเข้าคลังเเล้ว');

         	list($Y,$m,$d) = explode('-',$date_end);

			$this->db->where('stock_detail.stock_detail_date <=', $Y."-".$m."-".($d+1));


			$sql=$this->db->get();
			
			if ($sql->num_rows() > 0) {
				
				return $sql->result_array();
			}
			else
			{
				return $sql->result_array();
			}
		
	}

	    public function show_order_all_1($id,$date_start,$date_end)
	{
		
			$this->db->select('*');
			
			$this->db->from('sell_detail');
			
			$this->db->order_by('sell_detail_date', 'ASC');

			$this->db->where('sell_detail_date >=', $date_start);

         	list($Y,$m,$d) = explode('-',$date_end);

         	if($d == "31"){

         		$d==02;

         		$this->db->where('sell_detail_date <=', $Y."-".$m."-".$d);
         	}else{

         		$this->db->where('sell_detail_date <=', $Y."-".$m."-".($d+1));
         	}

			$sql=$this->db->get();
			
			if ($sql->num_rows() > 0) {
				
				return $sql->result_array();
			}
			else
			{
				return $sql->result_array();
			}		
	}
	    public function debtor_all_1($id,$date_start,$date_end)
	{
		
			$this->db->select('debtor.*,customers.*');
			
			$this->db->from('debtor');
			
			$this->db->join('customers', 'debtor.customer_id = customers.customer_id', 'left'); 
			
			$this->db->order_by('debtor_id', 'ASC');

			$this->db->where('debtor_status','ชำระเงินเเล้ว');

			$this->db->where('debtor_datasave >=', $date_start);

         	list($Y,$m,$d) = explode('-',$date_end);

			$this->db->where('debtor_datasave <=', $Y."-".$m."-".($d+1));


			$sql=$this->db->get();
			
			if ($sql->num_rows() > 0) {
				
				return $sql->result_array();
			}
			else
			{
				return $sql->result_array();
			}

			
	}
    

    public function Account_all_1($id,$date_start,$date_end)
	{
		
			$this->db->select('*');
			
			$this->db->from('account');

       		$this->db->order_by('account_id', 'ASC');
			
			$this->db->order_by('account_datasave', 'ASC');

			$this->db->where('account_datasave >=', $date_start);

         	list($Y,$m,$d) = explode('-',$date_end);

			$this->db->where('account_datasave <=', $Y."-".$m."-".($d+1));


			$sql=$this->db->get();
			
			if ($sql->num_rows() > 0) {
				
				return $sql->result_array();
			}
			else
			{
				return $sql->result_array();
			}

			
	}


	public function show_order_date($id,$date_start,$date_end)
	{
		
			$this->db->select('order_detail.*,order.*,customers.*');
				
			$this->db->from('order');

			$this->db->join('order_detail', 'order.order_detail_id = order_detail.order_detail_id', 'left');

			$this->db->join('customers', 'order.customer_id = customers.customer_id', 'left');

			$this->db->group_by('order.order_detail_id');

			$this->db->where('order_detail.order_detail_status','ดำเนินการเรียบร้อยเเล้ว');

			$this->db->where('order_detail_date >=', $date_start);

         	list($Y,$m,$d) = explode('-',$date_end);

         	if($d == "31"){

         		$d==02;

         		$this->db->where('order_detail_date <=', $Y."-".$m."-".$d);
         	}else{

         		$this->db->where('order_detail_date <=', $Y."-".$m."-".($d+1));
         	}

			$sql=$this->db->get();
			
			if ($sql->num_rows() > 0) {
				
				return $sql->result_array();
			}
			else
			{
				return $sql->result_array();
			}		
	}

       
}