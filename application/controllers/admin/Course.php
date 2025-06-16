<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
                'course_name1' => strip_tags($this->input->post('course_name1')),
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
                'course_name1' => strip_tags($this->input->post('course_name1')),
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
        $result = $this->db->update("booking", array('trainer_id' => $trainer_id), "id = '".$booking_id."'");
        if($result) {
            $get_setting = $this->db->query('SELECT * FROM settings')->row();
            //Get Trainer Data
            $getTrainerData = $this->db->query("SELECT * FROM users WHERE id = '".$trainer_id."'")->row();
            $trainerfullName = $getTrainerData->first_name." ".$getTrainerData->last_name;
            $trainerEmail = $getTrainerData->email;
            //Get User Data
            $bookingData = $this->db->query("SELECT * FROM booking WHERE id = '".$booking_id."'")->row();
            $getUserData = $this->db->query("SELECT * FROM users WHERE id = '".$bookingData->user_id."'")->row();
            $userfullName = $getUserData->first_name." ".$getUserData->last_name;
            $userEmail = $getUserData->email;
            //Courese Data
            $getCourseData = $this->db->query("SELECT * FROM courses WHERE id = '".$bookingData->course_id."'")->row();
            $courseName = $getCourseData->course_name." ".$getCourseData->course_name1;
            //Send Email to Trainer
            if(isset($get_setting->phone)) {
                $phone = " / ".$get_setting->phone;
            }
            $message = "<body><div style='width:100%;margin: 0 auto;background: #fff; border: 1px solid #e6e6e6;'><div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'><img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'><h3 style='padding-top:40px; line-height: 30px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #014599; display: block;'>$get_setting->title</span></h3><p style='font-size: 17px; margin: 0;'>Hello $trainerfullName,</p><p style='font-size: 17px; margin: 5px 0 0 0;'>You have assigned to <b>$courseName</b>.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>Please login to your <a href='".base_url('login')."'><b>Dashboard</b></a> for further information.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>You’re all set! You’ll receive further updates and important information shortly.</p><p style='font-size: 17px; margin: 10px 0 0 0;'>If you have any questions, feel free to reply to this email or contact us at <b>$get_setting->email $phone</b>.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>Thank you!</p><p style='font-size: 17px; margin: 5px 0 0 0; list-style: none;'>Sincerly</p><p style='list-style: none;margin: 5px 0 0 0;font-size: 15px;'><b>$get_setting->title</b></p><p style='list-style: none;margin: 5px 0 0 0;font-size: 10px;'><b>Visit us:</b> <span>$get_setting->address</span></p><p style='list-style: none;margin: 5px 0 0 0;font-size: 10px;'><b>Email us:</b> <span>$get_setting->email</span></p><p style='list-style: none;margin: 5px 0 0 0;font-size: 10px;'><b>Call us:</b> <span>$get_setting->phone</span></p></div><table style='width: 100%;'><tr><td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> $get_setting->title. All rights reserved.</td></tr></table></body>";
            require 'vendor/autoload.php';
            $mail = new PHPMailer(true);
            try {
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('info@bayhilldrivingschool.com', $get_setting->title);
                $mail->AddAddress($trainerEmail);
                $mail->IsHTML(true);
                $mail->Subject = 'You’ve Been Assigned to Train: '.$courseName;
                $mail->AddEmbeddedImage('uploads/logos/'.$get_setting->logo, 'Logo');
                $mail->Body = $message;
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host = $get_setting->smtp_host;
                $mail->Port = $get_setting->smtp_port; //587 465
                $mail->Username = $get_setting->smtp_email;
                $mail->Password = base64_decode($get_setting->smtp_pass);
                $mail->send();
                $this->sendEmailToUser($userfullName, $userEmail, $courseName, $trainerfullName);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $msg = 'Some error occurred, Please try again!';
            echo '["' . $msg . '", "error", "#DD6B55"]';
        }
        echo '1';
    }
    public function sendEmailToUser($userfullName, $userEmail, $courseName, $trainerfullName) {
        $get_setting = $this->db->query('SELECT * FROM settings')->row();
        if(isset($get_setting->phone)) {
            $phone = " / ".$get_setting->phone;
        }
        $message = "<body><div style='width:100%;margin: 0 auto;background: #fff; border: 1px solid #e6e6e6;'><div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'><img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'><h3 style='padding-top:40px; line-height: 30px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #014599; display: block;'>$get_setting->title</span></h3><p style='font-size: 17px; margin: 0;'>Hello $userfullName,</p><p style='font-size: 17px; margin: 5px 0 0 0;'>We’re pleased to inform you that a trainer has been assigned to your course <b>$courseName</b>.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>Your trainer will guide you through the learning process and be available to support you with any questions or challenges during the course.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>Please login to your <a href='".base_url('login')."'><b>Dashboard</b></a> for further information.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>You’re all set! You’ll receive further updates and important information shortly.</p><p style='font-size: 17px; margin: 10px 0 0 0;'>If you have any questions, feel free to reply to this email or contact us at <b>$get_setting->email $phone</b>.</p><p style='font-size: 17px; margin: 5px 0 0 0;'>Thank you!</p><p style='font-size: 17px; margin: 5px 0 0 0; list-style: none;'>Sincerly</p><p style='list-style: none;margin: 5px 0 0 0;font-size: 15px;'><b>$get_setting->title</b></p><p style='list-style: none;margin: 5px 0 0 0;font-size: 10px;'><b>Visit us:</b> <span>$get_setting->address</span></p><p style='list-style: none;margin: 5px 0 0 0;font-size: 10px;'><b>Email us:</b> <span>$get_setting->email</span></p><p style='list-style: none;margin: 5px 0 0 0;font-size: 10px;'><b>Call us:</b> <span>$get_setting->phone</span></p></div><table style='width: 100%;'><tr><td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> $get_setting->title. All rights reserved.</td></tr></table></body>";
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('info@bayhilldrivingschool.com', $get_setting->title);
            $mail->AddAddress($userEmail);
            $mail->IsHTML(true);
            $mail->Subject = 'Trainer Assigned to Your Course: '.$courseName;
            $mail->AddEmbeddedImage('uploads/logos/'.$get_setting->logo, 'Logo');
            $mail->Body = $message;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Host = $get_setting->smtp_host;
            $mail->Port = $get_setting->smtp_port; //587 465
            $mail->Username = $get_setting->smtp_email;
            $mail->Password = base64_decode($get_setting->smtp_pass);
            $mail->send();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}