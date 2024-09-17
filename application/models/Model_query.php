<?php

class Model_query extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function ValidateUser($data)
    {
        $sql = "SELECT * FROM tbl_user as tu LEFT JOIN tbl_car as tc ON tu.user_id = tc.user_id WHERE email = ? AND password = ?";
        $query = $this->db->query($sql, array($data['email'], $data['password']));
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array(); 
            return $row;
        } else {
            return false;
        }
    }

    function retrieveEmployee()
    {
        $sql = "SELECT * FROM tbl_user as tu LEFT JOIN tbl_car as tc ON tu.user_id = tc.user_id ORDER BY tu.user_id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function retrieveDestination()
    {
        $sql = "SELECT * FROM tbl_destination";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function check_email($email)
    {
        $sql = "SELECT * FROM tbl_user WHERE email = ?";
        $query = $this->db->query($sql, $email);
        $result = $query->result_array();
        if (count($result) > 0) {
            return true; 
        } else {
            return false;
        }
    }

    public function insert_tbluser($data) {
        $this->db->insert('tbl_user', $data);
        return $this->db->insert_id(); 
    }

    public function insert_tblcar($data) {
        return $this->db->insert('tbl_car', $data);
    }

    public function update_tbluser($id, $data) {
        if (!empty($id) && !empty($data)) {
            $this->db->where('user_id', $id);
            $this->db->update('tbl_user', $data);
            return $this->db->affected_rows() > 0;
        }
        return false;
    }

    public function update_tblcar($id, $data) {
        if (!empty($id) && !empty($data)) {
            $this->db->where('user_id', $id);
            $this->db->update('tbl_car', $data);
            return $this->db->affected_rows() > 0;
        }
        return false;
    }

    public function delete_user($id) {
        if (!empty($id)) {
            $this->db->trans_start();
            $this->db->where('user_id', $id);
            $this->db->delete('tbl_user');
    
            $this->db->where('user_id', $id);
            $this->db->delete('tbl_car');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }
    
    public function insert_tblticket($data) {
        $this->db->insert('tbl_ticket', $data);
        return $this->db->insert_id(); 
    }

    public function retrieveTickets()
    {
        $sql = "SELECT tt.*, tu.*, td_pickup.destination AS pickup_point_name, td_dropoff.destination AS dropoff_point_name FROM tbl_ticket AS tt LEFT JOIN tbl_user AS tu ON tt.user_id = tu.user_id LEFT JOIN tbl_destination AS td_pickup ON tt.pickup_point = td_pickup.destination_id LEFT JOIN tbl_destination AS td_dropoff ON tt.dropoff_point = td_dropoff.destination_id WHERE tt.ticket_status != 'Completed' ORDER BY tt.ticket_id DESC;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function retrieveTickets_completed()
    {
        $sql = "SELECT tt.*, tu.*, td_pickup.destination AS pickup_point_name, td_dropoff.destination AS dropoff_point_name FROM tbl_ticket AS tt LEFT JOIN tbl_user AS tu ON tt.user_id = tu.user_id LEFT JOIN tbl_destination AS td_pickup ON tt.pickup_point = td_pickup.destination_id LEFT JOIN tbl_destination AS td_dropoff ON tt.dropoff_point = td_dropoff.destination_id WHERE tt.ticket_status = 'Completed' ORDER BY tt.ticket_id DESC;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function retrieveTickets_all()
    {
        $sql = "SELECT tt.*, tu.*, td_pickup.destination AS pickup_point_name, td_dropoff.destination AS dropoff_point_name FROM tbl_ticket AS tt LEFT JOIN tbl_user AS tu ON tt.user_id = tu.user_id LEFT JOIN tbl_destination AS td_pickup ON tt.pickup_point = td_pickup.destination_id LEFT JOIN tbl_destination AS td_dropoff ON tt.dropoff_point = td_dropoff.destination_id ORDER BY tt.ticket_id DESC;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function update_tblticket($ticket_id, $data) {
        if (!empty($ticket_id) && !empty($data)) {
            $this->db->where('ticket_id', $ticket_id);
            return $this->db->update('tbl_ticket', $data);
        }
        return false;
    }

    public function delete_ticket($id) {
        if (!empty($id)) {
            $this->db->where('ticket_id', $id);
            if ($this->db->delete('tbl_ticket')) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    
}