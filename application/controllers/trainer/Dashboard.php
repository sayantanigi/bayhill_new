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
                    <div id="bookingData">
                        <p style="margin: 0px; font-size: 14px; color:#f59b24;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Pending)"; ?></p>
                        <select class="form-control" id="class_status" name="class_status" style="width: 20%;margin-top: 0px;padding: 0px;text-align: center;border: 1px solid #000;" onchange="updateBookingStatus(<?= $slot->id; ?>, this.value);">
                            <option value="">Status</option>
                            <option value="1">Pending</option>
                            <option value="2">Canceled</option>
                            <option value="3">Completed</option>
                        </select>
                        <input type="hidden" name="booking_id" id="booking_id" value="<?= $slot->id; ?>">
                    </div>
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
    public function updateBookingStatus() {
        $booking_id = $this->input->post('booking_id');
        $status = $this->input->post('status');
        $data = array(
            'status' => $status
        );
        $this->db->where('id', $booking_id);
        if ($this->db->update('booking_details', $data)) {
            echo json_encode(array('status' => 'success', 'message' => 'Booking status updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update booking status.'));
        }
    }
    function availability() {
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Trainer Dashboard',
            'subpage' => 'Trainer Dashboard'
        );
        $data['trainer_id'] = $_SESSION['bayhill']['user_id'];
		$this->load->view('header', $data);
		$this->load->view('trainer/calender');
		$this->load->view('footer');
	}
    function getDateForWeekDay($startingDate, $weekDay) {
        $startDate = new DateTime($startingDate);
        $currentWeekDay = $startDate->format('l');
        $diffDays = (new DateTime($weekDay))->diff($startDate)->days;
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $currentDayIndex = array_search($currentWeekDay, $daysOfWeek);
        $targetDayIndex = array_search($weekDay, $daysOfWeek);
        $daysToAdd = ($targetDayIndex - $currentDayIndex + 7) % 7;
        $date = clone $startDate;
        $date->modify("+$daysToAdd days");
        return $date->format('Y-m-d');
    }
    function isEmptyWeekDay($weekDay) {
        //return empty(@$weekDay['day']) && empty(array_filter(@$weekDay['fromtime'])) && empty(array_filter(@$weekDay['totime']));
    }
    function getWeekdayNumber($weekday) {
        $weekdays = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 7
        ];
        if (isset($weekdays[$weekday])) {
            return $weekdays[$weekday];
        } else {
            return 1; // Default to Monday
        }
    }
    function utcDateTime($dateTimeInput, $inputTimezone) {
        $dateTime = new DateTime($dateTimeInput, new DateTimeZone($inputTimezone));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        return $dateTime->format('Y-m-d H:i:s');
    }
    public function create_availability() {
        $action_id = $_POST['action_id'];
        $user_id = $_POST['user_id'];
        if($action_id == '1') {
            $this->db->query("DELETE FROM trainer_availability WHERE user_id = '".$user_id."' AND is_datewise = '0' AND is_booked = '0'");
        }
        $this->db->query("UPDATE users SET timeZone = '".$_POST['timeZone']."' WHERE id = '".$user_id."'");
        $outputArray = [];
        $weekDays = ['weekDay1', 'weekDay2', 'weekDay3', 'weekDay4', 'weekDay5'];
        $fromTimes = ['fromtime1', 'fromtime2','fromtime3', 'fromtime4','fromtime5'];
        $toTimes = ['totime1', 'totime2','totime3', 'totime4','totime5'];
        for ($i = 0; $i < count($weekDays); $i++) {
            $weekDay = $_POST[$weekDays[$i]];
            $fromTime = $_POST[$fromTimes[$i]];
            $toTime = $_POST[$toTimes[$i]];
            $outputArray[$i]['weekDay'] = [
                'date' => $this->getDateForWeekDay($_POST['starting_date'], $weekDay),
                'day' => $weekDay,
                'fromtime' => $fromTime,
                'totime' => $toTime,
                'timeZone' => $_POST['timeZone'],
                'repeat_month' => @$_POST['repeat_month'],
                'schedule_status' => '1',
                'user_id' => $user_id,
            ];
        }
        $output = $outputArray;
        $filteredArray = array_filter($output, function($item) {
            return !$this->isEmptyWeekDay($item['weekDay']);
        });
        $filteredArray = array_values($filteredArray);
        foreach ($filteredArray as $entry) {
            $weekDay = $entry['weekDay'];
            foreach ($weekDay['fromtime'] as $key => $fromtime) {
                $totime = isset($weekDay['totime'][$key]) ? $weekDay['totime'][$key] : null;
                $utcfromTime = new DateTime($fromtime, new DateTimeZone($_POST['timeZone']));
                $utcfromTime->setTimezone(new DateTimeZone('UTC'));
                $utcFromTime = $utcfromTime->format('H:i');

                $utctoTime = new DateTime($totime, new DateTimeZone($_POST['timeZone']));
                $utctoTime->setTimezone(new DateTimeZone('UTC'));
                $utcToTime = $utctoTime->format('H:i');

                $utcStartDate = new DateTime($weekDay['date']." ".$fromtime, new DateTimeZone($_POST['timeZone']));
                $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                $utcStartDate = $utcStartDate->format('Y-m-d');

                $schedule_data = array(
                    'user_id' => $weekDay['user_id'],
                    'weekday' => $weekDay['day'],
                    'weekdayslot' => $fromtime." to ".$totime,
                    'timeZone' => $_POST['timeZone'],
                    'utcTime' => $utcFromTime." to ".$utcToTime,
                    'start_date' => $weekDay['date'],
                    'utcStartDate' => $utcStartDate,
                    'repeat_month' => $weekDay['repeat_month'],
                    'schedule_status' => $weekDay['schedule_status'],
                );

                $data = $schedule_data;
                if($data['repeat_month'] == '1') {
                    $repeatMonth = '12';
                    $schedule = [];
                    $startDate = new DateTime($data['start_date']);
                    $targetWeekday = $this->getWeekdayNumber($data['weekday']);
                    $currentMonth = $startDate->format('m');
                    $currentYear = $startDate->format('Y');
                    for ($i = 0; $i < $repeatMonth; $i++) {
                        $firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
                        $firstTargetWeekday = clone $firstDayOfMonth;
                        $firstDayOfWeek = $firstTargetWeekday->format('N');
                        $diff = $targetWeekday - $firstDayOfWeek;
                        if ($diff < 0) {
                            $diff += 7;
                        }
                        $firstTargetWeekday->modify("+$diff days");
                        if ($firstTargetWeekday < $startDate) {
                            $firstTargetWeekday->modify('+1 week');
                        }

                        while ($firstTargetWeekday->format('m') == $currentMonth) {
                            $utcStartDate = new DateTime($firstTargetWeekday->format('Y-m-d'), new DateTimeZone($data['timeZone']));
                            $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                            $utcStartDate = $utcStartDate->format('Y-m-d');
                            $schedule[] = [
                                'user_id' => $data['user_id'],
                                'weekday' => $data['weekday'],
                                'weekdayslot' => $data['weekdayslot'],
                                'timeZone' => $data['timeZone'],
                                'utcTime' => $data['utcTime'],
                                'start_date' => $firstTargetWeekday->format('Y-m-d'),
                                'utcStartDate' => $utcStartDate,
                                'repeat_month' => $data['repeat_month'],
                                'schedule_status' => $data['schedule_status'],
                            ];
                            $firstTargetWeekday->modify('+1 week');
                        }
                        $currentMonth++;
                        if ($currentMonth > 12) {
                            $currentMonth = 1;
                            $currentYear++;
                        }
                    }
                    $finalData = [];
                    foreach ($schedule as $key => $value) {
                        $finalData['user_id'] = $value['user_id'];
                        $finalData['weekday'] = $value['weekday'];
                        $finalData['weekdayslot'] = $value['weekdayslot'];
                        $finalData['timeZone'] = $value['timeZone'];
                        $finalData['utcTime'] = $value['utcTime'];
                        $finalData['start_date'] = $value['start_date'];
                        $finalData['utcStartDate'] = $value['utcStartDate'];
                        $finalData['repeat_month'] = $value['repeat_month'];
                        $finalData['schedule_status'] = $value['schedule_status'];
                        $this->Adminmodel->add('trainer_availability', $finalData);
                    }
                } else {
                    $repeatMonth = '1';
                    $schedule = [];
                    $startDate = new DateTime($data['start_date']);
                    $targetWeekday = $this->getWeekdayNumber($data['weekday']);
                    $currentMonth = $startDate->format('m');
                    $currentYear = $startDate->format('Y');
                    for ($i = 0; $i < $repeatMonth; $i++) {
                        $firstDayOfMonth = new DateTime($data['start_date']);
                        $firstTargetWeekday = clone $firstDayOfMonth;
                        $firstDayOfWeek = (int)$firstTargetWeekday->format('N');
                        $diff = $targetWeekday - $firstDayOfWeek;
                        if ($diff < 0) {
                            $diff += 7;
                        }
                        $firstTargetWeekday->modify("+$diff days");
                        if ($firstTargetWeekday < $startDate) {
                            $firstTargetWeekday->modify('+1 week');
                        }
                        while ($firstTargetWeekday->format('m') == $currentMonth) {
                            $utcStartDate = new DateTime($firstTargetWeekday->format('Y-m-d'), new DateTimeZone($data['timeZone']));
                            $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                            $utcStartDate = $utcStartDate->format('Y-m-d');
                            $schedule[] = [
                                'user_id' => $data['user_id'],
                                'weekday' => $data['weekday'],
                                'weekdayslot' => $data['weekdayslot'],
                                'timeZone' => $data['timeZone'],
                                'utcTime' => $data['utcTime'],
                                'start_date' => $firstTargetWeekday->format('Y-m-d'),
                                'utcStartDate' => $utcStartDate,
                                'repeat_month' => $data['repeat_month'],
                                'schedule_status' => $data['schedule_status'],
                            ];
                            $firstTargetWeekday->modify('+1 week');
                        }
                        $currentMonth++;
                        if ($currentMonth > 12) {
                            $currentMonth = 1;
                            $currentYear++;
                        }
                    }
                    $finalData = [];
                    //print_r($schedule);
                    foreach ($schedule as $key => $value) {
                        $finalData['user_id'] = $value['user_id'];
                        $finalData['weekday'] = $value['weekday'];
                        $finalData['weekdayslot'] = $value['weekdayslot'];
                        $finalData['timeZone'] = $value['timeZone'];
                        $finalData['utcTime'] = $value['utcTime'];
                        $finalData['start_date'] = $value['start_date'];
                        $finalData['utcStartDate'] = $value['utcStartDate'];
                        $finalData['repeat_month'] = $value['repeat_month'];
                        $finalData['schedule_status'] = $value['schedule_status'];
                        $this->Adminmodel->add('trainer_availability', $finalData);
                    }
                }
            }
        }
        echo '1';
    }
    public function createdatewiseavailability() {
        $user_id = $_POST['user_id'];
        $output = array();
        $specific_dates = explode(',', $_POST['specific_date'][0]);
        $this->db->query("DELETE FROM trainer_availability WHERE user_id = '".$user_id."' AND is_datewise = '1' AND is_booked = '0'");
        foreach ($specific_dates as $date) {
            $weekday = $this->getWeekdayName($date);
            foreach ($_POST['fromtimedate'] as $index => $start_time) {
                $end_time = $_POST['totimedate'][$index];
                $time_slot = $start_time . ' to ' . $end_time;

                $utcfromTimedate = new DateTime($start_time, new DateTimeZone($_POST['timeZonedate']));
                $utcfromTimedate->setTimezone(new DateTimeZone('UTC'));
                $utcFromTimedate = $utcfromTimedate->format('H:i');

                $utctoTimedate = new DateTime($end_time, new DateTimeZone($_POST['timeZonedate']));
                $utctoTimedate->setTimezone(new DateTimeZone('UTC'));
                $utcToTimedate = $utctoTimedate->format('H:i');

                $utcStartDate = new DateTime($date." ".$start_time, new DateTimeZone($_POST['timeZonedate']));
                $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                $utcStartDate = $utcStartDate->format('Y-m-d');

                $slot = array(
                    'user_id' => $_POST['user_id'],
                    'weekday' => $weekday,
                    'weekdayslot' => $time_slot,
                    'start_date' => $date,
                    'timeZone' => $_POST['timeZonedate'],
                    'utcTime' => $utcFromTimedate." to ".$utcToTimedate,
                    'utcStartDate' => $utcStartDate,
                    'schedule_status' => 1,
                    'is_booked' => 0
                );
                $output[] = $slot;
            }
        }
        $finalArray = $output;
        $storedata = [];
        foreach ($finalArray as $key1 => $value) {
            $storedata['user_id'] = $value['user_id'];
            $storedata['weekday'] = $value['weekday'];
            $storedata['weekdayslot'] = $value['weekdayslot'];
            $storedata['timeZone'] = $value['timeZone'];
            $storedata['start_date'] = $value['start_date'];
            $storedata['utcTime'] = $value['utcTime'];
            $storedata['utcStartDate'] = $value['utcStartDate'];
            $storedata['schedule_status'] = $value['schedule_status'];
            $storedata['is_booked'] = $value['is_booked'];
            $storedata['is_datewise'] = '1';
            $this->Adminmodel->add('trainer_availability', $storedata);
        }
		echo "1";
    }
    function getWeekdayName($date) {
        return date('l', strtotime($date)); // Returns the full weekday name (e.g., "Monday")
    }
    public function getBookingDetails() {
        $user_id = $this->input->post('user_id');
        $choosendate = $this->input->post('choosendate');
        $availability = $this->db->query("SELECT * FROM booking_details WHERE trainer_id = '".$user_id."' AND booking_date = '".$choosendate."'")->result();
        if (empty($availability)) {
            echo json_encode(array('status' => 'error', 'message' => 'No bookings found for the selected date.'));
            return;
        }
        $response = [];
        foreach ($availability as $slot) {
            $getBookingData = $this->db->query("SELECT * FROM booking WHERE id = '".$slot->booking_id."'")->row();
            $course = $this->db->query("SELECT * FROM courses WHERE id = '".$getBookingData->course_id."'")->row();
            $student = $this->db->query("SELECT * FROM users WHERE id = '".$getBookingData->user_id."'")->row();
            $response[] = array(
                'booking_id' => $slot->booking_id,
                'booking_date' => date('d-m-Y', strtotime($slot->booking_date)),
                'booking_time' => $slot->booking_time,
                'course_name' => $course->course_name,
                'student_name' => $student->first_name . ' ' . $student->last_name,
                'student_phone' => $student->phone,
                'student_email' => $student->email
            );
        }
        echo json_encode(array('status' => 'success', 'message' => $response));
    }
    public function logout() {
	    unset($_SESSION['bayhill']);
        $this->session->set_flashdata('message', 'You have logged out.');
        redirect('login');
	}
}