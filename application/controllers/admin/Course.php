<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->Adminmodel->loggedIn();
    }
    public function index() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Course List',
            'subpage' => 'courses',
        );
        $data['course_list'] = $this->Adminmodel->get_all_record('*', 'courses', '', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/course/course_list');
        $this->load->view('admin/footer');
    }
    public function add_course() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Add Course',
            'subpage' => 'courses',
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['upload_image']['name'] != '') {
                $src = $_FILES['upload_image']['tmp_name'];
                $filEnc = time();
                $avatar = rand(0000, 9999) . "_" . $_FILES['upload_image']['name'];
                $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                $dest = getcwd() . '/uploads/course/' . $avatar1;
                if (move_uploaded_file($src, $dest)) {
                    $image  = $avatar1;
                }
            } else {
                $image  = '';
            }
            $data = array(
                'course_code' => time(),
                'course_name' => strip_tags($this->input->post('course_name')),
                'course_short_description' => htmlspecialchars($this->input->post('course_short_description')),
                'course_description' => htmlspecialchars($this->input->post('course_description')),
                'address' => strip_tags($this->input->post('address')),
                'latitude' => strip_tags($this->input->post('latitude')),
                'longitude' => strip_tags($this->input->post('longitude')),
                'country' => strip_tags($this->input->post('country')),
                'state' => strip_tags($this->input->post('state')),
                'city' => strip_tags($this->input->post('city')),
                'pincode' => strip_tags($this->input->post('pincode')),
                'course_duration' => strip_tags($this->input->post('course_duration')),
                'course_class' => strip_tags($this->input->post('course_class')),
                //'class_duration' => strip_tags($this->input->post('class_duration')),
                'course_price' => strip_tags($this->input->post('course_price')),
                'offer_price' => strip_tags($this->input->post('offer_price')),
                'course_image' => $image,
                'course_type' => $this->input->post('course_type'),
                'status' => $this->input->post('status'),
                'created_at' => date('Y-m-d H:i:s')
            );
            $result = $this->Adminmodel->add('courses', $data);
            if ($result) {
                $msg = '["Course has been added successfully.", "success", "#A5DC86"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/course'), 'refresh');
            } else {
                $msg = 'Some error occurred.Please try again.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/course'), 'refresh');
            }
        }
        $data['zipcodeList'] = $this->db->query("SELECT * FROM zipcode WHERE status = '1'")->result();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/course/add_course');
        $this->load->view('admin/footer');
    }
    public function edit_course($id) {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Edit Course',
            'subpage' => 'courses',
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['upload_image']['name'] != '') {
                $src = $_FILES['upload_image']['tmp_name'];
                $filEnc = time();
                $avatar = rand(0000, 9999) . "_" . $_FILES['upload_image']['name'];
                $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                $dest = getcwd() . '/uploads/course/' . $avatar1;
                if (move_uploaded_file($src, $dest)) {
                    $image  = $avatar1;
                    @unlink('uploads/course/' . $_POST['old_image']);
                }
            } else {
                if(!empty($_POST['old_image'])) {
                    $image  = $_POST['old_image'];
                } else {
                    $image  = '';
                }
            }
            $data = array(
                'course_name' => strip_tags($this->input->post('course_name')),
                'course_short_description' => htmlspecialchars($this->input->post('course_short_description')),
                'course_description' => htmlspecialchars($this->input->post('course_description')),
                'address' => strip_tags($this->input->post('address')),
                'latitude' => strip_tags($this->input->post('latitude')),
                'longitude' => strip_tags($this->input->post('longitude')),
                'country' => strip_tags($this->input->post('country')),
                'state' => strip_tags($this->input->post('state')),
                'city' => strip_tags($this->input->post('city')),
                'pincode' => strip_tags($this->input->post('pincode')),
                'course_duration' => strip_tags($this->input->post('course_duration')),
                'course_class' => strip_tags($this->input->post('course_class')),
                //'class_duration' => strip_tags($this->input->post('class_duration')),
                'course_price' => strip_tags($this->input->post('course_price')),
                'offer_price' => strip_tags($this->input->post('offer_price')),
                'course_image' => $image,
                'course_type' => $this->input->post('course_type'),
                'status' => $this->input->post('status')
            );
            $result = $this->Adminmodel->update($data, 'courses', array('id' => $id));
            if ($result) {
                $msg = '["Course has been updated successfully.", "success", "#A5DC86"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/course'), 'refresh');
            } else {
                $msg = 'Some error occurred.Please try again.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/course'), 'refresh');
            }
        }
        $data['result'] = $this->Adminmodel->get_by('courses', 'single', array('id' => $id), '', 1);
        $data['zipcodeList'] = $this->db->query("SELECT * FROM zipcode WHERE status = '1'")->result();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/course/edit_course');
        $this->load->view('admin/footer');
    }
    public function changestatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'The course is now active.';
            } else {
                $msg = 'The course is now deactive.';
            }
            if ($this->Adminmodel->update(['status' => $status], 'courses', ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function delete_course($id) {
        if(empty($id)){
            return false;
        }
        $result = $this->db->query('DELETE FROM courses where id = '.$id.'');
        if($result) {
            $msg = '["Course deleted successfully.", "success", "#A5DC86"]';
            echo '["' . $msg . '", "success", "#A5DC86"]';
            redirect(base_url('admin/course'),'refresh');
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            redirect(base_url('admin/course'),'refresh');
        }
    }
    public function booking_list() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Booking List',
            'subpage' => 'booking',
        );
        $data['booking_list'] = $this->Adminmodel->get_all_record('*', 'booking', '', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/course/booking_list');
        $this->load->view('admin/footer');
    }
    public function assign_trainer() {
        $trainer_id = $_POST['trainer_id'];
        $booking_id = $_POST['booking_id'];
        $this->db->update("booking", array('trainer_id' => $trainer_id), "id = '".$booking_id."'");
        echo '1';
    }
}