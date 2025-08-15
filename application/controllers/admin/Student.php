<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Student extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->Adminmodel->loggedIn();
    }
    public function index() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Student List',
            'subpage' => 'student',
        );
        $data['trainer_list'] = $this->Adminmodel->get_all_record('*', 'users', 'user_type = 1', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/student/student_list');
        $this->load->view('admin/footer');
    }
    public function check_student_email() {
        $student_email = $this->input->post('student_email');
        $checkEmail = $this->db->query("SELECT * FROM users WHERE email = '".$student_email."'")->row();
        if ($checkEmail > 0) {
            $response = array('status' => 'error', 'message'=>'The given student email already exists.');
        } else {
            $response = array('status' => 'success', 'message'=>'Student email available.');
        }
        echo json_encode($response);
    }
    public function add_student() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Add Student',
            'subpage' => 'student',
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['upload_pimage']['name'] != '') {
                $psrc = $_FILES['upload_pimage']['tmp_name'];
                $pfilEnc = time();
                $pavatar = rand(0000, 9999) . "_" . $_FILES['upload_pimage']['name'];
                $pavatar1 = str_replace(array('(', ')', ' '), '', $pavatar);
                $pdest = getcwd() . '/uploads/student/profilePic/' . $pavatar1;
                if (move_uploaded_file($psrc, $pdest)) {
                    $pimage  = $pavatar1;
                }
            } else {
                $pimage  = '';
            }

            if ($_FILES['upload_cimage']['name'] != '') {
                $csrc = $_FILES['upload_cimage']['tmp_name'];
                $cfilEnc = time();
                $cavatar = rand(0000, 9999) . "_" . $_FILES['upload_cimage']['name'];
                $cavatar1 = str_replace(array('(', ')', ' '), '', $cavatar);
                $cdest = getcwd() . '/uploads/student/cover_image/' . $cavatar1;
                if (move_uploaded_file($csrc, $cdest)) {
                    $cimage  = $cavatar1;
                }
            } else {
                $cimage  = '';
            }
            $data = array(
                'added_by' => 'admin',
                'unique_code' => random_int(100000, 999999),
                'user_type' => '1',
                'salutation' => strip_tags($this->input->post('salutation')),
                'first_name' => strip_tags($this->input->post('fname')),
                'last_name' => strip_tags($this->input->post('lname')),
                'username' => strip_tags($this->input->post('username')),
                'email' => strip_tags($this->input->post('email')),
                'gender' => strip_tags($this->input->post('gender')),
                'dob' => $this->input->post('dob'),
                'phone' => strip_tags($this->input->post('phone')),
                'pfirst_name' => strip_tags($this->input->post('pfirst_name')),
                'plast_name' => strip_tags($this->input->post('plast_name')),
                'pemail' => strip_tags($this->input->post('pemail')),
                'phone_2' => strip_tags($this->input->post('phone_2')),
                'address' => strip_tags($this->input->post('address')),
                'latitude' => strip_tags($this->input->post('latitude')),
                'longitude' => strip_tags($this->input->post('longitude')),
                'country' => strip_tags($this->input->post('country')),
                'state' => strip_tags($this->input->post('state')),
                'city' => strip_tags($this->input->post('city')),
                'zipcode' => strip_tags($this->input->post('pincode')),
                'degree' => strip_tags($this->input->post('degree')),
                'languages' => strip_tags($this->input->post('languages')),
                'certificates' => strip_tags($this->input->post('certificates')),
                'image' => $pimage,
                'coverImage' => $cimage,
                'status' => $this->input->post('status'),
                'email_verify_status' => $this->input->post('email_verify_status'),
                'password' => base64_encode($this->input->post('password')),
                'created_at' => date('Y-m-d H:i:s')
            );
            $result = $this->Adminmodel->add('users', $data);
            if ($result) {
                $msg = '["Student has been added successfully.", "success", "#A5DC86"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/student'), 'refresh');
            } else {
                $msg = 'Some error occurred.Please try again.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/student'), 'refresh');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/student/add_student');
        $this->load->view('admin/footer');
    }
    public function edit_student($id) {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Edit Student',
            'subpage' => 'student',
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['upload_pimage']['name'] != '') {
                $psrc = $_FILES['upload_pimage']['tmp_name'];
                $pfilEnc = time();
                $pavatar = rand(0000, 9999) . "_" . $_FILES['upload_pimage']['name'];
                $pavatar1 = str_replace(array('(', ')', ' '), '', $pavatar);
                $pdest = getcwd() . '/uploads/student/profilePic/' . $pavatar1;
                if (move_uploaded_file($psrc, $pdest)) {
                    $pimage  = $pavatar1;
                    @unlink('uploads/student/profilePic/' . $_POST['old_pimage']);
                }
            } else {
                if(!empty($_POST['old_image'])) {
                    $pimage  = $_POST['old_pimage'];
                } else {
                    $pimage  = '';
                }
            }

            if ($_FILES['upload_cimage']['name'] != '') {
                $csrc = $_FILES['upload_cimage']['tmp_name'];
                $cfilEnc = time();
                $cavatar = rand(0000, 9999) . "_" . $_FILES['upload_cimage']['name'];
                $cavatar1 = str_replace(array('(', ')', ' '), '', $cavatar);
                $cdest = getcwd() . '/uploads/student/cover_image/' . $cavatar1;
                if (move_uploaded_file($csrc, $cdest)) {
                    $cimage  = $cavatar1;
                    @unlink('uploads/student/cover_image/' . $_POST['old_cimage']);
                }
            } else {
                if(!empty($_POST['old_cimage'])) {
                    $cimage  = $_POST['old_cimage'];
                } else {
                    $cimage  = '';
                }
            }
            $data = array(
                'salutation' => strip_tags($this->input->post('salutation')),
                'first_name' => strip_tags($this->input->post('fname')),
                'last_name' => strip_tags($this->input->post('lname')),
                'username' => strip_tags($this->input->post('username')),
                'email' => strip_tags($this->input->post('email')),
                'gender' => strip_tags($this->input->post('gender')),
                'dob' => $this->input->post('dob'),
                'phone' => strip_tags($this->input->post('phone')),
                'pfirst_name' => strip_tags($this->input->post('pfirst_name')),
                'plast_name' => strip_tags($this->input->post('plast_name')),
                'pemail' => strip_tags($this->input->post('pemail')),
                'phone_2' => strip_tags($this->input->post('phone_2')),
                'address' => strip_tags($this->input->post('address')),
                'latitude' => strip_tags($this->input->post('latitude')),
                'longitude' => strip_tags($this->input->post('longitude')),
                'country' => strip_tags($this->input->post('country')),
                'state' => strip_tags($this->input->post('state')),
                'city' => strip_tags($this->input->post('city')),
                'zipcode' => strip_tags($this->input->post('pincode')),
                'degree' => strip_tags($this->input->post('degree')),
                'languages' => strip_tags($this->input->post('languages')),
                'certificates' => strip_tags($this->input->post('certificates')),
                'image' => $pimage,
                'coverImage' => $cimage,
                'status' => $this->input->post('status'),
                'email_verify_status' => $this->input->post('email_verify_status'),
            );
            $result = $this->Adminmodel->update($data, 'users', array('id' => $id));
            if ($result) {
                $msg = '["Student has been updated successfully.", "success", "#A5DC86"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/student'), 'refresh');
            } else {
                $msg = 'Some error occurred.Please try again.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/student'), 'refresh');
            }
        }
        $data['result'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/student/edit_student');
        $this->load->view('admin/footer');
    }
    public function student_details($id) {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Student Details',
            'subpage' => 'student',
        );
        $studentID = base64_decode($id);
        $data['studentData'] = $this->db->query("SELECT * FROM users WHERE id = '".$studentID."'")->row();
        $data['getPurchasedCourseList'] = $this->db->query("SELECT * FROM booking WHERE user_id = '".$studentID."' ORDER BY id DESC")->result();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/student/student_details');
        $this->load->view('admin/footer');
    }
    public function BookigData() {
        $booking_id = $this->input->post('booking_id');
        $course_id = $this->input->post('courseId');
        $student_id = $this->input->post('student_id');
        $course = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
        $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$student_id."' AND course_id = '".@$course_id."'")->row();
        if(empty($getBookingData->transaction_id)){
            $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
            if($course->course_class > count($getBookingSlots)) { ?>
            <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                <a href="<?= base_url() ?>booking_slot?course_code=<?= base64_encode($course->course_code)?>&uid=<?= base64_encode(@$student_id)?>&bookingid=<?= base64_encode($getBookingData->id)?>" class="drivschol-btn w-100">Book slot for pending classes</a>
                <div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px; display: block !important; visibility: visible !important;">
                    <div style="margin-left: 10px;">
                    <?php
                    if(!empty($getBookingSlots)) {
                        $i = 1;
                        foreach ($getBookingSlots as $slot) {
                        if($slot->status == "1") { ?>
                        <p style="margin: 0px; font-size: 14px; color:#f59b24;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Pending)"; ?></p>
                        <?php } else if($slot->status == "2") { ?>
                        <p style="margin: 0px; font-size: 14px; color:red;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Canceled)"; ?></p>
                        <?php } else { ?>
                        <p style="margin: 0px; font-size: 14px; color:green;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Completed)"; ?></p>
                        <?php } ?>
                    <?php $i++; } } ?>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px; display: block !important; visibility: visible !important;">
                <div style="margin-left: 10px;">
                <?php
                if(!empty($getBookingSlots)) {
                    $i = 1;
                    foreach ($getBookingSlots as $slot) {
                        if($slot->status == "1") { ?>
                        <p style="margin: 0px; font-size: 14px; color:#f59b24;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Pending)"; ?></p>
                        <?php } else if($slot->status == "2") { ?>
                        <p style="margin: 0px; font-size: 14px; color:red;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Canceled)"; ?></p>
                        <?php } else { ?>
                        <p style="margin: 0px; font-size: 14px; color:green;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Completed)"; ?></p>
                        <?php } ?>
                <?php $i++; } } ?>
                </div>
            </div>
            <?php }
        } else { ?>
        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
            <a href="javascript:void(0)" onclick="completePayment(<?= @$getBookingData->id ?>)" class="drivschol-btn w-100">Book slot for pending classes</a>
        </div>
        <div class="completePayment_<?= @$getBookingData->id ?>" style="display: none;text-align: left; margin-top: 20px; color: #ed1c24; font-size: 15px;">Please complete your payment first for this course to book pending slots.</div>
        <?php }
    }
    public function changestatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Your status is Activate';
            } else {
                $msg = 'Your status is Inctivate';
            }
            if ($this->Adminmodel->update(['status' => $status], 'users', ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function delete_student($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from users where id = '.$id.'');
        if ($result) {
            $msg = '["Student is deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/student'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/student'), 'refresh');
        }
    }
}