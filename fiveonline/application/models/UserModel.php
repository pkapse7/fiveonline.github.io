<?php

class UserModel extends CI_Model {

    private $user_table = 'users';
    private $city_table = 'cities';

    function __construct() {
        parent::__construct();
    }

    function insert_data() {
        
        $data = array(
            'company_name' => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'employees'    => $this->input->post('employees'),
            'location'     => $this->input->post('location'),
            'average_age'  => $this->input->post('average_age'),
            'coverage'     => $this->input->post('coverage'),
            'invest'       => $this->input->post('invest'),
            'phone'        => $this->input->post('phone'),
        );

        $result = $this->db->insert($this->user_table, $data);
        if ($result !== NULL) {
            $no_of_employees = $this->input->post('employees');
            $rate = (1.5 * 10) / 1000;
            $sum_of_assured = $this->input->post('invest');
            $premium_Logic = $sum_of_assured * $no_of_employees * $rate;
            return $premium_Logic;
        }
        return FALSE;
    }

    function get_cities(){
        try{
            $this->db->select('id,city');
            $this->db->from($this->city_table);
            $this->db->order_by('city','asc');
            $query=$this->db->get();
            $story_array = $query->result();;
            return $story_array;
            
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

}