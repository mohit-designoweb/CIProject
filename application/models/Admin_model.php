<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_model
 *
 * @author Mohit Kant Gupta
 */
class Admin_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function checkLogin(){
        $data=array(
            'email'=> $this->security->xss_clean($this->input->post('email')),
            'password'=> $this->security->xss_clean($this->input->post('password'))
        );
        $query=$this->db->get_where('admin',$data);
        return $query->row_array();
    }
    
    public function getLocation(){
        $query=$this->db->get('location');
        return $query->result_array();
    }
    
    public function doAddLocation($image){
        $data=array(
            'locationName'=>$this->security->xss_clean($this->input->post('locationName')),
            'locationImage'=>$image
        );
        $this->db->insert('location',$data);
        return $this->db->insert_id();
    }
    
    public function getLocationById($id){
        $query=$this->db->get_where('location',['locationId'=>$id]);
        return $query->row_array();
    }
    
    public function getLocationImage($id){
        $this->db->select('locationImage');
        $query=$this->db->get_where('location',['locationId'=>$id]);
        return $query->row_array();
    }
    
    public function doEditLocation($image,$id){
        $data=array(
            'locationName'=>$this->security->xss_clean($this->input->post('locationName')),
            'locationImage'=>$image
        );
        $this->db->update('location',$data,['locationId'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function doDeleteLocation($id){
        $this->db->delete('location',['locationId'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function getProperty(){
        $query=$this->db->get('property');
        return $query->result_array();
    }
    
    public function doAddProperty(){
        $data=array(
            'locationId'=>$this->security->xss_clean($this->input->post('locationId')),
            'propertyName'=>$this->security->xss_clean($this->input->post('propertyName')),
            'propertyPrice'=>$this->security->xss_clean($this->input->post('propertyPrice')),
            'propertyDescription'=>$this->security->xss_clean($this->input->post('propertyDescription'))
        );
        $this->db->insert('property',$data);
        return $this->db->insert_id();
    }
    
    public function getPropertyById($id){
        $query=$this->db->get_where('property',['propertyId'=>$id]);
        return $query->row_array();
    }
    
    public function doEditProperty($id){
        $data=array(
            'locationId'=>$this->security->xss_clean($this->input->post('locationId')),
            'propertyName'=>$this->security->xss_clean($this->input->post('propertyName')),
            'propertyPrice'=>$this->security->xss_clean($this->input->post('propertyPrice')),
            'propertyDescription'=>$this->security->xss_clean($this->input->post('propertyDescription'))
        );
        $this->db->update('property',$data,['propertyId'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function addImages($image,$id){
        $data=array(
            'propertyId'=>$id,
            'propertyImage'=>$image
        );
        $this->db->insert('propertyimage',$data);
        return $this->db->insert_id();
    }
    
    public function getPropertyImages($id){
        $query=$this->db->get_where('propertyimage',['propertyId'=>$id]);
        return $query->result_array();
    }
    
    public function deleteImage($id){
        $this->db->delete('propertyimage',['imageId'=>$id]);
        return $this->db->affected_rows();
    }
    
    public function deleteProperty($propertyId){
        $this->db->delete('propertyimage',['propertyId'=>$propertyId]);
        $this->db->delete('property',['propertyId'=>$propertyId]);
        return $this->db->affected_rows();
    }
    
}
