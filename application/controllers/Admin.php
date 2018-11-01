<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Mohit Kant Gupta
 */
class Admin extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }
    
    private function isLogin(){
        return $this->session->userdata('email');
    }
    
    public function index(){
        if($this->isLogin()){
            redirect(base_url('admin/dashboard')); 
        }
        $this->load->view('admin/login');
    }
    
    public function checkLogin(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run()===FALSE){
            $this->output->set_output(json_encode(['result'=>0,'errors'=>$this->form_validation->error_array()]));
            return FALSE;
        }
        $result=$this->admin_model->checkLogin();
        if($result){
            $this->session->set_userdata('email', $result['email']);
            $this->output->set_output(json_encode(['result'=>1,'url'=>base_url('admin/dashboard')]));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result'=>-1,'msg'=>'Invalid username or password']));
            return FALSE;
        }
    }
    
    public function dashboard(){
        if(empty($this->isLogin())){
            redirect(base_url('admin')); 
        }
        $data['title']='Dashboard';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/navbar',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/commons/scripts');
        $this->load->view('admin/commons/footer');
    }
    
    public function logout(){
        $this->session->unset_userdata('email');
        redirect(base_url('admin')); 
    }
}
