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
        $getAssignedCourseList = $this->db->query("SELECT * FROM booking WHERE trainer_id = '".$loggedinUID."' ORDER BY id DESC")->result();
        $getAssignedCourseListCount = $this->db->query("SELECT count(id) as count FROM booking WHERE trainer_id = '".$loggedinUID."'")->row();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Trainer Dashboard',
            'subpage' => 'Trainer Dashboard',
            'getAssignedCourseList' => $getAssignedCourseList,
            'getAssignedCourseListCount' => $getAssignedCourseListCount
        );
        $this->load->view('header', $data);
		$this->load->view('trainer/dashboard');
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
        $this->load->view('trainer/profile_settings');
		$this->load->view('footer');
    }
    public function update_profile() {
        $user_id = $this->input->post('user_id');
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
                $old_pic = $this->db->get_where('users', ['id' => $user_id])->row()->image;
                if ($old_pic && file_exists('uploads/student/profilePic/'.$old_pic)) {
                    unlink('uploads/student/profilePic/'.$old_pic);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('trainer/profile-settings');
            }
        }
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'dob' => $this->input->post('dob'),
            'gender' => $this->input->post('gender'),
            // 'pfirst_name' => $this->input->post('pfirst_name'),
            // 'plast_name' => $this->input->post('plast_name'),
            // 'pemail' => $this->input->post('pemail'),
            // 'phone_2' => $this->input->post('pphone'),
            'address' => $this->input->post('address'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'zipcode' => $this->input->post('zipcode'),
            'certificates' => $this->input->post('certificates'),
            'licensenumber' => $this->input->post('licensenumber'),
            'languages' => $this->input->post('languages'),
            'experience' => $this->input->post('experience'),
            'expiration_date' => $this->input->post('expiration_date'),
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
        redirect('trainer/profile-settings');
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
        $this->load->view('trainer/change_password');
		$this->load->view('footer');
    }
    public function update_password() {
        $user_id = $this->input->post('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        if ($new_password !== $confirm_password) {
            $this->session->set_flashdata('error', 'New password and confirm password do not match.');
            redirect('trainer/change-password');
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
        redirect('trainer/change-password');
    }
    public function BookigData() {
        $booking_id = $this->input->post('booking_id');
        $course_id = $this->input->post('courseId');
        $course = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
        $getBookingData = $this->db->query("SELECT * FROM booking WHERE trainer_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course_id."'")->row();
        if(!empty($getBookingData->transaction_id)){
            $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result(); ?>
            <div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px; display: block !important; visibility: visible !important;">
                <div style="margin-left: 10px;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: space-around;">
                <?php
                if(!empty($getBookingSlots)) {
                    $i = 1;
                    foreach ($getBookingSlots as $slot) {
                        if($slot->status == "1") { ?>
                    <p style="margin: 0px; font-size: 14px; color:#f59b24;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Pending)"; ?></p>
                    <select class="form-control" id="class_status" name="class_status" style="width: 20%;margin-top: 0px;padding: 0px;text-align: center;border: 1px solid #000;">
                        <option value="">Status</option>
                        <option value="1">Pending</option>
                        <option value="2">Canceled</option>
                        <option value="3">Completed</option>
                    </select>
                    <?php } else if($slot->status == "2") { ?>
                    <p style="margin: 0px; font-size: 14px; color:red;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Canceled)"; ?></p>
                    <?php } else { ?>
                    <p style="margin: 0px; font-size: 14px; color:green;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Completed)"; ?></p>
                    <?php } ?>
                <?php $i++; } } ?>
                </div>
            </div>
        <?php }
    }
    public function course_note() {
        $booking_id = $this->input->post('booking_id');
        $course_note = $this->input->post('course_note');
        $data = array(
            'course_notebyins' => $course_note
        );
        $this->db->where('id', $booking_id);
        if ($this->db->update('booking', $data)) {
            echo json_encode(array('status' => 'success', 'message' => 'Note updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update note.'));
        }
    }
    public function logout() {
	    unset($_SESSION['bayhill']);
        $this->session->set_flashdata('message', 'You have logged out.');
        redirect('login');
	}
}