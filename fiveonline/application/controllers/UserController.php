<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usermodel');
    }

    public function index() {
        $data['cities']= $this->usermodel->get_cities();
        $this->load->view('index',$data);
    }


    public function add() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Company Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
            $this->form_validation->set_rules('coverage', 'Coverage', 'required');
            $this->form_validation->set_rules('invest', 'Investment', 'required');
            $this->form_validation->set_rules('employees', 'Employees', 'required');
            $this->form_validation->set_rules('location', 'Address', 'required');
            $this->form_validation->set_rules('average_age', 'Average Age', 'required');

            if ($this->form_validation->run() !== FALSE) {

                $result = $this->usermodel->insert_data();
                redirect('UserController');
            }       
        }
    }
}