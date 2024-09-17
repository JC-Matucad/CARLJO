<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->model('Model_query');
    }
    
    public function index()
    {
        if ($this->session->userdata('User_id')) {
            redirect(base_url('Menu'));
        } else {
            $this->load->view('Login');
        }
    }

    public function Login_attempt()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $email = $this->input->post('inptEmail');
            $password = $this->input->post('inptPassword');

            $data = array(
                'email' => $email,
                'password' => $password
            );

            $resultdata = $this->Model_query->ValidateUser($data);

            if (!$resultdata) {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Incorrect Username or Password.</div>');
                redirect(base_url('Control_login'));
            }
            else {
                $this->session->set_userdata(array(
                    'User_id' => $resultdata['user_id'],
                    'Email' => $resultdata['email'],
                    'Display_name' => $resultdata['display_name'],
                    'Date_join' => $resultdata['date_join'],
                    'Position' => $resultdata['position'],
                    'License_no' => $resultdata['license_number'],
                    'Mobile' => $resultdata['mobile_number'],
                    'Address' => $resultdata['address'],
                    'Emergency_contact' => $resultdata['emergency_contact'],
                    'Admin_validation' => $resultdata['admin'],
                    'Pfp_filename' => $resultdata['profile'],
                    'Model' => $resultdata['car_model'],
                    'Plate' => $resultdata['car_plate'],
                ));
                redirect(base_url('Menu'));
            }
        }
        else {
            $this->load->view('Pages/Login');
        }
    }

    
    
    public function Logout()
	{
		$this->session->sess_destroy();
        redirect('Control_login');
	}
}
