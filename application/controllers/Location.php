<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Location
 *
 * @author Mohit Kant Gupta
 */
class Location extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
        if (empty($this->session->userdata('email'))) {
            redirect(base_url('admin'));
        }
    }

    public function index() {
        $data['title'] = 'Location';
        $data['locations'] = $this->admin_model->getLocation();
        $this->load->view('admin/location/viewLocation', $data);
    }

    public function addLocation($id = null) {
        if (!empty($id)) {
            $data['location'] = $this->admin_model->getLocationById($id);
        }
        $data['title'] = 'Location';
        $this->load->view('admin/location/addLocation', $data);
    }

    public function doAddLocation() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('locationName', 'location name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image = $this->doUpload();
        if ($image != -1) {
            $result = $this->admin_model->doAddLocation($image);
            if ($result) {
                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('location')]));
                return FALSE;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong please try again']));
                return FALSE;
            }
        } else {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
        }
    }

    public function doEditLocation($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('locationName', 'location name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['locationImage']['name'])) {
            $image = $this->doUpload();
        } else {
            $value = $this->admin_model->getLocationImage($id);
            $image = $value['locationImage'];
        }
        $result = $this->admin_model->doEditLocation($image, $id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('location')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong please try again']));
            return FALSE;
        }
    }

    function doUpload() {
        $config = array(
            'upload_path' => "./public/uploads/location/",
            'allowed_types' => "png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('locationImage')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['locationImage' => $this->upload->display_errors()]);
            return -1;
        }
    }

    public function deleteLocation($id) {
        $result = $this->admin_model->doDeleteLocation($id);
        if ($result) {
            redirect(base_url('location'));
        } else {
            $this->session->set_userdata('error', 'Something went wrong please try again');
            redirect(base_url('location'));
        }
    }

}
