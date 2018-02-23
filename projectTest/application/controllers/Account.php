<?php
/**
 * Created by PhpStorm.
 * User: AODCAT
 * Date: 2/23/2018
 * Time: 14:36
 */

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['employee'] = $this->db->where('user_name', $this->session->userdata('username'))->get('employee')->row_array();
        $this->load->view("home/header", $data);
        $this->load->view("account/index");
    }

    public function add()
    {
        {
            $account_type = $_POST['account_type'];
            $account_detail = $_POST['account_detail'];
            $money = $_POST['money'];

            if ($account_type == 'รายรับ') {

                $account = array(

                    "account_detail" => $account_detail,
                    "account_income" => $money,
                    "account_type" => $account_type,
                    "account_datasave" => date('Y-m-d H:i:s'),
                );

                $this->db->insert('account', $account);
            } else {
                $account = array(

                    "account_detail" => $account_detail,
                    "account_expenses" => $money,
                    "account_type" => $account_type,
                    "account_datasave" => date('Y-m-d H:i:s'),
                );

                $this->db->insert('account', $account);

            }
        }
        redirect(base_url() . 'account');
    }

    public function update_account($account_id)
    {
        $this->db->where('account_id', $account_id);
        $data['account'] = $this->db->get('account')->row();
        echo json_encode($data);
    }

    public function edit()
    {
        $account_id = $this->input->post('account_id');
        $account_type = $this->input->post('account_type_edit');
        $account_detail = $this->input->post('account_detail_edit');
        $money = $this->input->post('money_edit');

        if ($account_type == 'รายรับ') {
            $account = array(
                "account_detail" => $account_detail,
                "account_income" => $money,
                "account_type" => $account_type,
                "account_datasave" => date('Y-m-d H:i:s'),
            );

            $this->db->where('account_id', $account_id);
            $this->db->update('account', $account);
        } else {
            $account = array(
                "account_detail" => $account_detail,
                "account_expenses" => $money,
                "account_type" => $account_type,
                "account_datasave" => date('Y-m-d H:i:s'),
            );

            $this->db->where('account_id', $account_id);
            $this->db->update('account', $account);

        }
        redirect(base_url() . 'account');
    }

    public function delete($account_id)
    {
        $this->db->where('account_id', $account_id);
        $this->db->delete('account');
        $data['status'] = true;
        echo json_encode($data);
    }
}