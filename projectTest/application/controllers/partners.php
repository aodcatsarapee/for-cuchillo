<?php
/**
 * Created by PhpStorm.
 * User: aodca
 * Date: 2/25/2018
 * Time: 10:04
 */

class Partners extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header", $data);
        $this->load->view("partners/index");
    }

    public function add()
    {
        {
            $partners = array(
                "partners_name" => $this->input->post('partners_name'),
                "partners_detail" => $this->input->post('partners_detail'),
                "date" => date('Y-m-d H:i:s')
            );

            $this->db->insert('partners', $partners);

        }
        redirect(base_url() . 'partners');
    }
    public function update($partners_id)
    {
        $this->db->where('partners_id', $partners_id);
        $data['partners'] = $this->db->get('partners')->row();
        echo json_encode($data);
    }

    public function edit()
    {

        $partners = array(
            "partners_name" => $this->input->post('partners_name_edit'),
            "partners_detail" => $this->input->post('partners_detail_edit'),
            "date" => date('Y-m-d H:i:s')
        );
        $this->db->where('partners_id', $this->input->post('partners_id'));
        $this->db->update('partners', $partners);

        redirect(base_url() . 'partners');
    }

    public function delete($partners_id)
    {
        $this->db->where('partners_id', $partners_id);
        $this->db->delete('partners');
        $data['status'] = true;
        echo json_encode($data);
    }


}