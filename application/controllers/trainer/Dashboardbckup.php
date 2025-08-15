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
        $userId = $_SESSION['bayhill']['user_id'];

        // Load settings
        $calendarSetting = $this->db->select('calender')->where('settingId', 1)->get('settings')->row();
        $calendarDays = explode(',', $calendarSetting->calender);

        // Check start date
        $startDateData = $this->db->where('user_id', $userId)->order_by('start_date', 'ASC')->get('trainer_availability')->row_array();

        $startDate = !empty($startDateData['start_date']) ? date('Y-m-d', strtotime($startDateData['start_date'])) : "";
        $repeatMonth = !empty($startDateData['repeat_month']) ? $startDateData['repeat_month'] : 0;
        $actionId = empty($startDate) ? 0 : 1;

        // Existing availability grouped by weekday
        $availability = [];
        foreach ($calendarDays as $day) {
            list($dayId, $dayName) = explode('.', $day);
            $availability[$dayName] = $this->db->where(['user_id' => $userId, 'weekday' => $dayName, 'is_datewise' => 0])->order_by('weekday', 'ASC')->group_by('weekday')->get('trainer_availability')->result_array();
        }

        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Trainer Dashboard',
            'subpage' => 'Trainer Dashboard',
            'calendarDays' => $calendarDays,
            'availability' => $availability,
            'startDate' => $startDate,
            'repeatMonth' => $repeatMonth,
            'actionId' => $actionId,
            'timeZone' => $this->db->select('timeZone')->where('id', $userId)->get('users')->row()->timeZone
        );
        //$data['trainer_id'] = $_SESSION['bayhill']['user_id'];
		$this->load->view('header', $data);
		$this->load->view('trainer/calender');
		$this->load->view('footer');
	}
    public function create_availability()
    {
        $userId     = $this->input->post('user_id');
        $actionId   = $this->input->post('action_id');
        $timeZone   = $this->input->post('timeZone');
        $startDate  = $this->input->post('starting_date');
        $repeatMonthFlag = $this->input->post('repeat_month') ? 1 : 0;

        if ($actionId == '1') {
            $this->db->where('user_id', $userId)->where('is_datewise', 0)->where('is_booked', 0)->delete('trainer_availability');
        }

        // Update User Timezone
        $this->db->where('id', $userId)->update('users', ['timeZone' => $timeZone]);

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($daysOfWeek as $index => $dow) {
            $weekDayPOST = $this->input->post("weekDay" . ($index + 1));
            $fromTimes   = $this->input->post("fromtime" . ($index + 1));
            $toTimes     = $this->input->post("totime" . ($index + 1));

            if (!empty($weekDayPOST) && !empty(array_filter((array)$fromTimes)) && !empty(array_filter((array)$toTimes))) {

                $targetDate = $this->getDateForWeekDay($startDate, $dow);

                foreach ($fromTimes as $k => $fromTime) {
                    $toTime = $toTimes[$k] ?? null;
                    if (empty($fromTime) || empty($toTime)) continue;

                    $utcFrom = $this->convertToUTC($fromTime, $timeZone);
                    $utcTo   = $this->convertToUTC($toTime, $timeZone);

                    if ($repeatMonthFlag == 1) {
                        $this->generateMonthlySchedule($userId, $dow, $fromTime, $toTime, $utcFrom, $utcTo, $timeZone, $targetDate, $repeatMonthFlag);
                    } else {
                        $this->saveAvailability($userId, $dow, $fromTime, $toTime, $utcFrom, $utcTo, $timeZone, $targetDate, $repeatMonthFlag);
                    }
                }
            }
        }

        echo json_encode(['status' => 1, 'message' => 'Data updated successfully']);
    }

    private function getDateForWeekDay($startingDate, $dayName)
    {
        $date = new DateTime($startingDate);
        $currentDay = $date->format('l');
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $currentIndex = array_search($currentDay, $daysOfWeek);
        $targetIndex  = array_search($dayName, $daysOfWeek);
        $daysToAdd = ($targetIndex - $currentIndex + 7) % 7;
        if ($daysToAdd === 0) $daysToAdd = 7;
        $date->modify("+$daysToAdd days");
        return $date->format('Y-m-d');
    }

    private function convertToUTC($time, $timeZone)
    {
        $dt = new DateTime($time, new DateTimeZone($timeZone));
        $dt->setTimezone(new DateTimeZone('UTC'));
        return $dt->format('H:i');
    }

    private function saveAvailability($userId, $dow, $fromTime, $toTime, $utcFrom, $utcTo, $timeZone, $startDate, $repeatMonthFlag)
    {
        $utcStartDate = (new DateTime($startDate, new DateTimeZone($timeZone)))->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d');

        $data = [
            'user_id' => $userId,
            'weekday' => $dow,
            'weekdayslot' => $fromTime . " to " . $toTime,
            'timeZone' => $timeZone,
            'utcTime' => $utcFrom . " to " . $utcTo,
            'start_date' => $startDate,
            'utcStartDate' => $utcStartDate,
            'repeat_month' => $repeatMonthFlag,
            'schedule_status' => 1
        ];
        $this->Adminmodel->add('trainer_availability', $data);
    }

    private function generateMonthlySchedule($userId, $dow, $fromTime, $toTime, $utcFrom, $utcTo, $timeZone, $startDate, $repeatMonthFlag)
    {
        $start = new DateTime($startDate);
        $year = $start->format('Y');
        $month = $start->format('m');

        for ($i = 0; $i < 12; $i++) {
            $firstDayOfMonth = new DateTime("$year-$month-01");
            $targetWeekday = $this->getWeekdayNumber($dow);

            $diff = $targetWeekday - (int)$firstDayOfMonth->format('N');
            if ($diff < 0) $diff += 7;
            $firstDayOfMonth->modify("+$diff days");

            while ($firstDayOfMonth->format('m') == $month) {
                $targetDate = $firstDayOfMonth->format('Y-m-d');
                $this->saveAvailability($userId, $dow, $fromTime, $toTime, $utcFrom, $utcTo, $timeZone, $targetDate, $repeatMonthFlag);
                $firstDayOfMonth->modify('+1 week');
            }

            $month++;
            if ($month > 12) {
                $month = 1;
                $year++;
            }
        }
    }

    private function getWeekdayNumber($weekday)
    {
        $weekdays = [
            'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3,
            'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6, 'Sunday' => 7
        ];
        return $weekdays[$weekday] ?? 1;
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
    public function assessment() {
        $loggedinUID = $_SESSION['bayhill']['user_id'];
        $getUserDetails = $this->db->query("SELECT * FROM users WHERE id = '".$loggedinUID."'")->row();
        $getAssignedCourseList = $this->db->query("SELECT * FROM booking WHERE trainer_id = '".$loggedinUID."' ORDER BY id DESC")->result();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Trainer Assessment',
            'subpage' => 'Trainer Assessment',
            'getUserDetails' => $getUserDetails,
            'getAssignedCourseList' => $getAssignedCourseList,
        );
        $this->load->view('header', $data);
        $this->load->view('trainer/assessment');
        $this->load->view('footer');
    }
    public function assessmentSave() {
        $this->form_validation->set_rules('sessionDate', 'Session Date', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            return;
        }
        $data = [
            'session_date' => $this->input->post('sessionDate'),
            'session_status' => $this->input->post('sessionStatus'),
            'start_time' => $this->input->post('startTime'),
            'end_time' => $this->input->post('endTime'),
            'session_type' => $this->input->post('sessionType'),
            'student' => $this->input->post('student'),
            'instructor' => $this->input->post('instructor'),
            'vehicle' => $this->input->post('vehicle'),

            // Skills status and grades
            'changing_lane' => $this->input->post('dchanging_lane'),
            'changing_lane_grade' => $this->input->post('ichanging_lane'),

            'following_distance' => $this->input->post('dfollowing_distance'),
            'following_distance_grade' => $this->input->post('ifollowing_distance'),

            'left_turns' => $this->input->post('dleft_turns'),
            'left_turns_grade' => $this->input->post('ileft_turns'),

            'right_turns' => $this->input->post('dright_turns'),
            'right_turns_grade' => $this->input->post('iright_turns'),

            'staying_centered' => $this->input->post('dstaying_centered'),
            'staying_centered_grade' => $this->input->post('istaying_centered'),

            'general_parking' => $this->input->post('dgeneral_parking'),
            'general_parking_grade' => $this->input->post('igeneral_parking'),

            'straight_line_reversing' => $this->input->post('dstraight_line_reversing'),
            'straight_line_reversing_grade' => $this->input->post('istraight_line_reversing'),

            'intersections' => $this->input->post('dintersections'),
            'intersections_grade' => $this->input->post('iintersections'),

            'acceleration' => $this->input->post('dacceleration'),
            'acceleration_grade' => $this->input->post('iacceleration'),

            'breaking' => $this->input->post('dbreaking'),
            'breaking_grade' => $this->input->post('ibreaking'),

            'blind_spot' => $this->input->post('dblind_spot'),
            'blind_spot_grade' => $this->input->post('iblind_spot'),

            'freeway_driving' => $this->input->post('dfreeway_driving'),
            'freeway_driving_grade' => $this->input->post('ifreeway_driving'),

            'proper_bike_lane' => $this->input->post('dproper_bike_lane'),
            'proper_bike_lane_grade' => $this->input->post('iproper_bike_lane'),

            'unprotected_left_turn' => $this->input->post('dunprotected_left_turn'),
            'unprotected_left_turn_grade' => $this->input->post('iunprotected_left_turn'),

            'notes' => $this->input->post('notes')
        ];
        $checkExisting = $this->db->get_where('assessments', ['session_type' => $this->input->post('sessionType'), 'student' => $this->input->post('student'), 'instructor' => $this->input->post('instructor')])->row();
        if (!empty($checkExisting)) {
            echo json_encode(['status' => 'error', 'message' => 'Assessment for this session already exists.']);
            return;
        } else {
            $inserted = $this->db->insert('assessments', $data);
            if ($inserted) {
                echo json_encode(['status' => 'success', 'message' => 'Assessment saved successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save assessment.']);
            }
        }
    }
    public function assessment_report() {
        $student_id = base64_decode($this->input->get('studentID'));
        $course_id = base64_decode($this->input->get('courseID'));
        $instructor_id = base64_decode($this->input->get('instructorID'));
        $assessment_data = $this->db->query("SELECT * FROM assessments WHERE instructor = '".@$instructor_id."' AND student = '".@$student_id."' AND session_type = '".@$course_id."'")->row();
        $course_details = $this->db->query("SELECT * FROM courses WHERE id = '".$assessment_data->session_type."'")->row();
        $student_details = $this->db->query("SELECT * FROM users WHERE id = '".$assessment_data->student."'")->row();
        $trainer_details = $this->db->query("SELECT * FROM users WHERE id = '".$assessment_data->instructor."'")->row();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Assessment Report',
            'subpage' => 'Assessment Report',
            'assessment_data' => $assessment_data,
            'course_details' => $course_details,
            'student_details' => $student_details,
            'trainer_details' => $trainer_details
        );
        $this->load->view('header', $data);
        $this->load->view('trainer/assessment_report');
        $this->load->view('footer');
    }
    public function logout() {
	    unset($_SESSION['bayhill']);
        $this->session->set_flashdata('message', 'You have logged out.');
        redirect('login');
	}
}