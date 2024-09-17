<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_functions extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Model_query');
        $this->load->helper('file');
    }
    
    public function index()
    {
    }

    public function Get_employee()
    {
        $result = $this->Model_query->retrieveEmployee(); // Use the correct model instance
        header('Content-Type: application/json'); // Set content type to JSON
        echo json_encode($result);
    }

    public function Get_destination()
    {
        $result = $this->Model_query->retrieveDestination(); // Use the correct model instance
        header('Content-Type: application/json'); // Set content type to JSON
        echo json_encode($result);
    }

    public function Add_User() {
        $email = $this->input->post('inptEmail');
        $name = $this->input->post('inptName');
        $date_hired = $this->input->post('inptDatehired');
        $position = $this->input->post('inptPosition');
        $license = $this->input->post('inptLicense');
        $mobile = $this->input->post('inptMobile');
        $car_model = $this->input->post('inptCarmodel');
        $plate = $this->input->post('inptPlate');
        $address = $this->input->post('inptAddress');
        $emergencyno = $this->input->post('inptEmergencyno');
        $password = $this->input->post('inptPassword');
        $admin = $this->input->post('inptAdmin');
    
        if ($this->Model_query->check_email($email)) {
            $this->session->set_flashdata('error', 'Email already exists. Please use a different email.');
            redirect(base_url('Menu/Drivers_profile'));
        }
    
        // Upload Profile Picture
        $profile_picture = null;
        if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK) {
            $config['upload_path'] = './upload/pfp/'; // Updated path to upload/pfp/
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10048;
            $config['file_name'] = 'pfp_' . time();
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('uploaded_file')) {
                $file_data = $this->upload->data();
                $profile_picture = $file_data['file_name'];
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'File upload failed: ' . $error);
                redirect(base_url('Menu/Drivers_profile'));
            }
        }
    
        $tbluser = array(
            'email' => $email,
            'password' => $password,
            'display_name' => $name,
            'date_join' => $date_hired,
            'position' => $position,
            'license_number' => $license,
            'mobile_number' => $mobile,
            'address' => $address,
            'emergency_contact' => $emergencyno,
            'admin' => $admin,
            'profile' => $profile_picture // Save the filename in DB
        );
    
        $user_id = $this->Model_query->insert_tbluser($tbluser);
    
        if ($user_id) {
            $tblcar = array(
                'user_id' => $user_id,
                'car_model' => $car_model,
                'car_plate' => $plate
            );
            $this->Model_query->insert_tblcar($tblcar);
    
            $this->session->set_flashdata('success', 'Driver added successfully!');
            redirect(base_url('Menu/Drivers_profile'));
        } else {
            $this->session->set_flashdata('error', 'Failed to add driver. Please try again.');
            redirect(base_url('Menu/Drivers_profile'));
        }
    }
    
    

    public function Update_User() {
        $ID = $this->input->post('inptId');
        $email = $this->input->post('inptEmail');
        $name = $this->input->post('inptName');
        $date_hired = $this->input->post('inptDatehired');
        $position = $this->input->post('inptPosition');
        $license = $this->input->post('inptLicense');
        $mobile = $this->input->post('inptMobile');
        $car_model = $this->input->post('inptCarmodel');
        $plate = $this->input->post('inptPlate');
        $address = $this->input->post('inptAddress');
        $emergencyno = $this->input->post('inptEmergencyno');
        $password = $this->input->post('inptPassword');
        $admin = $this->input->post('inptAdmin');
    
        if ($ID) {
            $tbluser = array(
                'email' => $email,
                'password' => $password,
                'display_name' => $name,
                'date_join' => $date_hired,
                'position' => $position,
                'license_number' => $license,
                'mobile_number' => $mobile,
                'address' => $address,
                'emergency_contact' => $emergencyno,
                'admin' => $admin
            );
            $this->Model_query->update_tbluser($ID, $tbluser);
    
            $tblcar = array(
                'car_model' => $car_model,
                'car_plate' => $plate  
            );
            $this->Model_query->update_tblcar($ID, $tblcar);
    
            $this->session->set_flashdata('success', 'Driver updated successfully!');
            redirect(base_url('Menu/Drivers_profile'));
        } else {
            $this->session->set_flashdata('error', 'Failed to update driver. Please try again.');
            redirect(base_url('Menu/Drivers_profile'));
        }
    }
    
    public function Delete_User() {
        $id = $this->input->post('inptdeleteId');
        $profile = $this->input->post('inptdeleteprofile');
    
        if ($id) {
            // Delete the user from the database
            $deleted = $this->Model_query->delete_user($id);
    
            if ($deleted) {
                // Check if a profile photo filename is provided
                if ($profile) {
                    $file_path = './upload/pfp/' . $profile;
    
                    // Delete the photo file if it exists
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
    
                // Set success message and redirect
                $this->session->set_flashdata('success', 'Driver deleted successfully!');
                redirect(base_url('Menu/Drivers_profile'));
            } else {
                // Set error message and redirect
                $this->session->set_flashdata('error', 'Failed to delete driver. Please try again.');
                redirect(base_url('Menu/Drivers_profile'));
            }
        } else {
            // Set error message and redirect
            $this->session->set_flashdata('error', 'Failed to delete driver. Please try again.');
            redirect(base_url('Menu/Drivers_profile'));
        }
    }
    

    public function Add_Ticket() {
        $driver_id = $this->input->post('driverSelect');
        $pickup_point = $this->input->post('destinationSelectFrom');
        $drop_off_point = $this->input->post('destinationSelectTo');
        $shift = $this->input->post('shiftSelect');
        $date_schedule = $this->input->post('inptDatesched');
        $time_from = $this->input->post('inptTimefrom');
        $time_to = $this->input->post('inptTimeto');

        $ticket_data = array(
            'user_id' => $driver_id,
            'date_created' => date('Y-m-d H:i:s'),
            'date_scheduled' => $date_schedule,
            'time_from' => $time_from,
            'time_to' => $time_to,
            'pickup_point' => $pickup_point,
            'dropoff_point' => $drop_off_point,
            'shift' => $shift,
            'ticket_status' => 'For Pick up'
        );

        if ($this->Model_query->insert_tblticket($ticket_data)) {
            $this->session->set_flashdata('success', 'Trip ticket created successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to create trip ticket.');
        }
        redirect('Menu/Trip_Ticket');
    }

    public function Update_Ticket() {
        $ticket_id = $this->input->post('inptticketid');
        $driver_id = $this->input->post('driverSelectmodal');
        $pickup_point = $this->input->post('destinationSelectFrommodal');
        $dropoff_point = $this->input->post('destinationSelectTomodal');
        $shift = $this->input->post('shiftSelect');
        $passenger_count = $this->input->post('inptPassenger');
        $date_sched = $this->input->post('inptDatesched');
        $time_from = $this->input->post('inptTimefrom');
        $time_to = $this->input->post('inptTimeto');

        $data = array(
            'user_id' => $driver_id,
            'pickup_point' => $pickup_point,
            'dropoff_point' => $dropoff_point,
            'shift' => $shift,
            'passenger_count' => $passenger_count,
            'date_scheduled' => $date_sched,
            'time_from' => $time_from,
            'time_to' => $time_to
        );

        $result = $this->Model_query->update_tblticket($ticket_id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Ticket updated successfully!');
            redirect(base_url('Menu/Trip_Ticket'));
        } else {
            $this->session->set_flashdata('error', 'Failed to update Ticket. Please try again.');
            redirect(base_url('Menu/Trip_Ticket'));
        }
    }

    public function Delete_Ticket() {
        $id = $this->input->post('inptdeleteId');
        if ($id) {
            $deleted = $this->Model_query->delete_ticket($id);
            if ($deleted) {
                $this->session->set_flashdata('success', 'Ticket deleted successfully!');
                redirect(base_url('Menu/Trip_Ticket'));
            } else {
                $this->session->set_flashdata('error', 'Failed to delete Ticket. Please try again.');
                redirect(base_url('Menu/Trip_Ticket'));
            }
        } else {
            $this->session->set_flashdata('error', 'Failed to delete Ticket. Please try again.');
            redirect(base_url('Menu/Trip_Ticket'));
        }
    }

    public function Get_tickets()
    {
        $result = $this->Model_query->retrieveTickets();
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function Time_in() {
        $ticket_id = $this->input->post('inptTicketid');
        $time_in = $this->input->post('current_time');
        $status = 'On The way';
    
        if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK) {
            $config['upload_path'] = './upload/proof/'; 
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10048;
            $config['file_name'] = 'proof_' . time();
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('uploaded_file')) {
                $file_data = $this->upload->data();
                
                $data = array(
                    'time_in' => $time_in,
                    'ticket_status' => $status,
                    'proof_image' => $file_data['file_name']
                );

                $result = $this->Model_query->update_tblticket($ticket_id, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Time in successfully!');
                    redirect(base_url('Menu/Trip_Dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Failed to Time in. Please try again.');
                    redirect(base_url('Menu/Trip_Dashboard'));
                }
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'File upload failed: ' . $error);
                redirect(base_url('Menu/Trip_Dashboard'));
            }
        } else {
            $this->session->set_flashdata('error', 'You did not select a file to upload.');
            redirect(base_url('Menu/Trip_Dashboard'));
        }
    }    

    public function Time_out() {
        $ticket_id = $this->input->post('inpttimeoutid');
        $passenger_count = $this->input->post('inptpassengercount');
        $time_in = $this->input->post('timeforout');
        $status = 'Completed';
    
        $data = array(
            'time_out' => $time_in,
            'passenger_count' => $passenger_count,
            'ticket_status' => $status
        );
    
        $result = $this->Model_query->update_tblticket($ticket_id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Trip Completed!');
            redirect(base_url('Menu/Trip_Dashboard'));
        } else {
            $this->session->set_flashdata('error', 'Failed to Completed the trip. Please try again.');
            redirect(base_url('Menu/Trip_Dashboard'));
        }
    }

    public function retrieveEmployeeProfile() {
        $userid = $this->session->userdata('User_id');
        $result = $this->Model_query->retrieveEmployeeProfile($userid);
        echo json_encode($result);
    }
    
    
}
