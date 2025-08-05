<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->Adminmodel->loggedIn();
	}
	public function index() {
		$data = array(
			'title' => 'Dashboard',
			'page' => 'Dashboard',
			'subpage' => ''
		);
        $this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
    public function userfull_link() {
        $links_dmv = $this->db->query("SELECT * FROM usefull_link WHERE id = '1'")->row();
        $links_video = $this->db->query("SELECT * FROM usefull_link WHERE id = '2'")->row();
        $links_permit =  $this->db->query("SELECT * FROM usefull_link WHERE id = '3'")->row();
        $data = array(
			'title' => 'Usefull Link',
			'page' => 'Usefull Link',
			'subpage' => '',
            'links_dmv' => $links_dmv,
            'links_video' => $links_video,
            'links_permit' => $links_permit
		);
        $this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/userfull_link');
		$this->load->view('admin/footer');
    }
    public function save_Link() {
        if ($this->input->post('linkadd')) {
            if (!empty($this->input->post('link_name_dmv'))) {
                $count_dmv = count($this->input->post('link_name_dmv'));
                $all_data_dmv = array();

                for ($i = 0; $i < $count_dmv; $i++) {
                    $details_data_dmv = array(
                        'link_name_dmv' => $this->input->post('link_name_dmv')[$i],
                        'link_dmv' => $this->input->post('link_dmv')[$i]
                    );
                    $all_data_dmv[] = $details_data_dmv;
                }
                $serialized_dmv_data = serialize($all_data_dmv);
            }
            $mydata_dmv = array(
                'link_name_data' => $serialized_dmv_data
            );
            $where1 = array('link_name' => 'DMV_links');
            $this->Adminmodel->update($mydata_dmv, 'usefull_link', $where1);

            if (!empty($this->input->post('link_name_video'))) {
                $count_video = count($this->input->post('link_name_video'));
                $all_data_video = array();

                for ($i = 0; $i < $count_video; $i++) {
                    $details_data_video = array(
                        'link_name_video' => $this->input->post('link_name_video')[$i],
                        'link_video' => $this->input->post('link_video')[$i]
                    );
                    $all_data_video[] = $details_data_video;
                }
                $serialized_video_data = serialize($all_data_video);
            }
            $mydata_video = array(
                'link_name_data' => $serialized_video_data
            );
            $where2 = array('link_name' => 'Video_links');
            $this->Adminmodel->update($mydata_video, 'usefull_link', $where2);

            if (!empty($this->input->post('link_name_permit'))) {
                $count_permit = count($this->input->post('link_name_permit'));
                $all_data_permit = array();

                for ($i = 0; $i < $count_permit; $i++) {
                    $details_data_permit = array(
                        'link_name_permit' => $this->input->post('link_name_permit')[$i],
                        'link_permit' => $this->input->post('link_permit')[$i]
                    );
                    $all_data_permit[] = $details_data_permit;
                }
                $serialized_data_permit = serialize($all_data_permit);
            }
            $mydata_permit = array(
                'link_name_data' => $serialized_data_permit
            );
            $where3 = array('link_name' => 'Permit_test');
            if (!$this->Adminmodel->update($mydata_permit, 'usefull_link', $where3)) {
                $msg = 'error';
            } else {
                $msg = '["Setting saved successfully!", "success", "#A5DC86"]';
            }
            $this->session->set_flashdata('msg', $msg);
        }
        redirect(base_url('admin/userfull_link'), 'refresh');
    }
    public function getBookingDetails() {
        $booking_date = $this->input->post('choosendate');
        $booking_details = $this->db->query("SELECT * FROM booking_details WHERE booking_date = '".$booking_date."'")->result();
        if(!empty($booking_details)) {
            echo '<div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15px; border: 1px solid #f59b24; border-radius: 18px; display: block !important; visibility: visible !important;"><div style="margin-left: 10px;">';
            $i = 1;
            foreach ($booking_details as $value) {
                $booking_id = $value->booking_id;
                $getbooking = $this->db->query("SELECT * FROM booking WHERE id = '".$booking_id."'")->row();
                //course details
                $getcourseData = $this->db->query("SELECT * FROM courses WHERE id = '".$getbooking->course_id."'")->row();
                $courseName = @$getcourseData->course_name.' '.$getcourseData->course_name1;
                //trainer details
                $gettrainerData = $this->db->query("SELECT * FROM users WHERE id = '".$getbooking->trainer_id."'")->row();
                if(!empty($gettrainerData)) {
                    $trainerName = @$gettrainerData->salutation.' '.$gettrainerData->first_name.' '.$gettrainerData->last_name;
                } else {
                    $trainerName = "No trainer Assigned";
                }
                //student details
                $getstudentData = $this->db->query("SELECT * FROM users WHERE id = '".$getbooking->user_id."'")->row();
                if(!empty($getstudentData)) {
                    $studentName = @$getstudentData->salutation.' '.$getstudentData->first_name.' '.$getstudentData->last_name;
                } else {
                    $studentName = "";
                }
                echo '<div id="bookingData" style="display: flex; flex-direction: row; flex-wrap: nowrap; align-items: center;"><div class="col-sm-9" style="text-align: start;"><p style="margin: 0px; font-size: 14px; color:#f59b24;"><b>Course:</b> '.$courseName.'</p><p style="margin: 0px; font-size: 14px; color:#f59b24;"><b>Trainer:</b> '.$trainerName.'</p><p style="margin: 0px; font-size: 14px; color:#f59b24;"><b>Student:</b> '.$studentName.'</p><p style="margin: 0px; font-size: 14px; color:#f59b24;"><b>Date & Time:</b> '.date("d-m-Y", strtotime($value->booking_date)).' '.$value->booking_time.'</p><input type="hidden" name="booking_id" id="booking_id" value="'.$value->id.'"></div><div class="col-sm-3"><a href="'.base_url('admin/course/booking_details/'.base64_encode($booking_id)).'" class="btn btn-success" style="margin-top: 10px;" target="_blank">View Booking</a></div></div><hr style="border: 1px solid #000; color: #000; width: 625px;">';
                $i++;
            }
            echo '</div></div>';
        } else {
            echo '<div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15px; border: 1px solid #f59b24; border-radius: 18px; display: block !important; visibility: visible !important;"><div style="margin-left: 10px;"><p style="font-size: 16px; color: #f59b24;">No Booking Found for this date.</p></div></div>';
        }
    }
    public function getTrainerData(){
        $inputval = $this->input->post('query');
        $inputval_escaped = $this->db->escape_like_str($inputval);
        $sql = "SELECT id, first_name, last_name, username FROM users WHERE (first_name LIKE ? OR last_name LIKE ? OR username LIKE ?) AND user_type = '2' AND status = '1' AND email_verify_status = '1'";
        $like = "%$inputval_escaped%";
        $gettrainterdata = $this->db->query($sql, array($like, $like, $like))->result();
        if(!empty($gettrainterdata)){
            $response = [];
            foreach($gettrainterdata as $trainer){
                $response[] = [
                    'id' => $trainer->id,
                    'name' => trim($trainer->first_name . ' ' . $trainer->last_name),
                    'username' => $trainer->username
                ];
            }
            echo json_encode($response);
        } else {
            echo json_encode([]);
        }
        exit;
    }
    public function getStudentData(){
        $inputval = $this->input->post('query');
        $inputval_escaped = $this->db->escape_like_str($inputval);
        $sql = "SELECT id, first_name, last_name, username FROM users WHERE (first_name LIKE ? OR last_name LIKE ? OR username LIKE ?) AND user_type = '1' AND status = '1' AND email_verify_status = '1'";
        $like = "%$inputval_escaped%";
        $getstudentdata = $this->db->query($sql, array($like, $like, $like))->result();
        header('Content-Type: application/json');
        if(!empty($getstudentdata)){
            $response = [];
            foreach($getstudentdata as $student){
                $response[] = [
                    'id' => $student->id,
                    'name' => trim($student->first_name . ' ' . $student->last_name),
                    'username' => $student->username
                ];
            }
            echo json_encode($response);
        } else {
            echo json_encode([]);
        }
        exit;
    }
    public function getSearchData(){
        $inputval = $this->input->post('query');
        $inputval_escaped = $this->db->escape_like_str($inputval);
        $sql = "SELECT id, first_name, last_name, username, user_type FROM users WHERE (phone LIKE ?) AND status = '1' AND email_verify_status = '1'";
        $like = "%$inputval_escaped%";
        $getsearchdata = $this->db->query($sql, array($like))->result();
        header('Content-Type: application/json');
        if(!empty($getsearchdata)){
            $response = [];
            foreach($getsearchdata as $search){
                $response[] = [
                    'id' => $search->id,
                    'name' => trim($search->first_name . ' ' . $search->last_name),
                    'username' => $search->username,
                    'usertype' => $search->user_type
                ];
            }
            echo json_encode($response);
        } else {
            echo json_encode([]);
        }
        exit;
    }
    public function getStudentDataForBooking() {
        $email = $this->input->post('email');
        $inputval_escaped = $this->db->escape_like_str($email);
        $sql = "SELECT * FROM users WHERE email LIKE ? AND user_type = '1' AND status = '1' AND email_verify_status = '1'";
        $like = "%$inputval_escaped%";
        $getstudentdata = $this->db->query($sql, array($like))->result();
        header('Content-Type: application/json');
        if(!empty($getstudentdata)){
            $response = [];
            foreach($getstudentdata as $student){
                $response[] = [
                    'id' => $student->id,
                    'salutation' => @$student->salutation,
                    'first_name' => @$student->first_name,
                    'last_name' => @$student->last_name,
                    'phone' => @$student->phone,
                    'state' => @$student->state,
                    'city' => @$student->city,
                    'zipcode' => @$student->zipcode,
                    'address' => @$student->address,
                ];
            }
            echo json_encode($response);
        } else {
            echo json_encode([]);
        }
        exit;
    }

    public function save_booking() {
        $email = $this->input->post('email');
        $salutation = $this->input->post('salutation');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $phone = $this->input->post('phone');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $pincode = $this->input->post('pincode');
        $address = $this->input->post('address');
        $course_id = $this->input->post('courseList');
        $trainer_id = $this->input->post('trainerList');

        $booking_dates = $this->input->post('bookingdate');
        $bookingfromtimes = $this->input->post('bookingfromtime');
        $bookingtotimes = $this->input->post('bookingtotime');

        $user_row = $this->db->get_where('users', ['email' => $email])->row();
        if(!$user_row) {
            $student_data = [
                'unique_code' => random_int(100000, 999999),
                'user_type' => '1',
                'salutation' => $salutation,
                'first_name' => $fname,
                'last_name'  => $lname,
                'email' => $email,
                'phone' => $phone,
                'state' => $state,
                'city' => $city,
                'zipcode' => $pincode,
                'address' => $address,
                'status' => '1',
                'email_verify_status' => '1',
                'password' => base64_encode('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('users', $student_data);
            $student_id = $this->db->insert_id();
        } else {
            $student_id = $user_row->id;
        }
        $course_details = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
        if(!empty($course_details->offer_price)){
            $course_price = $course_details->offer_price;
        } else {
            $course_price = $course_details->course_price;
        }
        $settings = $this->db->query("SELECT * FROM settings")->row();
        $booking_data = [
            'user_id' => $student_id,
            'course_id'  => $course_id,
            'price'  => number_format((float)$course_price, 2, '.', ''),
            'tax'  => number_format((float)$settings->tax_amount, 2, '.', ''),
            'total_payment'  => number_format((float)($course_price + $settings->tax_amount), 2, '.', ''),
            'trainer_id' => $trainer_id,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => '0',
        ];
        $this->db->insert('booking', $booking_data);

        $booking_id = $this->db->insert_id();
        if (!empty($booking_dates)) {
            foreach ($booking_dates as $index => $date) {
                if ($date && !empty($bookingfromtimes[$index])) {
                    $detail_data = [
                        'booking_id' => $booking_id,
                        'booking_date' => $date,
                        'booking_time' => date('h:i a', strtotime($bookingfromtimes[$index]))." - ".date('h:i a', strtotime($bookingtotimes[$index])),
                        'trainer_id' => $trainer_id,
                        'status' => '1',
                    ];
                    $this->db->insert('booking_details', $detail_data);
                }
            }
        }
        echo json_encode(['status' => 'success', 'message' => 'Booking saved successfully.']);
        exit;
    }
}