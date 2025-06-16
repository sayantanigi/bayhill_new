<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->session->userdata('bayhill')) {
			redirect('login');
		}
	}
	public function index() {
        $loggedinUID = $_SESSION['bayhill']['user_id'];
        $getPurchasedCourseList = $this->db->query("SELECT * FROM booking WHERE user_id = '".$loggedinUID."' ORDER BY id DESC")->result();
        $getPurchasedCourseListCount = $this->db->query("SELECT count(id) as count FROM booking WHERE user_id = '".$loggedinUID."'")->row();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'User Dashboard',
            'subpage' => 'User Dashboard',
            'getPurchasedCourseList' => $getPurchasedCourseList,
            'getPurchasedCourseListCount' => $getPurchasedCourseListCount
        );
        $this->load->view('header', $data);
		$this->load->view('users/dashboard');
		$this->load->view('footer');
	}
    public function profile_settings() {
        $loggedinUID = $_SESSION['bayhill']['user_id'];
        $getUserDetails = $this->db->query("SELECT * FROM users WHERE id = '".$loggedinUID."'")->row();
        $state_list = $this->db->query("SELECT * FROM states WHERE id = '1416'")->result();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Profile Settings',
            'subpage' => 'Profile Settings',
            'getUserDetails' => $getUserDetails,
            'state_list' => $state_list
        );
        $this->load->view('header', $data);
        $this->load->view('users/profile_settings');
		$this->load->view('footer');
    }
    public function update_profile() {
        $user_id = $this->input->post('user_id');
        // Handle file upload
        $profile_pic = '';
        if (!empty($_FILES['profile_pic']['name'])) {
            $config['upload_path'] = 'uploads/student/profilePic/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = uniqid() . '_' . $_FILES['profile_pic']['name'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('profile_pic')) {
                $fileData = $this->upload->data();
                $profile_pic = $fileData['file_name'];
                // Optionally, delete old file here if you want
                $old_pic = $this->db->get_where('users', ['id' => $user_id])->row()->image;
                if ($old_pic && file_exists('uploads/student/profilePic/'.$old_pic)) {
                    unlink('uploads/student/profilePic/'.$old_pic);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('profile-settings');
            }
        }
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'dob' => $this->input->post('dob'),
            'gender' => $this->input->post('gender'),
            'pfirst_name' => $this->input->post('pfirst_name'),
            'plast_name' => $this->input->post('plast_name'),
            'pemail' => $this->input->post('pemail'),
            'phone_2' => $this->input->post('pphone'),
            'address' => $this->input->post('address'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'zipcode' => $this->input->post('zipcode'),
        );
        // Update profile picture only if a new one was uploaded
        if ($profile_pic) {
            $data['image'] = $profile_pic;
        }
        $this->db->where('id', $user_id);
        if ($this->db->update('users', $data)) {
            $this->session->set_flashdata('message', 'Profile updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile.');
        }
        redirect('profile-settings');
    }
    public function change_password() {
        $loggedinUID = $_SESSION['bayhill']['user_id'];
        $getUserDetails = $this->db->query("SELECT * FROM users WHERE id = '".$loggedinUID."'")->row();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Change Password',
            'subpage' => 'Change Password',
            'getUserDetails' => $getUserDetails,
        );
        $this->load->view('header', $data);
        $this->load->view('users/change_password');
		$this->load->view('footer');
    }
    public function update_password() {
        $user_id = $this->input->post('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        if ($new_password !== $confirm_password) {
            $this->session->set_flashdata('error', 'New password and confirm password do not match.');
            redirect('change-password');
        }
        // Check if old password is correct
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        if (base64_encode($old_password) === $user->password) {
            // Update password
            $data = array(
                'password' => base64_encode($new_password)
            );
            $this->db->where('id', $user_id);
            if ($this->db->update('users', $data)) {
                $this->session->set_flashdata('message', 'Password changed successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to change password.');
            }
        } else {
            $this->session->set_flashdata('error', 'Old password is incorrect.');
        }
        redirect('change-password');
    }
    public function changePickupAddress() {
        $booking_id = $this->input->post('booking_id');
        $pickup_address = $this->input->post('pickup_address');
        $data = array(
            'pickup_address' => $pickup_address
        );
        $this->db->where('id', $booking_id);
        if ($this->db->update('booking', $data)) {
            echo json_encode(array('status' => 'success', 'message' => 'Pickup address updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update pickup address.'));
        }
    }
    public function course_note() {
        $booking_id = $this->input->post('booking_id');
        $course_note = $this->input->post('course_note');
        $data = array(
            'course_notebyuser' => $course_note
        );
        $this->db->where('id', $booking_id);
        if ($this->db->update('booking', $data)) {
            echo json_encode(array('status' => 'success', 'message' => 'Note updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update note.'));
        }
    }
    public function BookigData() {
        $booking_id = $this->input->post('booking_id');
        $course_id = $this->input->post('courseId');
        $course = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
        $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course_id."'")->row();
        if(!empty($getBookingData->transaction_id)){
            $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
            if($course->course_class > count($getBookingSlots)) { ?>
            <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                <a href="<?= base_url() ?>booking_slot?course_code=<?= base64_encode($course->course_code)?>&uid=<?= base64_encode($_SESSION['bayhill']['user_id'])?>&bookingid=<?= base64_encode($getBookingData->id)?>" class="drivschol-btn w-100">Book slot for pending classes</a>
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
    public function logout() {
	    unset($_SESSION['bayhill']);
        $this->session->set_flashdata('message', 'You have logged out.');
        redirect('login');
	}
}