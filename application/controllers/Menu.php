<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Model_query');
        $this->check_login();
    }
    
    private function check_login()
    {
        if (!$this->session->userdata('User_id')) {
            redirect(base_url('Control_login'));
        }
    }

	public function index()
    {
        redirect(base_url('Menu/Trip_Dashboard'));
    }

    public function Trip_Dashboard()
    {
        $this->load->view('PAGES/Trip_dashboard');
    }

    public function Trip_Status()
    {
        $data['tbl_ticket'] = $this->Model_query->retrieveTickets_all();
        $this->load->view('PAGES/Trip_status', $data);
    }

    public function Trip_Ticket()
    {
        $data['tbl_ticket'] = $this->Model_query->retrieveTickets();
        $this->load->view('PAGES/Trip_ticket', $data);
    }

    public function Drivers_profile()
    {
        $this->load->view('PAGES/Drivers_profile');
    }

    public function Payroll()
    {
        $this->load->view('PAGES/Payroll');
    }

    public function Leave()
    {
        $this->load->view('PAGES/Leave_Dashboard');
    }

    public function Ticket_history()
    {
        $data['tbl_ticket'] = $this->Model_query->retrieveTickets_completed();
        $this->load->view('PAGES/Ticket_history', $data);
    }
}
