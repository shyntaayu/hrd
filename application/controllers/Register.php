<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('id')) {
            redirect('master');
        }
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->model('register_model');
    }

    function index()
    {
		
        $this->load->view('register');
    }

    function validation()
    {
        $this->load->library('encrypt');
        $this->form_validation->set_rules('nama', 'Name', 'required|trim|alpha|min_length[6]');
        $this->form_validation->set_rules('email', 'Email Address', 'required|min_length[15]|trim|valid_email|is_unique[karyawan.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nohp', 'No HP', 'required|min_length[11]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
        var_dump("a");
        // if ($this->form_validation->run()) {
            var_dump("b");
            $encrypted_password = $this->encrypt->encode($this->input->post('password'), $this->config->item('key_secret'));
            $data = array(
                'nama'  => $this->input->post('nama'),
                'email'  => $this->input->post('email'),
                'password' => $encrypted_password,
                'no_hp' => $this->input->post('nohp'),
                'alamat' => $this->input->post('alamat')
            );
            print_r($data);
            var_dump($data);
			#die();
			
            $id = $this->register_model->insert($data);
            if ($id > 0) {
                $this->session->set_flashdata('message', 'Wait for the admin to approve your request');
                redirect('login');
            }
        // } 
        // else {
        //     $this->index();
        // }
    }

    function verify_email()
    {
        if ($this->uri->segment(3)) {
            $verification_key = $this->uri->segment(3);
            if ($this->register_model->verify_email($verification_key)) {
                $data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="' . base_url() . 'login">here</a></h1>';
            } else {
                $data['message'] = '<h1 align="center">Invalid Link</h1>';
            }
            $this->load->view('email_verification', $data);
        }
    }
	
	
}
