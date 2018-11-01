<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Property
 *
 * @author Mohit Kant Gupta
 */
class Property extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
        if (empty($this->isLogin())) {
            redirect(base_url('admin'));
        }
    }

    private function isLogin() {
        return $this->session->userdata('email');
    }

    private function filteredLocation() {
        $list = ['' => 'Select the location'];
        $locations = $this->admin_model->getLocation();
        foreach ($locations as $location) {
            $list[$location['locationId']] = $location['locationName'];
        }
        return $list;
    }

    public function index() {
        $data['title'] = 'Property';
        $data['properties'] = $this->admin_model->getProperty();
        $data['locations'] = $this->admin_model->getLocation();
        $this->load->view('admin/property/viewProperty', $data);
    }

    public function addProperty($id = null) {
        $data['title'] = 'Property';
        if (!empty($id)) {
            $data['property'] = $this->admin_model->getPropertyById($id);
        }
        $data['location'] = $this->filteredLocation();
        $this->load->view('admin/property/addProperty', $data);
    }

    public function doAddProperty() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('locationId', 'location Name', 'required');
        $this->form_validation->set_rules('propertyName', 'Property Name', 'required');
        $this->form_validation->set_rules('propertyPrice', 'Property Price', 'required');
        $this->form_validation->set_rules('propertyDescription', 'Property Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddProperty();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('property')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong please try again']));
            return FALSE;
        }
    }

    public function doEditProperty($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('locationId', 'location Name', 'required');
        $this->form_validation->set_rules('propertyName', 'Property Name', 'required');
        $this->form_validation->set_rules('propertyPrice', 'Property Price', 'required');
        $this->form_validation->set_rules('propertyDescription', 'Property Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditProperty($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('property')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong please try again']));
            return FALSE;
        }
    }

    public function images($id) {
        $data['title'] = 'Property';
        $data['propertyId'] = $id;
        $data['images'] = $this->admin_model->getPropertyImages($id);
        $this->load->view('admin/property/image', $data);
    }

    function doUploadImage($id) {
        $this->output->set_content_type('application/json');
        $count = count($_FILES['propertyImage']['size']);
        foreach ($_FILES as $key => $value) {
            for ($s = 0; $s < $count; $s++) {
                $_FILES['propertyImage']['name'] = $value['name'][$s];
                $_FILES['propertyImage']['type'] = $value['type'][$s];
                $_FILES['propertyImage']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['propertyImage']['error'] = $value['error'][$s];
                $_FILES['propertyImage']['size'] = $value['size'][$s];
                $config['upload_path'] = './public/uploads/property/';
                $config['allowed_types'] = 'png';
                $config['max_size'] = '2048';
                $config['file_name'] = rand(11111, 99999);
                $this->load->library('upload', $config);
                $this->upload->do_upload('propertyImage');
                $data = $this->upload->data();
                $this->admin_model->addImages($data['file_name'], $id);
            }
        }
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('property/images/' . $id)]));
        return FALSE;
    }

    public function deleteImage($imageId, $propertyId) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteImage($imageId);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('property/images/' . $propertyId)]));
            return FALSE;
        }
    }

    public function deleteProperty($propertyId) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteProperty($propertyId);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('property')]));
            return FALSE;
        }
    }

}
