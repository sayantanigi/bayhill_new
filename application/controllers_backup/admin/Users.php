<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->Adminmodel->loggedIn();
    }

    public function index() {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'Participants List',
            'subpage' => 'users',
        );

        $data['userlist'] = $this->Adminmodel->get_all_record('id, fname, lname, email, phone, address, status, image, email_verify_status, sub_id, customize_payment', 'users', array('user_type' => 1), array('id', 'DESC'), '');

        $data['user_subscription'] = $this->Adminmodel->get_all_record('id, name', 'subscription', array('status' => '1'), array('name', 'ASC'), '');

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users');
        $this->load->view('admin/footer');
    }

    public function view($id) {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'View Participants',
            'subpage' => 'users',
        );
        $data['user'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/view_users');
        $this->load->view('admin/footer');
    }

    public function add() {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'Add Participants',
            'subpage' => 'users',
        );
        $data['entity'] = $this->Adminmodel->get_all_record('*', 'health_entity', array('status' => '1'), array('name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/add_users');
        $this->load->view('admin/footer');
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('fname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
            if ($this->form_validation->run() == true) {
                if (!empty($this->input->post('profileImg'))) {
                    $data = array(
                        'fname' => strip_tags($this->input->post('fname')),
                        'lname' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'phone' => strip_tags($this->input->post('phone')),
                        'image' => strip_tags($this->input->post('profileImg')),
                        'status' => strip_tags($this->input->post('status')),
                        'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                        'health_etity' => $this->input->post('health_etity'),
                        'clinic' => $this->input->post('clinic'),
                        'provider' => $this->input->post('provider'),
                        'insurance_provider' => $this->input->post('insurance_provider'),
                        'user_type' => 1,
                        'password' => md5($this->input->post('password')),
                        'email_verify_status' => '1',
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    $result = $this->Adminmodel->add('users', $data);
                    if ($result) {

                        $response['status'] = 1;
                        $response['message'] = 'Participants added successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error occurred.Please try again.';
                    }
                } else {
                    $data = array(
                        'fname' => strip_tags($this->input->post('fname')),
                        'lname' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'phone' => strip_tags($this->input->post('phone')),
                        'status' => strip_tags($this->input->post('status')),
                        'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                        'health_etity' => $this->input->post('health_etity'),
                        'clinic' => $this->input->post('clinic'),
                        'provider' => $this->input->post('provider'),
                        'insurance_provider' => $this->input->post('insurance_provider'),
                        'user_type' => 1,
                        'password' => md5($this->input->post('password')),
                        'email_verify_status' => '1',
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    $result = $this->Adminmodel->add('users', $data);
                    if ($result) {

                        $response['status'] = 1;
                        $response['message'] = 'Participants added successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error occurred.Please try again.';
                    }
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'pass_error' => form_error('password'),
                    'cnfpass_error' => form_error('confirm_password'),
                    'email_error' => form_error('email'),
                    'fname_error' => form_error('fname'),
                    'lname_error' => form_error('lname'),
                    'status_error' => form_error('status'),
                    'dob_error' => form_error('dob_error'),
                );
            }
        }
        echo json_encode($response);
    }

    public function email_check($str) {
        $con = array(
            'returnType' => 'count',
            'conditions' => array(
                'email' => $str
            )
        );
        $checkEmail = $this->Adminmodel->UniqueEmail($con);
        if ($checkEmail->num_rows() > 0) {
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function recruiter_email_check($str) {
        $con = array(
            'returnType' => 'count',
            'conditions' => array(
                'email' => $str
            )
        );
        $checkEmail = $this->Adminmodel->UniqueEmail($con);
        if ($checkEmail->num_rows() > 0) {
            $this->form_validation->set_message('recruiter_email_check', 'The given email already exists.');
            return FALSE;
        } else {
            $eLength = strlen($str) - 1;
            $local = substr($str, $eLength - 3, $eLength);
            if ($local === '.edu') {
                return TRUE;
            } else {
                $this->form_validation->set_message('recruiter_email_check', 'The given email address must end in .edu.');
                return FALSE;
            }
        }
    }

    public function edit($id) {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'Edit Participants',
            'subpage' => 'users',
        );

        $data['user'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $data['entity'] = $this->Adminmodel->get_all_record('*', 'health_entity', array('status' => '1'), array('name', 'ASC'), '');

        if ($data['user']->health_etity) {
            $data['clinicAdmin'] = $this->Adminmodel->get_all_record('*', 'clinic_admin', array('health_entity' => $data['user']->health_etity), array('name', 'ASC'), '');
        } else {
            $data['clinicAdmin'] = '';
        }

        if ($data['user']->clinic) {
            $data['provider'] = $this->Adminmodel->get_all_record('*', 'provider', array('clinic_admin' => $data['user']->clinic), array('name', 'ASC'), '');
        } else {
            $data['provider'] = '';
        }


        //print_r($data['clinicAdmin']);die;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/edit_users');
        $this->load->view('admin/footer');
    }

    public function editIndividuals() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $this->input->post('userId');
            // $recruiterInfo = $this->Adminmodel->get_by('users', 'single', array('id' => $userId), '', 1);
            // if($recruiterInfo->email != strip_tags($this->input->post('email'))){
            // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            // } else {
            // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            // }
            $this->form_validation->set_rules('fname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
            if ($this->form_validation->run() == true) {
                if (!empty($this->input->post('profileImg'))) {
                    $data = array(
                        'fname' => strip_tags($this->input->post('fname')),
                        'lname' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'profile' => strip_tags($this->input->post('profileImg')),
                        'address' => strip_tags($this->input->post('address')),
                        'status' => strip_tags($this->input->post('status')),
                        'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                        'health_etity' => @$this->input->post('health_etity'),
                        'clinic' => @$this->input->post('clinic'),
                        'provider' => @$this->input->post('provider'),
                        'insurance_provider' => $this->input->post('insurance_provider'),
                        'user_type' => 1,
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
                    if ($result) {
                        $response['status'] = 1;
                        $response['message'] = 'Participants updated successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error ocure.Please try again.';
                    }
                } else {

                    //echo date('Y-m-d', strtotime($this->input->post('dob')));die;
                    $data = array(
                        'fname' => strip_tags($this->input->post('fname')),
                        'lname' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'status' => strip_tags($this->input->post('status')),
                        'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                        'health_etity' => @$this->input->post('health_etity'),
                        'clinic' => @$this->input->post('clinic'),
                        'provider' => @$this->input->post('provider'),
                        'insurance_provider' => $this->input->post('insurance_provider'),
                        'user_type' => 1,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
                    if ($result) {
                        $response['status'] = 1;
                        $response['message'] = 'Participants updated successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error occurred.Please try again.';
                    }
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'email_error' => form_error('email'),
                    'status_error' => form_error('status'),
                    'fname_error' => form_error('fname'),
                    'lname_error' => form_error('lname'),
                    'dob_error' => form_error('dob'),
                );
            }
        }
        echo json_encode($response);
    }

    function deleteUser($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from users where id = ' . $id . '');
        if ($result) {
            $msg = '["User is deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/users'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/users'), 'refresh');
        }
    }

    public function profile($id) {
        $data = array(
            'title' => 'Individuals Profile',
            'page' => 'Individuals Profile',
            'subpage' => 'individuals-players',
                //'redirect' => 'lists'
        );
        $data['profile'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $data['academics'] = $this->Adminmodel->get_by('academics', FALSE, array('user_id' => $id), '', '');
        $data['athletics'] = $this->Adminmodel->get_by('athletics', 'single', array('user_id' => $id), '', 1);
        $data['exprience'] = $this->Adminmodel->get_by('exprience', FALSE, array('user_id' => $id), '', '');
        $data['reference'] = $this->Adminmodel->get_by('reference', FALSE, array('user_id' => $id), '', '');
        $data['guardian'] = $this->Adminmodel->get_by('guardian', FALSE, array('user_id' => $id), '', '');
        //print_r($data['academics']);
        if (!empty($data['profile']->country)) {
            $data['statelist'] = $this->Adminmodel->get_all_record('*', 'state', array('country_id' => $data['profile']->country), array('state_name', 'ASC'), '');
            //print_r($data['statelist']);
        }

        if (!empty($data['profile']->state)) {
            $data['citylist'] = $this->Adminmodel->get_all_record('*', 'city', array('state_id' => $data['profile']->state), array('city_name', 'ASC'), '');
            //print_r($data['statelist']);
        }
        $data['sportslist'] = $this->Adminmodel->get_all_record('*', 'sports', '', array('id', 'DESC'), '');
        $data['countrylist'] = $this->Adminmodel->get_all_record('*', 'country', '', array('country_name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/user_profile');
        $this->load->view('admin/footer');
    }

    public function changestatus() {
        if ($this->input->post('userId')) {
            $userId = $this->input->post('userId');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Your status is Activate';
            } else {
                $msg = 'Your status is Inctivate';
            }

            if ($this->Adminmodel->update(['status' => $status], 'users', ['id' => $userId])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }

    public function customizePaychangestatus() {
        if ($this->input->post('userId')) {
            $userId = $this->input->post('userId');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Your customize payment status is Activate';
            } else {
                $msg = 'Your customize payment status is Inctivate';
            }

            if ($this->Adminmodel->update(['customize_payment' => $status], 'users', ['id' => $userId])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }

    function health_coach() {
        $data = array(
            'title' => 'Health Coach List',
            'page' => 'Health Coach',
            'subpage' => 'health-coach',
                //'redirect' => 'lists'
        );

        $data['userlist'] = $this->Adminmodel->get_all_record('*', 'users', array('user_type' => 2), array('id', 'DESC'), '');

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/team_coach');
        $this->load->view('admin/footer');
    }

    public function add_coach() {
        $data = array(
            'title' => 'Add Health Coach',
            'page' => 'Health Coach',
            'subpage' => 'health-coach',
                //'redirect' => 'lists'
        );
        // $data['sportslist'] = $this->Adminmodel->get_all_record('*', 'sports', '', array('id', 'DESC'), '');
        $data['entity'] = $this->Adminmodel->get_all_record('*', 'health_entity', array('status' => '1'), array('name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/add_coach');
        $this->load->view('admin/footer');
    }

    public function addcoach() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            if ($this->form_validation->run() == true) {

                $data = array(
                    'fname' => strip_tags($this->input->post('fname')),
                    'lname' => strip_tags($this->input->post('lname')),
                    'email' => strip_tags($this->input->post('email')),
                    'phone' => strip_tags($this->input->post('phone')),
                    'image' => strip_tags($this->input->post('profileImg')),
                    'address' => strip_tags($this->input->post('address')),
                    'latitude' => strip_tags($this->input->post('latitude')),
                    'longitude' => strip_tags($this->input->post('longitude')),
                    'country' => strip_tags($this->input->post('country')),
                    'city' => strip_tags($this->input->post('city')),
                    'state' => strip_tags($this->input->post('state')),
                    'zipcode' => strip_tags($this->input->post('pincode')),
                    'password' => md5($this->input->post('password')),
                    'status' => strip_tags($this->input->post('status')),
                    'degree' => strip_tags($this->input->post('degree')),
                    'clinical_interests' => strip_tags($this->input->post('clinical_interests')),
                    'languages' => strip_tags($this->input->post('languages')),
                    'specializations' => strip_tags($this->input->post('specializations')),
                    'certificates' => strip_tags($this->input->post('certificates')),
                    'max_week' => strip_tags($this->input->post('max_week')),
                    'health_etity' => @$this->input->post('health_etity'),
                    'clinic' => @$this->input->post('clinic'),
                    'user_type' => 2,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->add('users', $data);
                if ($result) {

                    if (!empty($this->input->post('coverImg'))) {
                        $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                        $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $result));
                    }



                    $response['status'] = 1;
                    $response['message'] = 'Health coach added successfully.';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Some error occurred.Please try again.';
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'pass_error' => form_error('password'),
                    'cnfpass_error' => form_error('confirm_password'),
                    'email_error' => form_error('email'),
                );
            }
        }
        echo json_encode($response);
    }

    public function edit_teamcoach($id) {
        $data = array(
            'title' => 'Edit Health Coach',
            'page' => 'Health Coach',
            'subpage' => 'health-coach',
                //'redirect' => 'lists'
        );
        $data['user'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $data['entity'] = $this->Adminmodel->get_all_record('*', 'health_entity', array('status' => '1'), array('name', 'ASC'), '');

        if ($data['user']->health_etity) {
            $data['clinicAdmin'] = $this->Adminmodel->get_all_record('*', 'clinic_admin', array('health_entity' => $data['user']->health_etity), array('name', 'ASC'), '');
        } else {
            $data['clinicAdmin'] = '';
        }
        //echo $this->db->last_query();
        //print_r($data['user']);die;
        // $data['academics'] = $this->Adminmodel->get_by('academics', 'single', array('user_id' => $id), '', '');
        // $data['athletics'] = $this->Adminmodel->get_by('athletics', 'single', array('user_id' => $id), '', 1);
        // $data['sportslist'] = $this->Adminmodel->get_all_record('*', 'sports', '', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/edit_teamcoach');
        $this->load->view('admin/footer');
    }

    function edit_team_coach() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $this->input->post('userId');
            $recruiterInfo = $this->Adminmodel->get_by('users', 'single', array('id' => $userId), '', 1);
            if ($recruiterInfo->email != strip_tags($this->input->post('email'))) {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            } else {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            }
            if ($this->form_validation->run() == true) {
                if (!empty($this->input->post('profileImg'))) {

                    $data = array(
                        'fname' => strip_tags($this->input->post('fname')),
                        'lname' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'phone' => strip_tags($this->input->post('phone')),
                        'image' => strip_tags($this->input->post('profileImg')),
                        'address' => strip_tags($this->input->post('address')),
                        'latitude' => strip_tags($this->input->post('latitude')),
                        'longitude' => strip_tags($this->input->post('longitude')),
                        'country' => strip_tags($this->input->post('country')),
                        'city' => strip_tags($this->input->post('city')),
                        'state' => strip_tags($this->input->post('state')),
                        'zipcode' => strip_tags($this->input->post('pincode')),
                        'password' => md5($this->input->post('password')),
                        'status' => strip_tags($this->input->post('status')),
                        'degree' => strip_tags($this->input->post('degree')),
                        'clinical_interests' => strip_tags($this->input->post('clinical_interests')),
                        'languages' => strip_tags($this->input->post('languages')),
                        'specializations' => strip_tags($this->input->post('specializations')),
                        'certificates' => strip_tags($this->input->post('certificates')),
                        'max_week' => strip_tags($this->input->post('max_week')),
                        'health_etity' => @$this->input->post('health_etity'),
                        'clinic' => @$this->input->post('clinic'),
                        'user_type' => 2,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
                    if ($result) {
                        if (!empty($this->input->post('coverImg'))) {
                            $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                            $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                        }

                        $response['status'] = 1;
                        $response['message'] = 'Health coach updated successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error occurred.Please try again.';
                    }
                } else {
                    $data = array(
                        'fname' => strip_tags($this->input->post('fname')),
                        'lname' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'phone' => strip_tags($this->input->post('phone')),
                        'address' => strip_tags($this->input->post('address')),
                        'latitude' => strip_tags($this->input->post('latitude')),
                        'longitude' => strip_tags($this->input->post('longitude')),
                        'country' => strip_tags($this->input->post('country')),
                        'city' => strip_tags($this->input->post('city')),
                        'state' => strip_tags($this->input->post('state')),
                        'zipcode' => strip_tags($this->input->post('pincode')),
                        'password' => md5($this->input->post('password')),
                        'status' => strip_tags($this->input->post('status')),
                        'degree' => strip_tags($this->input->post('degree')),
                        'clinical_interests' => strip_tags($this->input->post('clinical_interests')),
                        'languages' => strip_tags($this->input->post('languages')),
                        'specializations' => strip_tags($this->input->post('specializations')),
                        'certificates' => strip_tags($this->input->post('certificates')),
                        'max_week' => strip_tags($this->input->post('max_week')),
                        'health_etity' => @$this->input->post('health_etity'),
                        'clinic' => @$this->input->post('clinic'),
                        'user_type' => 2,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
                    if ($result) {
                        if (!empty($this->input->post('coverImg'))) {
                            $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                            $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                        }


                        $response['status'] = 1;
                        $response['message'] = 'Health coach updated successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error occurred.Please try again.';
                    }
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'email_error' => form_error('email'),
                );
            }
        }
        echo json_encode($response);
    }

    public function view_teamcoach($id) {
        $data = array(
            'title' => 'View Health Coach',
            'page' => 'Health Coach',
            'subpage' => 'health-coach',
                //'redirect' => 'lists'
        );
        $data['user'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/view_teamcoach');
        $this->load->view('admin/footer');
    }

    function deleteTeamcoach($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from users where id = ' . $id . '');
        if ($result) {
            $msg = '["Deal is deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/team-coach'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/team-coach'), 'refresh');
        }
    }

    public function coach_profile($id) {
        $data = array(
            'title' => 'Team Coach Profile',
            'page' => 'Team Coach Profile',
            'subpage' => 'team-coach',
                //'redirect' => 'lists'
        );
        $data['profile'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $data['contact'] = $this->Adminmodel->get_all_record('address, country, state, city, pincode', 'users', array('id' => $id), '', '');
        $data['team'] = $this->Adminmodel->get_all_record('team_name, team_description, team_image, teamcover_image', 'users', array('id' => $id), '', '');
        $data['academics'] = $this->Adminmodel->get_by('academics', FALSE, array('user_id' => $id), '', '');
        $data['athletics'] = $this->Adminmodel->get_by('athletics', 'single', array('user_id' => $id), '', 1);
        $data['exprience'] = $this->Adminmodel->get_by('exprience', FALSE, array('user_id' => $id), '', '');
        $data['reference'] = $this->Adminmodel->get_by('reference', FALSE, array('user_id' => $id), '', '');
        $data['guardian'] = $this->Adminmodel->get_by('guardian', FALSE, array('user_id' => $id), '', '');
        //print_r($data['profile']);
        if (!empty($data['profile']->country)) {
            $data['statelist'] = $this->Adminmodel->get_all_record('*', 'state', array('country_id' => $data['profile']->country), array('state_name', 'ASC'), '');
            //print_r($data['statelist']);
        }

        if (!empty($data['profile']->state)) {
            $data['citylist'] = $this->Adminmodel->get_all_record('*', 'city', array('state_id' => $data['profile']->state), array('city_name', 'ASC'), '');
            //print_r($data['statelist']);
        }
        $data['sportslist'] = $this->Adminmodel->get_all_record('*', 'sports', '', array('id', 'DESC'), '');
        $data['countrylist'] = $this->Adminmodel->get_all_record('*', 'country', '', array('country_name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/teamcoach_profile');
        $this->load->view('admin/footer');
    }

    function recruiter() {
        $data = array(
            'title' => 'Recruiter',
            'page' => 'Recruiter',
            'subpage' => 'recruiter',
                //'redirect' => 'lists'
        );

        // if($vendorId !=null){
        // $vendor_clause = "WHERE d.is_approved='1' AND d.vendorId = '$vendorId'";
        // }else{
        // $vendor_clause = "WHERE d.is_approved='1'";
        // }
        // //Fetching orders and their details from db
        //$fetch_deal_sql = "select first_name, last_name, email, phone, address, status from users where user_type = 'Individual'";
        //$data['userlist'] = $this->mymodel->get_all_record($fetch_deal_sql,false);
        $data['userlist'] = $this->Adminmodel->get_all_record('id, first_name, last_name, email, phone, address, status', 'users', array('user_type' => 'Recruiter'), array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/recruiter');
        $this->load->view('admin/footer');
    }

    function add_recruiter() {
        $data = array(
            'title' => 'Add Recruiter',
            'page' => 'Add Recruiter',
            'subpage' => 'recruiter',
                //'redirect' => 'lists'
        );

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/add_recruiter');
        $this->load->view('admin/footer');
    }

    function addRequiter() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_recruiter_email_check');
            if ($this->form_validation->run() == true) {
                // if(!empty($_FILES['profile_image']['name'])){
                // $config['upload_path'] = 'uploads/profile_image'; # check path is correct
                // $config['allowed_types'] = 'jpg|png|jpeg'; # add video extenstion on here
                // $config['overwrite'] = FALSE;
                // $config['remove_spaces'] = TRUE;
                // $image_name = preg_replace("/\s+/", "_", $_FILES['profile_image']['name']);
                // $config['file_name'] = $image_name;
                // $this->load->library('upload', $config);
                // $this->upload->initialize($config);
                // if (!$this->upload->do_upload('profile_image')) {
                // $array = array('error' => true, 'profile_image_error' => $this->upload->display_errors());
                // echo json_encode($array);
                // exit();
                // } else {
                // $url = $image_name;
                // $data = array(
                // 'first_name' => strip_tags($this->input->post('fname')),
                // 'last_name' => strip_tags($this->input->post('lname')),
                // 'email' => strip_tags($this->input->post('email')),
                // 'phone' => strip_tags($this->input->post('phone')),
                // 'profile_image' => $url,
                // 'address' => strip_tags($this->input->post('address')),
                // 'latitude' => strip_tags($this->input->post('latitude')),
                // 'longitude' => strip_tags($this->input->post('longitude')),
                // 'password' => md5($this->input->post('longitude')),
                // 'status' => strip_tags($this->input->post('status')),
                // 'user_type' => 'Recruiter',
                // 'created_at'   => date('Y-m-d H:i:s')
                // );
                // $result= $this->Adminmodel->add('users', $data);
                // if($result){
                // $response['status'] = 1;
                // $response['message'] = 'Recruiter addedd successfully.';
                // }else{
                // $response['status'] = 0;
                // $response['message'] = 'Some error ocure.Please try again.';
                // }
                // }
                // }else{
                $data = array(
                    'first_name' => strip_tags($this->input->post('fname')),
                    'last_name' => strip_tags($this->input->post('lname')),
                    'email' => strip_tags($this->input->post('email')),
                    'phone' => strip_tags($this->input->post('phone')),
                    'profile_image' => strip_tags($this->input->post('profileImg')),
                    'address' => strip_tags($this->input->post('address')),
                    'latitude' => strip_tags($this->input->post('latitude')),
                    'longitude' => strip_tags($this->input->post('longitude')),
                    'password' => md5($this->input->post('longitude')),
                    'status' => strip_tags($this->input->post('status')),
                    'user_type' => 'Recruiter',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->add('users', $data);
                if ($result) {
                    if (!empty($this->input->post('coverImg'))) {
                        $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                        $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $result));
                    }
                    $response['status'] = 1;
                    $response['message'] = 'Recruiter addedd successfully.';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Some error ocure.Please try again.';
                }
                //}
            } else {
                $response = array(
                    'vali_error' => 1,
                    'pass_error' => form_error('password'),
                    'cnfpass_error' => form_error('confirm_password'),
                    'email_error' => form_error('email'),
                );
            }
        }
        echo json_encode($response);
    }

    public function edit_recruiter($id) {
        $data = array(
            'title' => 'Edit Recruiter',
            'page' => 'Edit Recruiter',
            'subpage' => 'recruiter',
                //'redirect' => 'lists'
        );
        $data['user'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/edit_recruiter');
        $this->load->view('admin/footer');
    }

    function editRecruiter() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
            // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $userId = $this->input->post('userId');
            $recruiterInfo = $this->Adminmodel->get_by('users', 'single', array('id' => $userId), '', 1);
            if ($recruiterInfo->email != strip_tags($this->input->post('email'))) {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_recruiter_email_check');
            } else {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            }
            if ($this->form_validation->run() == true) {
                if (!empty($this->input->post('profileImg'))) {
                    // $config['upload_path'] = 'uploads/profile_image'; # check path is correct
                    // $config['allowed_types'] = 'jpg|png|jpeg'; # add video extenstion on here
                    // $config['overwrite'] = FALSE;
                    // $config['remove_spaces'] = TRUE;
                    // $image_name = preg_replace("/\s+/", "_", $_FILES['profile_image']['name']);
                    // $config['file_name'] = $image_name;
                    // $this->load->library('upload', $config);
                    // $this->upload->initialize($config);
                    // if (!$this->upload->do_upload('profile_image')) {
                    // $array = array('error' => true, 'profile_image_error' => $this->upload->display_errors());
                    // echo json_encode($array);
                    // exit();
                    // } else {
                    //$url = $image_name;
                    $data = array(
                        'first_name' => strip_tags($this->input->post('fname')),
                        'last_name' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'phone' => strip_tags($this->input->post('phone')),
                        //'profile_image' => $url,
                        'profile_image' => strip_tags($this->input->post('profileImg')),
                        'address' => strip_tags($this->input->post('address')),
                        'latitude' => strip_tags($this->input->post('latitude')),
                        'longitude' => strip_tags($this->input->post('longitude')),
                        'status' => strip_tags($this->input->post('status')),
                        'user_type' => 'Recruiter',
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
                    if ($result) {
                        if (!empty($this->input->post('coverImg'))) {
                            $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                            $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                        }
                        $response['status'] = 1;
                        $response['message'] = 'Recruiter updated successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error ocure.Please try again.';
                    }
                    //}
                } else {
                    $data = array(
                        'first_name' => strip_tags($this->input->post('fname')),
                        'last_name' => strip_tags($this->input->post('lname')),
                        'email' => strip_tags($this->input->post('email')),
                        'phone' => strip_tags($this->input->post('phone')),
                        'address' => strip_tags($this->input->post('address')),
                        'latitude' => strip_tags($this->input->post('latitude')),
                        'longitude' => strip_tags($this->input->post('longitude')),
                        'status' => strip_tags($this->input->post('status')),
                        'user_type' => 'Recruiter',
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
                    if ($result) {
                        if (!empty($this->input->post('coverImg'))) {
                            $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                            $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                        }
                        $response['status'] = 1;
                        $response['message'] = 'Recruiter updated successfully.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error ocure.Please try again.';
                    }
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'email_error' => form_error('email'),
                );
            }
        }
        echo json_encode($response);
    }

    public function view_recruiter($id) {
        $data = array(
            'title' => 'View Recruiter',
            'page' => 'View Recruiter',
            'subpage' => 'recruiter',
                //'redirect' => 'lists'
        );
        $data['user'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/view_recruiter');
        $this->load->view('admin/footer');
    }

    public function recruiter_profile($id) {
        $data = array(
            'title' => 'Recruiter Profile',
            'page' => 'Recruiter Profile',
            'subpage' => 'recruiter',
                //'redirect' => 'lists'
        );
        $data['profile'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $data['academics'] = $this->Adminmodel->get_by('academics', 'single', array('user_id' => $id), '', 1);
        $data['athletics'] = $this->Adminmodel->get_by('athletics', 'single', array('user_id' => $id), '', 1);
        $data['exprience'] = $this->Adminmodel->get_by('exprience', 'single', array('user_id' => $id), '', 1);
        $data['reference'] = $this->Adminmodel->get_by('reference', 'single', array('user_id' => $id), '', 1);
        //print_r($data['profile']);
        if (!empty($data['profile']->country)) {
            $data['statelist'] = $this->Adminmodel->get_all_record('*', 'state', array('country_id' => $data['profile']->country), array('state_name', 'ASC'), '');
            //print_r($data['statelist']);
        }

        if (!empty($data['profile']->state)) {
            $data['citylist'] = $this->Adminmodel->get_all_record('*', 'city', array('state_id' => $data['profile']->state), array('city_name', 'ASC'), '');
            //print_r($data['statelist']);
        }

        $data['countrylist'] = $this->Adminmodel->get_all_record('*', 'country', '', array('country_name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/recruiter_profile');
        $this->load->view('admin/footer');
    }

    function deleteRecruiter($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from users where id = ' . $id . '');
        if ($result) {
            $msg = '["Recruiter is deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/recruiter'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/recruiter'), 'refresh');
        }
    }

    function state() {
        if ($this->input->post('country_id')) {
            $countryId = $this->input->post('country_id');
            echo $this->Adminmodel->state($countryId);
        }
    }

    function city() {

        if ($this->input->post('state_id')) {
            $stateId = $this->input->post('state_id');
            echo $this->Adminmodel->get_city($stateId);
        }
    }

    function addUserprofile() {
        //print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $this->input->post('userId');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $pro_designation = $this->input->post('pro_designation');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $profile_bio = $this->input->post('profile_bio');
            $area_interest = $this->input->post('area_interest');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $pincode = $this->input->post('pincode');
            $sport_id = $this->input->post('sport');

            $userInfo = array(
                'first_name' => strip_tags($fname),
                'last_name' => strip_tags($lname),
                'designation' => strip_tags($pro_designation),
                'email' => strip_tags($email),
                'phone' => strip_tags($phone),
                'address' => strip_tags($address),
                'latitude' => strip_tags($latitude),
                'longitude' => strip_tags($longitude),
                'country' => strip_tags($country),
                'city' => strip_tags($city),
                'state' => strip_tags($state),
                'bio' => strip_tags($profile_bio),
                'area_interest' => strip_tags($area_interest),
                'pincode' => strip_tags($pincode),
                'sport_id' => strip_tags($sport_id),
                'profile_status' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            );
            $result = $this->Adminmodel->update($userInfo, 'users', array('id' => $userId));
            if (!empty($result)) {
                $deleteAca = $this->db->query('delete from academics where user_id = ' . $userId . '');
                if ($deleteAca) {
                    for ($i = 0; $i < count($this->input->post('college')); $i++) {
                        //$academicResult[] = $this->db->query("INSERT INTO academics (`college`, `course`, `rank`, `passing_year`, `achievement`, `user_id`, `created_at`) VALUES ('".$_POST['college'][$i]."', '".$_POST['course'][$i]."', '".$_POST['rank'][$i]."', '".$_POST['passing_year'][$i]."', '".$_POST['achievement'][$i]."', '".$userId."', '".date('Y-m-d H:i:s')."')");

                        $academicResult[] = $this->db->query("INSERT INTO academics (`college`, `course`, `rank`, `graduation_year`, `gpa`, `act_score`, `user_id`, `created_at`) VALUES ('" . $_POST['college'][$i] . "', '" . $_POST['course'][$i] . "', '" . $_POST['rank'][$i] . "', '" . $_POST['graduation_year'][$i] . "', '" . $_POST['gpa'][$i] . "', '" . $_POST['act_score'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                    }
                }

                // $academicResult = $this->Adminmodel->update($academicsInfo, 'academics', array('id' => $userId));
                //$academicResult = $this->Adminmodel->update_user_data('id, user_id', 'academics', array('user_id' => $userId), $academicsInfo);
                if (!empty($academicResult)) {
                    $athleticsInfo = array(
                        'feet' => strip_tags($this->input->post('feet')),
                        'inches' => strip_tags($this->input->post('inches')),
                        'weight' => strip_tags($this->input->post('weight')),
                        'Footed' => strip_tags($this->input->post('footed')),
                        'strength' => strip_tags($this->input->post('strength')),
                        'school_team' => strip_tags($this->input->post('school_team')),
                        'club_team' => strip_tags($this->input->post('club_team')),
                        'position' => strip_tags($this->input->post('position')),
                        'user_id' => strip_tags($userId),
                    );
                    $athleticsResult = $this->Adminmodel->update_user_data('id, user_id', 'athletics', array('user_id' => $userId), $athleticsInfo);
                    if (!empty($athleticsResult)) {
                        // $exprienceInfo = array(
                        // 'club_name' => strip_tags($this->input->post('club_name')),
                        // 'designation' => strip_tags($this->input->post('club_designation')),
                        // 'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
                        // 'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
                        // 'information' => strip_tags($this->input->post('information')),
                        // 'user_id' => strip_tags($userId),
                        // );
                        $deleteExp = $this->db->query('delete from exprience where user_id = ' . $userId . '');
                        if ($deleteExp) {
                            for ($i = 0; $i < count($this->input->post('club_name')); $i++) {
                                if (!empty($_POST['start_date'][$i])) {
                                    $start_date = date('Y-m-d', strtotime($_POST['start_date'][$i]));
                                } else {
                                    $start_date = NULL;
                                }

                                if (!empty($_POST['end_date'][$i])) {
                                    $end_date = date('Y-m-d', strtotime($_POST['end_date'][$i]));
                                } else {
                                    $end_date = NULL;
                                }
                                $exprienceResult[] = $this->db->query("INSERT INTO exprience (`club_name`, `designation`, `start_date`, `end_date`, `information`, `user_id`, `created_at`) VALUES ('" . $_POST['club_name'][$i] . "', '" . $_POST['club_designation'][$i] . "', '" . $start_date . "', '" . $end_date . "', '" . $_POST['information'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                            }
                        }


                        //$exprienceResult = $this->Adminmodel->update_user_data('id, user_id', 'exprience', array('user_id' => $userId), $exprienceInfo);
                        if (!empty($exprienceResult)) {
                            // $referenceInfo = array(
                            // 'coach_name' => strip_tags($this->input->post('coach_name')),
                            // 'coach_email' => strip_tags($this->input->post('coach_email')),
                            // 'user_id' => strip_tags($userId),
                            // );

                            $deleteRef = $this->db->query('delete from reference where user_id = ' . $userId . '');
                            if ($deleteRef) {
                                for ($i = 0; $i < count($this->input->post('coach_name')); $i++) {
                                    $referenceResult[] = $this->db->query("INSERT INTO reference (`coach_name`, `coach_email`, `user_id`, `created_at`) VALUES ('" . $_POST['coach_name'][$i] . "', '" . $_POST['coach_email'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                                }
                            }
                            //$referenceResult = $this->Adminmodel->update_user_data('id, user_id', 'reference', array('user_id' => $userId), $referenceInfo);
                            //print_r($referenceResult);die;
                            // if(!empty($referenceResult)){
                            // $response['status'] = 1;
                            // $response['message'] = 'Profile updated successfully.';
                            // }else{
                            // $response['status'] = 0;
                            // $response['message'] = 'Some error ocure.Please try again.';
                            // }
                            if (!empty($referenceResult)) {
                                $deleteGuar = $this->db->query('delete from guardian where user_id = ' . $userId . '');
                                if ($deleteGuar) {
                                    for ($i = 0; $i < count($this->input->post('guardian_name')); $i++) {
                                        $guardianResult[] = $this->db->query("INSERT INTO guardian (`guardian_name`, `guardian_email`, `guardian_phone`, `guardian_relation`, `user_id`, `created_at`) VALUES ('" . $_POST['guardian_name'][$i] . "', '" . $_POST['guardian_email'][$i] . "',  '" . $_POST['guardian_phone'][$i] . "', '" . $_POST['guardian_relation'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                                    }
                                }

                                if (!empty($referenceResult)) {
                                    $response['status'] = 1;
                                    $response['message'] = 'Profile updated successfully.';
                                } else {
                                    $response['status'] = 0;
                                    $response['message'] = 'Some error ocure.Please try again.';
                                }
                            }
                        }
                    }
                }
            }
        }
        echo json_encode($response);
    }

    function add_teamplayer($id) {
        $data = array(
            'title' => 'Team Players',
            'page' => 'Team Players',
            'subpage' => 'team-coach',
                //'redirect' => 'lists'
        );
        $data['userid'] = $id;
        // // if($vendorId !=null){
        // // $vendor_clause = "WHERE d.is_approved='1' AND d.vendorId = '$vendorId'";
        // // }else{
        // // $vendor_clause = "WHERE d.is_approved='1'";
        // // }
        // // //Fetching orders and their details from db
        // //$fetch_deal_sql = "select first_name, last_name, email, phone, address, status from users where user_type = 'Individual'";
        // //$data['userlist'] = $this->mymodel->get_all_record($fetch_deal_sql,false);


        $data['userInfo'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $data['sportslist'] = $this->Adminmodel->get_all_record('*', 'sports', '', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/add_coach_player');
        $this->load->view('admin/footer');
    }

    function getuser_bysport() {
        if ($this->input->post('sport_id')) {
            $sportId = $this->input->post('sport_id');
            echo $this->Adminmodel->getuser_bysport($sportId);
        }
    }

    function getrganiser_bysport() {
        if ($this->input->post('sport_id')) {
            $sportId = $this->input->post('sport_id');
            echo $this->Adminmodel->getrganiser_bysport($sportId);
        }
    }

    function addTeamplayer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$this->form_validation->set_rules('user_id', 'user', 'required|callback_check_teamplayer');
            $result = $this->check_teamplayer($this->input->post('user_id'), $this->input->post('coach_id'));

            if ($result == 'err_false') {
                $response['status'] = $result;
                $response['message'] = 'This player already exist in your team.';
                echo json_encode($response);
                return false;
            }

            $data = array(
                'coach_id' => strip_tags($this->input->post('coach_id')),
                'player_id' => strip_tags($this->input->post('user_id')),
                'sport_id' => strip_tags($this->input->post('sport_id')),
                'created_at' => date('Y-m-d H:i:s')
            );
            $result = $this->Adminmodel->add('coach_team', $data);
            if ($result) {
                $response['status'] = 1;
                $response['message'] = 'Team player addedd successfully.';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Some error ocure.Please try again.';
            }
        }
        echo json_encode($response);
    }

    public function check_teamplayer($user_id = '', $coach_id = '') {
        $result = '';
        $con = array(
            'returnType' => 'count',
            'conditions' => array(
                'user_id' => $user_id,
                'coach_id' => $coach_id,
            )
        );
        $checkEmail = $this->Adminmodel->UniqueTeamPlayer($con);
        if ($checkEmail->num_rows() > 0) {
            $result .= 'err_false';
        } else {
            $result .= 'err_true';
        }
        return $result;
    }

    public function addnewTeamplayer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            if ($this->form_validation->run() == true) {
                // if(!empty($_FILES['profile_image']['name'])){
                // $config['upload_path'] = 'uploads/profile_image'; # check path is correct
                // $config['allowed_types'] = 'jpg|png|jpeg'; # add video extenstion on here
                // $config['overwrite'] = FALSE;
                // $config['remove_spaces'] = TRUE;
                // $image_name = preg_replace("/\s+/", "_", $_FILES['profile_image']['name']);
                // $config['file_name'] = $image_name;
                // $this->load->library('upload', $config);
                // $this->upload->initialize($config);
                // if (!$this->upload->do_upload('profile_image')) {
                // $array = array('error' => true, 'profile_image_error' => $this->upload->display_errors());
                // echo json_encode($array);
                // exit();
                // } else {
                // $url = $image_name;
                // $data = array(
                // 'first_name' => strip_tags($this->input->post('fname')),
                // 'last_name' => strip_tags($this->input->post('lname')),
                // 'email' => strip_tags($this->input->post('email')),
                // 'phone' => strip_tags($this->input->post('phone')),
                // 'profile_image' => $url,
                // 'address' => strip_tags($this->input->post('address')),
                // 'latitude' => strip_tags($this->input->post('latitude')),
                // 'longitude' => strip_tags($this->input->post('longitude')),
                // 'password' => md5($this->input->post('longitude')),
                // 'sport_id' => $this->input->post('sport_id'),
                // 'status' => strip_tags($this->input->post('status')),
                // 'user_type' => 'Individual',
                // 'created_at'   => date('Y-m-d H:i:s')
                // );
                // $result= $this->Adminmodel->add('users', $data);
                // if($result){
                // if(strip_tags($this->input->post('coach_id'))){
                // $data = array(
                // 'coach_id' => strip_tags($this->input->post('coach_id')),
                // 'player_id' => $result,
                // 'sport_id' => strip_tags($this->input->post('sport_id')),
                // 'created_at'   => date('Y-m-d H:i:s')
                // );
                // $this->Adminmodel->add('coach_team', $data);
                // }
                // $response['status'] = 1;
                // $response['message'] = 'Individual players addedd successfully.';
                // }else{
                // $response['status'] = 0;
                // $response['message'] = 'Some error ocure.Please try again.';
                // }
                // }
                // }else{
                $data = array(
                    'first_name' => strip_tags($this->input->post('fname')),
                    'last_name' => strip_tags($this->input->post('lname')),
                    'email' => strip_tags($this->input->post('email')),
                    'phone' => strip_tags($this->input->post('phone')),
                    'profile_image' => strip_tags($this->input->post('profileImg')),
                    'address' => strip_tags($this->input->post('address')),
                    'latitude' => strip_tags($this->input->post('latitude')),
                    'longitude' => strip_tags($this->input->post('longitude')),
                    'password' => md5($this->input->post('longitude')),
                    'sport_id' => $this->input->post('sport_id'),
                    'status' => strip_tags($this->input->post('status')),
                    'user_type' => 'Individual',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->add('users', $data);
                if ($result) {
                    if (strip_tags($this->input->post('coach_id'))) {
                        $data = array(
                            'coach_id' => strip_tags($this->input->post('coach_id')),
                            'player_id' => $result,
                            'sport_id' => strip_tags($this->input->post('sport_id')),
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->Adminmodel->add('coach_team', $data);
                    }
                    if (!empty($this->input->post('coverImg'))) {
                        $CoverImgdata = array('cover_image' => $this->input->post('coverImg'));
                        $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $result));
                    }
                    $response['status'] = 1;
                    $response['message'] = 'Individual players addedd successfully.';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Some error ocure.Please try again.';
                }
                //}
            } else {
                $response = array(
                    'vali_error' => 1,
                    'pass_error' => form_error('password'),
                    'cnfpass_error' => form_error('confirm_password'),
                    'email_error' => form_error('email'),
                );
            }
        }
        echo json_encode($response);
    }

    function addnew_teamplayer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('unique_code', 'Unique Code', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            if ($this->form_validation->run() == true) {
                $coachId = strip_tags($this->input->post('coach_id'));
                // $data = array(
                // 'email' => strip_tags($this->input->post('email')),
                // 'unique_playercode' => strip_tags($this->input->post('unique_code')),
                // 'created_at'   => date('Y-m-d H:i:s')
                // );
                $countUnique_playerCode = $this->db->query("select id from playerunique_code where coach_id = " . @$coachId . "")->num_rows();
                if ($countUnique_playerCode == 21) {
                    $response['count21'] = 4;
                    $response['message'] = 'You can not invite player more than 21.';
                    echo json_encode($response);
                    exit();
                }

                require_once APPPATH . 'third_party/email/vendor/autoload.php';
                $imagePath = base_url() . 'uploads/logos/logo1.png';
                $imagebackPath = '';
                $message = "<!Doctype html>
				<html>
					<head>
					<meta charset='utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<title>Unique Player Code</title>
					<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap' rel='stylesheet'>
					<body>
					<div style='max-width:600px;
					margin:auto;
					border:1px solid #eee;
					box-shadow:0 0 10px rgba(0, 0, 0, .15);
					line-height:17px;
					font-size:13px;
					box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(" . $imagebackPath . ")'>
					<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
					<a href='#'><img src='" . $imagePath . "' style='width: 350px; height80px;'></a>
					</div>
					<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
					<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear User</h1>
					<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your Unique Player Code is: " . strip_tags($this->input->post('unique_code')) . "</p>
					<!--<p>Do not share your Code with anyone!</p>-->
					</div>
					<div style='background: #000;
					text-align: left;
					box-sizing: border-box;
					width: 100%;
					padding: 20px 50px;
					color: #fff;'>
					<p style='margin: 5px 0;font-size: 12px;'>Warm Regards,</p>
					<p style='margin: 5px 0;font-size: 12px;'>Digital Sport Resume Team</p>
					<p style='margin: 5px 0;font-size: 12px;'><strong>Email:</strong> <a href='#' style='color: #78daff;'>contact@digitalsport.com</a></p>
					<br/>
					<p style='margin: 5px 0;font-size: 11px;'>This is an automated response, please do not reply.</p>
					</div>
					</div>
					</body>
				</html>";
                $mail = new PHPMailer(true);
                //try {
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('contact@digitalsport.com', 'Digital Sport Resume');
                $mail->AddAddress(strip_tags($this->input->post('email')));
                $mail->IsHTML(true);
                $mail->Subject = 'Unique Player Code';
                $mail->Body = $message;
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->Username = 'rameshwebdev21@gmail.com';
                $mail->Password = 'gqbtiijrzaljwkhz';
                $send = $mail->send();
                if ($send == 1) {
                    $data = array(
                        'email' => strip_tags($this->input->post('email')),
                        'unique_playercode' => strip_tags($this->input->post('unique_code')),
                        'coach_id' => strip_tags($this->input->post('coach_id')),
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->Adminmodel->update_user_data('id', 'playerunique_code', array('email' => strip_tags($this->input->post('email'))), $data);
                    if ($result) {
                        $response['status'] = 1;
                        $response['message'] = 'Your unique player code is successfully send to this player.';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Some error ocure.Please try again.';
                    }
                }

                // } catch (Exception $e)
                // {
                // $this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                // }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'unique_error' => form_error('unique_code'),
                    'email_error' => form_error('email'),
                );
            }
        }
        echo json_encode($response);
    }

    public function coach_team($id) {
        $data = array(
            'title' => 'Player List',
            'page' => 'Coach Team',
            'subpage' => 'team-coach',
                //'redirect' => 'lists'
        );

        // $data['coachteamlist'] = $this->Adminmodel->get_all_record('*', 'coach_team', array('coach_id' => $id), array('id', 'DESC'), '');
        $data['coachteamlist'] = $this->Adminmodel->get_all_record('*', 'playerunique_code', array('coach_id' => $id), array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/players_under_coach');
        $this->load->view('admin/footer');
    }

    function resendCode() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $result = $this->Adminmodel->get_all_record('*', 'playerunique_code', array('id' => $id), array('id', 'DESC'), '');
            if ($result) {
                require_once APPPATH . 'third_party/email/vendor/autoload.php';
                $imagePath = base_url() . 'uploads/logos/logo1.png';
                $imagebackPath = '';
                $message = "<!Doctype html>
				<html>
				<head>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<title>Unique Player Code</title>
				<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap' rel='stylesheet'>
				<body>
					<div style='max-width:600px;margin:auto;border:1px solid #eee;box-shadow:0 0 10px rgba(0, 0, 0, .15);line-height:17px;font-size:13px;
					box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(" . $imagebackPath . ")'>
						<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
							<a href='#'><img src='" . $imagePath . "' style='width: 350px; height80px;'></a>
						</div>
						<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
							<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear User</h1>
							<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your Unique Player Code is: " . @$result[0]->unique_playercode . "</p>
							<!--<p>Do not share your Code with anyone!</p>-->
						</div>
						<div style='background: #000;text-align: left;box-sizing: border-box;width: 100%;padding: 20px 50px;color: #fff;'>
							<p style='margin: 5px 0;font-size: 12px;'>Warm Regards,</p>
							<p style='margin: 5px 0;font-size: 12px;'>Digital Sport Resume Team</p>
							<p style='margin: 5px 0;font-size: 12px;'><strong>Email:</strong> <a href='#' style='color: #78daff;'>contact@digitalsport.com</a></p>
							<br/>
							<p style='margin: 5px 0;font-size: 11px;'>This is an automated response, please do not reply.</p>
						</div>
					</div>
				</body>
				</html>";
                $mail = new PHPMailer(true);
                //try {
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('contact@digitalsport.com', 'Digital Sport Resume');
                $mail->AddAddress(@$result[0]->email);
                $mail->IsHTML(true);
                $mail->Subject = 'Unique Player Code';
                $mail->Body = $message;
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->Username = 'rameshwebdev21@gmail.com';
                $mail->Password = 'gqbtiijrzaljwkhz';
                $send = $mail->send();
                if ($send) {
                    $response['status'] = 1;
                    $response['message'] = 'Your unique player code is successfully send to this player.';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Some error ocure.Please try again.';
                }
            }
        }
        echo json_encode($response);
    }

    function deletePlayer($id) {
        if (empty($id)) {
            return false;
        }
        //die;
        $result = $this->db->query('delete from coach_team where id = ' . $id . '');
        if ($result) {
            $msg = '["Player deleted from team successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/coach-team/' . $_GET['coachId'] . ''), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/coach-team/' . $_GET['coachId'] . ''), 'refresh');
        }
    }

    function deleteUser_academicInfo() {
        $academic = $this->input->post('academic');
        $userId = $this->input->post('userId');
        $result = $this->db->query('delete from academics where id = ' . $academic . ' AND user_id = ' . $userId . '');
        if ($result) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function deleteUser_expInfo() {
        $experience = $this->input->post('experience');
        $userId = $this->input->post('userId');
        $result = $this->db->query('delete from exprience where id = ' . $experience . ' AND user_id = ' . $userId . '');
        if ($result) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function deleteUser_refInfo() {
        $reference = $this->input->post('reference');
        $userId = $this->input->post('userId');
        $result = $this->db->query('delete from reference where id = ' . $reference . ' AND user_id = ' . $userId . '');
        if ($result) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function deleteUser_guarInfo() {
        $reference = $this->input->post('reference');
        $userId = $this->input->post('userId');
        $result = $this->db->query('delete from guardian where id = ' . $reference . ' AND user_id = ' . $userId . '');
        if ($result) {
            echo '1';
        } else {
            echo '0';
        }
    }

    function getSport_byId() {
        $sportId = $this->input->post('sportId');
        $result = $this->db->query("select * from sports where id = " . $sportId . "")->row();
        if ($result) {
            echo $result->sports_name;
        }
    }

    function getUser_byId() {
        $sportId = $this->input->post('sportId');
        $result = $this->db->query("select * from users where id = " . $sportId . "")->row();
        if ($result) {
            echo $result->first_name . $result->last_name;
        }
    }

    function cropImage() {
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';
        $image_name = 'uploads/profile/' . $imageName;
        file_put_contents($image_name, $data);
        echo $imageName;
    }

    function crop_CoverImage() {
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';
        $image_name = 'uploads/cover_image/' . $imageName;
        file_put_contents($image_name, $data);
        echo $imageName;
    }

    function cropTeamimage() {
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';
        $image_name = 'uploads/team_image/' . $imageName;
        file_put_contents($image_name, $data);
        echo $imageName;
    }

    function qrcode() {
        //$this->load->library('phpqrcode/qrlib.php');
        require_once APPPATH . 'third_party/phpqrcode/qrlib.php';
        $SERVERFILEPATH = FCPATH . "data/qrcode/";
        $userId = (!empty($_POST['userId']) ? $_POST['userId'] : '');
        $content = base_url('player-profile/' . $userId . '');
        $text = "0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ";
        //$text1= rand($text, 0,9);
        $text1 = substr(str_shuffle($text), 0, 9);
        $folder = $SERVERFILEPATH;
        $file_name1 = $text1 . "-Qrcode" . rand(2, 200) . ".png";
        $file_name = $folder . $file_name1;
        $ecc = 'H';
        $pixel_size = 20;
        $frame_size = 5;
        QRcode::png($content, $file_name, $ecc, $pixel_size, $frame_size);
        //echo"<center><img src=".base_url().'data/qrcode/'.$file_name1."></center>";
        $url = base_url() . 'data/qrcode/' . $file_name1;
        $data = array('qrcode' => $url);
        $result = $this->Adminmodel->update($data, 'users', array('id' => $userId));
        if ($result) {
            echo '1';
        }
        // require_once APPPATH.'third_party/phpqrcode/qrlib.php';
        // //$file = "http://localhost/digitalsp/uploads/qr1.png";
        // $file = base_url("uploads/qr1.png");
        // // $item = 'TR75hs';
        // // //other parameters
        // // $ecc = 'H';
        // // $pixel_size = 20;
        // // $frame_size = 5;
        // // // Generates QR Code and Save as PNG
        // // QRcode::png($item, $file, $ecc, $pixel_size, $frame_size);
        // echo "<img src='http://localhost/digitalsp/uploads/qr1.png'>";
    }

    // function updateProfile(){
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // $userId = $this->input->post('userId');
    // $fname = $this->input->post('fname');
    // $lname = $this->input->post('lname');
    // $pro_designation = $this->input->post('pro_designation');
    // $email = $this->input->post('email');
    // $phone = $this->input->post('phone');
    // $address = $this->input->post('address');
    // $country = $this->input->post('country');
    // $state = $this->input->post('state');
    // $city = $this->input->post('city');
    // $bio = $this->input->post('profile_bio');
    // $area_interest = $this->input->post('area_interest');
    // $latitude = $this->input->post('latitude');
    // $longitude = $this->input->post('longitude');
    // $pincode = $this->input->post('pincode');
    // $sport = $this->input->post('sport');
    // $query = $this->db->query("select * from users where id = ".$userId."");
    // if($query->num_rows() > 0){
    // $row = $query->row();
    // $userInfodata = array(
    // 'first_name' => !empty($fname) ? $fname : $row->first_name,
    // 'last_name' => !empty($lname) ? $lname : $row->last_name,
    // 'designation' => !empty($pro_designation) ? $pro_designation : $row->designation,
    // 'email' => !empty($email) ? $email : $row->email,
    // 'phone' => !empty($phone) ? $phone : $row->phone,
    // 'address' => !empty($address) ? $address : $row->address,
    // 'latitude' => !empty($latitude) ? $latitude : $row->latitude,
    // 'longitude' => !empty($longitude) ? $longitude : $row->longitude,
    // 'country' => !empty($country) ? $country : $row->country,
    // 'city' => !empty($city) ? $city : $row->city,
    // 'state' => !empty($state) ? $state : $row->state,
    // 'bio' => !empty($bio) ? $bio : $row->bio,
    // 'area_interest' => !empty($area_interest) ? $area_interest : $row->area_interest,
    // 'pincode' => !empty($pincode) ? $pincode : $row->pincode,
    // 'sport_id' => !empty($sport) ? $sport : $row->sport_id,
    // 'profile_status' => '1',
    // 'updated_at' => date('Y-m-d H:i:s')
    // );
    // $result= $this->Adminmodel->update($userInfodata, 'users', array('id' => $userId));
    // if(!empty($this->input->post('college'))){
    // $deleteAca = $this->db->query('delete from academics where user_id = '.$userId.'');
    // if($deleteAca){
    // for($i = 0; $i< count($this->input->post('college')); $i++){
    // $academicResult = $this->db->query("INSERT INTO academics (`college`, `course`, `rank`, `graduation_year`, `gpa`, `act_score`, `user_id`, `created_at`) VALUES ('".$_POST['college'][$i]."', '".$_POST['course'][$i]."', '".$_POST['rank'][$i]."', '".$_POST['graduation_year'][$i]."', '".$_POST['gpa'][$i]."', '".$_POST['act_score'][$i]."', '".$userId."', '".date('Y-m-d H:i:s')."')");
    // }
    // }
    // }
    // $query = $this->db->query("select * from athletics where user_id = ".$userId."")->row();
    // $athleticsInfo = array(
    // 'feet' => !empty($this->input->post('feet')) ? $this->input->post('feet') : @$query->feet,
    // 'inches' => !empty($this->input->post('inches')) ? $this->input->post('inches') : @$query->inches,
    // 'weight' => !empty($this->input->post('weight')) ? $this->input->post('weight') : @$query->weight,
    // 'Footed' => !empty($this->input->post('footed')) ? $this->input->post('footed') : @$query->Footed,
    // 'strength' => !empty($this->input->post('strength')) ? $this->input->post('strength') : @$query->strength,
    // 'school_team' => !empty($this->input->post('school_team')) ? $this->input->post('school_team') : @$query->school_team,
    // 'club_team' => !empty($this->input->post('club_team')) ? $this->input->post('club_team') : @$query->club_team,
    // 'position' => !empty($this->input->post('position')) ? $this->input->post('position') : @$query->position,
    // 'user_id' => $userId,
    // );
    // $athleticsResult = $this->Adminmodel->update_user_data('id, user_id', 'athletics', array('user_id' => $userId), $athleticsInfo);
    // if(!empty($this->input->post('club_name'))){
    // $deleteExp = $this->db->query('delete from exprience where user_id = '.$userId.'');
    // if($deleteExp){
    // for($i = 0; $i< count($this->input->post('club_name')); $i++){
    // if(!empty($_POST['start_date'][$i])){
    // $start_date = date('Y-m-d', strtotime($_POST['start_date'][$i]));
    // }else{
    // $start_date = NULL;
    // }
    // if(!empty($_POST['end_date'][$i])){
    // $end_date = date('Y-m-d', strtotime($_POST['end_date'][$i]));
    // }else{
    // $end_date = NULL;
    // }
    // $exprienceResult = $this->db->query("INSERT INTO exprience (`club_name`, `designation`, `start_date`, `end_date`, `information`, `user_id`, `created_at`) VALUES ('".$_POST['club_name'][$i]."', '".$_POST['club_designation'][$i]."', '".$start_date."', '".$end_date."', '".$_POST['information'][$i]."', '".$userId."', '".date('Y-m-d H:i:s')."')");
    // }
    // }
    // }
    // if(!empty($this->input->post('coach_name'))){
    // $deleteRef = $this->db->query('delete from reference where user_id = '.$userId.'');
    // if($deleteRef){
    // for($i = 0; $i< count($this->input->post('coach_name')); $i++){
    // $referenceResult = $this->db->query("INSERT INTO reference (`coach_name`, `coach_email`, `user_id`, `created_at`) VALUES ('".$_POST['coach_name'][$i]."', '".$_POST['coach_email'][$i]."', '".$userId."', '".date('Y-m-d H:i:s')."')");
    // }
    // }
    // }
    // if(!empty($this->input->post('user_type')) AND $this->input->post('user_type') == 'Player'){
    // if(!empty($this->input->post('guardian_name'))){
    // $deleteGuar = $this->db->query('delete from guardian where user_id = '.$userId.'');
    // if($deleteGuar){
    // for($i = 0; $i< count($this->input->post('guardian_name')); $i++){
    // $guardianResult[] = $this->db->query("INSERT INTO guardian (`guardian_name`, `guardian_email`, `guardian_phone`, `guardian_relation`, `user_id`, `created_at`) VALUES ('".$_POST['guardian_name'][$i]."', '".$_POST['guardian_email'][$i]."',  '".$_POST['guardian_phone'][$i]."', '".$_POST['guardian_relation'][$i]."', '".$userId."', '".date('Y-m-d H:i:s')."')");
    // }
    // }
    // }
    // }
    // $response['status'] = 1;
    // $response['message'] = 'Profile updated successfully.';
    // }
    // }
    // echo json_encode($response);
    // }

    function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userId = $this->input->post('userId');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $pro_designation = $this->input->post('pro_designation');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $bio = $this->input->post('profile_bio');
            $area_interest = $this->input->post('area_interest');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $pincode = $this->input->post('pincode');
            $sport = $this->input->post('sport');
            $query = $this->db->query("select * from users where id = " . $userId . "");
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $userInfodata = array(
                    'first_name' => !empty($fname) ? $fname : $row->first_name,
                    'last_name' => !empty($lname) ? $lname : $row->last_name,
                    'designation' => !empty($pro_designation) ? $pro_designation : $row->designation,
                    'email' => !empty($email) ? $email : $row->email,
                    'phone' => !empty($phone) ? $phone : $row->phone,
                    'address' => !empty($address) ? $address : $row->address,
                    'latitude' => !empty($latitude) ? $latitude : $row->latitude,
                    'longitude' => !empty($longitude) ? $longitude : $row->longitude,
                    'country' => !empty($country) ? $country : $row->country,
                    'city' => !empty($city) ? $city : $row->city,
                    'state' => !empty($state) ? $state : $row->state,
                    'bio' => !empty($bio) ? $bio : $row->bio,
                    'area_interest' => !empty($area_interest) ? $area_interest : $row->area_interest,
                    'pincode' => !empty($pincode) ? $pincode : $row->pincode,
                    'sport_id' => !empty($sport) ? $sport : $row->sport_id,
                    'profile_status' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->update($userInfodata, 'users', array('id' => $userId));
                if (!empty($this->input->post('cover_image'))) {
                    $CoverImgdata = array('cover_image' => $this->input->post('cover_image'));
                    $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                }
                if (!empty($this->input->post('profileImg'))) {
                    $CoverImgdata = array('profile_image' => $this->input->post('profileImg'));
                    $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                }
                if (!empty($this->input->post('college'))) {
                    $deleteAca = $this->db->query('delete from academics where user_id = ' . $userId . '');
                    if ($deleteAca) {
                        for ($i = 0; $i < count($this->input->post('college')); $i++) {
                            $academicResult = $this->db->query("INSERT INTO academics (`college`, `course`, `rank`, `graduation_year`, `gpa`, `act_score`, `user_id`, `created_at`) VALUES ('" . $_POST['college'][$i] . "', '" . $_POST['course'][$i] . "', '" . $_POST['rank'][$i] . "', '" . $_POST['graduation_year'][$i] . "', '" . $_POST['gpa'][$i] . "', '" . $_POST['act_score'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                        }
                    }
                }

                $query = $this->db->query("select * from athletics where user_id = " . $userId . "")->row();
                $athleticsInfo = array(
                    'feet' => !empty($this->input->post('feet')) ? trim($this->input->post('feet'), "'") : @$query->feet,
                    'inches' => !empty($this->input->post('inches')) ? trim($this->input->post('inches'), '"') : @$query->inches,
                    'weight' => !empty($this->input->post('weight')) ? $this->input->post('weight') : @$query->weight,
                    'Footed' => !empty($this->input->post('footed')) ? $this->input->post('footed') : @$query->Footed,
                    'strength' => !empty($this->input->post('strength')) ? $this->input->post('strength') : @$query->strength,
                    'school_team' => !empty($this->input->post('school_team')) ? $this->input->post('school_team') : @$query->school_team,
                    'club_team' => !empty($this->input->post('club_team')) ? $this->input->post('club_team') : @$query->club_team,
                    'position' => !empty($this->input->post('position')) ? $this->input->post('position') : @$query->position,
                    'team_type' => !empty($this->input->post('team_type')) ? $this->input->post('team_type') : @$query->team_type,
                    'user_id' => $userId,
                );
                $athleticsResult = $this->Adminmodel->update_user_data('id, user_id', 'athletics', array('user_id' => $userId), $athleticsInfo);
                if (!empty($this->input->post('club_name'))) {
                    $deleteExp = $this->db->query('delete from exprience where user_id = ' . $userId . '');
                    if ($deleteExp) {
                        for ($i = 0; $i < count($this->input->post('club_name')); $i++) {
                            if (!empty($_POST['start_date'][$i])) {
                                $start_date = date('Y-m-d', strtotime($_POST['start_date'][$i]));
                            } else {
                                $start_date = NULL;
                            }

                            if (!empty($_POST['end_date'][$i])) {
                                $end_date = date('Y-m-d', strtotime($_POST['end_date'][$i]));
                            } else {
                                $end_date = NULL;
                            }
                            $exprienceResult = $this->db->query("INSERT INTO exprience (`club_name`, `designation`, `start_date`, `end_date`, `information`, `user_id`, `created_at`) VALUES ('" . $_POST['club_name'][$i] . "', '" . $_POST['club_designation'][$i] . "', '" . $start_date . "', '" . $end_date . "', '" . $_POST['information'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                        }
                    }
                }

                if (!empty($this->input->post('coach_name'))) {
                    $deleteRef = $this->db->query('delete from reference where user_id = ' . $userId . '');
                    if ($deleteRef) {
                        for ($i = 0; $i < count($this->input->post('coach_name')); $i++) {
                            $referenceResult = $this->db->query("INSERT INTO reference (`coach_name`, `coach_email`, `user_id`, `created_at`) VALUES ('" . $_POST['coach_name'][$i] . "', '" . $_POST['coach_email'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                        }
                    }
                }
                if (!empty($this->input->post('user_type')) AND $this->input->post('user_type') == 'Player') {
                    if (!empty($this->input->post('guardian_name'))) {
                        $deleteGuar = $this->db->query('delete from guardian where user_id = ' . $userId . '');
                        if ($deleteGuar) {
                            for ($i = 0; $i < count($this->input->post('guardian_name')); $i++) {
                                $guardianResult[] = $this->db->query("INSERT INTO guardian (`guardian_name`, `guardian_email`, `guardian_phone`, `guardian_relation`, `user_id`, `created_at`) VALUES ('" . $_POST['guardian_name'][$i] . "', '" . $_POST['guardian_email'][$i] . "',  '" . $_POST['guardian_phone'][$i] . "', '" . $_POST['guardian_relation'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                            }
                        }
                    }
                }


                $response['status'] = 1;
                $response['message'] = 'Profile updated successfully.';
            }
        }
        echo json_encode($response);
    }

    function updateProfileCoach() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userId = $this->input->post('userId');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');

            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $bio = $this->input->post('profile_bio');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $pincode = $this->input->post('pincode');
            $sport = $this->input->post('sport');
            $team_name = $this->input->post('team_name');
            $team_description = $this->input->post('team_desc');
            $query = $this->db->query("select * from users where id = " . $userId . "");
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $userInfodata = array(
                    'first_name' => !empty($fname) ? $fname : $row->first_name,
                    'last_name' => !empty($lname) ? $lname : $row->last_name,
                    'email' => !empty($email) ? $email : $row->email,
                    'phone' => !empty($phone) ? $phone : $row->phone,
                    'address' => !empty($address) ? $address : $row->address,
                    'latitude' => !empty($latitude) ? $latitude : $row->latitude,
                    'longitude' => !empty($longitude) ? $longitude : $row->longitude,
                    'country' => !empty($country) ? $country : $row->country,
                    'city' => !empty($city) ? $city : $row->city,
                    'state' => !empty($state) ? $state : $row->state,
                    'bio' => !empty($bio) ? $bio : $row->bio,
                    'pincode' => !empty($pincode) ? $pincode : $row->pincode,
                    'sport_id' => !empty($sport) ? $sport : $row->sport_id,
                    'team_name' => !empty($team_name) ? $team_name : $row->team_name,
                    'team_description' => !empty($team_description) ? $team_description : $row->team_description,
                    'profile_status' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->update($userInfodata, 'users', array('id' => $userId));

                if (!empty($this->input->post('cover_image'))) {
                    $CoverImgdata = array('cover_image' => $this->input->post('cover_image'));
                    $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                }

                if (!empty($this->input->post('profileImg'))) {
                    $CoverImgdata = array('profile_image' => $this->input->post('profileImg'));
                    $this->Adminmodel->update($CoverImgdata, 'users', array('id' => $userId));
                }

                if (!empty($this->input->post('teamImg'))) {
                    $teamImgdata = array('team_image' => $this->input->post('teamImg'));
                    $this->Adminmodel->update($teamImgdata, 'users', array('id' => $userId));
                }

                if (!empty($this->input->post('teamcoverImg'))) {
                    $teamcoverImgdata = array('teamcover_image' => $this->input->post('teamcoverImg'));
                    $this->Adminmodel->update($teamcoverImgdata, 'users', array('id' => $userId));
                }

                if (!empty($this->input->post('college'))) {
                    $deleteAca = $this->db->query('delete from academics where user_id = ' . $userId . '');
                    if ($deleteAca) {
                        for ($i = 0; $i < count($this->input->post('college')); $i++) {
                            $academicResult = $this->db->query("INSERT INTO academics (`college`, `user_id`, `created_at`) VALUES ('" . $_POST['college'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                        }
                    }
                }

                $query = $this->db->query("select * from athletics where user_id = " . $userId . "")->row();
                $athleticsInfo = array(
                    // 'feet' => !empty($this->input->post('feet')) ? trim($this->input->post('feet'), "'") : @$query->feet,
                    // 'inches' => !empty($this->input->post('inches')) ? trim($this->input->post('inches'), '"') : @$query->inches,
                    // 'weight' => !empty($this->input->post('weight')) ? $this->input->post('weight') : @$query->weight,
                    // 'Footed' => !empty($this->input->post('footed')) ? $this->input->post('footed') : @$query->Footed,
                    // 'strength' => !empty($this->input->post('strength')) ? $this->input->post('strength') : @$query->strength,
                    // 'school_team' => !empty($this->input->post('school_team')) ? $this->input->post('school_team') : @$query->school_team,
                    // 'club_team' => !empty($this->input->post('club_team')) ? $this->input->post('club_team') : @$query->club_team,
                    // 'position' => !empty($this->input->post('position')) ? $this->input->post('position') : @$query->position,
                    'team_type' => !empty($this->input->post('team_type')) ? $this->input->post('team_type') : @$query->team_type,
                    'user_id' => $userId,
                );
                $athleticsResult = $this->Adminmodel->update_user_data('id, user_id', 'athletics', array('user_id' => $userId), $athleticsInfo);
                if (!empty($this->input->post('club_name'))) {
                    $deleteExp = $this->db->query('delete from exprience where user_id = ' . $userId . '');
                    if ($deleteExp) {
                        for ($i = 0; $i < count($this->input->post('club_name')); $i++) {
                            // if(!empty($_POST['start_date'][$i])){
                            // $start_date = date('Y-m-d', strtotime($_POST['start_date'][$i]));
                            // }else{
                            // $start_date = NULL;
                            // }
                            // if(!empty($_POST['end_date'][$i])){
                            // $end_date = date('Y-m-d', strtotime($_POST['end_date'][$i]));
                            // }else{
                            // $end_date = NULL;
                            // }
                            $exprienceResult = $this->db->query("INSERT INTO exprience (`club_name`, `information`, `user_id`, `created_at`) VALUES ('" . $_POST['club_name'][$i] . "',  '" . $_POST['information'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                        }
                    }
                }

                if (!empty($this->input->post('coach_name'))) {
                    $deleteRef = $this->db->query('delete from reference where user_id = ' . $userId . '');
                    if ($deleteRef) {
                        for ($i = 0; $i < count($this->input->post('coach_name')); $i++) {
                            $referenceResult = $this->db->query("INSERT INTO reference (`coach_name`, `coach_email`, `user_id`, `created_at`) VALUES ('" . $_POST['coach_name'][$i] . "', '" . $_POST['coach_email'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                        }
                    }
                }
                if (!empty($this->input->post('user_type')) AND $this->input->post('user_type') == 'Player') {
                    if (!empty($this->input->post('guardian_name'))) {
                        $deleteGuar = $this->db->query('delete from guardian where user_id = ' . $userId . '');
                        if ($deleteGuar) {
                            for ($i = 0; $i < count($this->input->post('guardian_name')); $i++) {
                                $guardianResult[] = $this->db->query("INSERT INTO guardian (`guardian_name`, `guardian_email`, `guardian_phone`, `guardian_relation`, `user_id`, `created_at`) VALUES ('" . $_POST['guardian_name'][$i] . "', '" . $_POST['guardian_email'][$i] . "',  '" . $_POST['guardian_phone'][$i] . "', '" . $_POST['guardian_relation'][$i] . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')");
                            }
                        }
                    }
                }


                $response['status'] = 1;
                $response['message'] = 'Profile updated successfully.';
            }
        }
        echo json_encode($response);
    }

    function update_email_status() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $emailstatus = $this->input->post('status');
            $user_id = $this->input->post('user_id');
            if ($emailstatus == 0) {
                $status = 0;
                $msg = 'not verified';
            } else {
                $status = 1;
                $msg = 'verified';
            }
            $update_sql = $this->db->query('update users set email_verify_status = "' . $emailstatus . '", status = "' . $status . '" where id = ' . @$user_id . '');
            //echo $this->db->last_query();
            if (!empty($update_sql)) {
                $response['status'] = 1;
                $response['message'] = 'Your email status is ' . @$msg . ' successfully.';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Some error occure.Please try again.';
            }
        }
        echo json_encode($response);
    }

    function update_subscription() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $this->input->post('user_id');
            $sub_id = $this->input->post('sub_id');

            $update_user_sub = $this->db->query("update users set sub_id = '" . @$sub_id . "' where id = " . @$user_id . "");
            if (!empty($update_user_sub)) {
                $get_sub = $this->db->query("select * from subscription where id = " . @$sub_id . "")->row();
                $get_user = $this->db->query("select id, fname, lname, email, address, country, state, city, zipcode from users where id = " . @$user_id . "")->row();

                $checksub_beforeexpire = $this->Adminmodel->checksubBefore_expied(@$user_id);

                if (!empty($checksub_beforeexpire)) {
                    $date_1 = date_create(date('Y-m-d'));
                    $date_2 = date_create($checksub_beforeexpire->end_date);
                    $diff = date_diff($date_1, $date_2);
                    $sub_remaining_days = $diff->format("%a");
                    $end_date = $this->get_expire_date(@$get_sub->duration, $sub_remaining_days);
                    //print_r($end_date);die;

                    $extractDuration = explode('-', $get_sub->duration);
                    $totalInvitation = $extractDuration[0] * $get_sub->invitation_limit;

                    $previousInvi = $this->Adminmodel->get_single_row_info('total_invitation', 'users', 'id = ' . @$user_id . ' and status = "1"', '', 1);
                    if (!empty($previousInvi->total_invitation)) {
                        $preIn = $previousInvi->total_invitation;
                    } else {
                        $preIn = 0;
                    }
                    $allTotalIn = $totalInvitation + $preIn;
                    $update_query = $this->db->query("update users set total_invitation = '" . $allTotalIn . "', invitation_limit = '" . $get_sub->invitation_limit . "' where id = " . @$user_id . "");
                } else {
                    $end_date = $this->end_date(@$get_sub->duration);

                    $extractDuration = explode('-', $get_sub->duration);
                    $totalInvitation = $extractDuration[0] * $get_sub->invitation_limit;

                    $update_query = $this->db->query("update users set total_invitation = '" . $totalInvitation . "', invitation_limit = '" . $get_sub->invitation_limit . "' where id = " . @$user_id . "");
                }

                $cardholder = @$get_user->fname . ' ' . @$get_user->lname;
                $amount = @$get_sub->amount;
                $sub_id = @$sub_id;
                $user_id = @$user_id;
                $email = @$get_user->email;
                $country = @$get_user->country;
                $state = @$get_user->state;
                $city = @$get_user->city;
                $zipcode = @$get_user->zipcode;
                $address = @$get_user->address;
                $currency = "USD";
                $orderID = "TEST_" . $this->generate_otp(6);

                // $tran_data = array(
                // 'user_name' => $cardholder, 'user_id' => $user_id, 'sub_id' => $sub_id, 'order_id' => $orderID, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'zipcode' => $zipcode, 'amount' => $amount, 'payment_type' => '1', 'start_date' => date('Y-m-d H:i:s'), 'end_date' => $end_date, 'paid_by_admin' => '2', 'status' => 'succeeded', 'currency' => 'usd', 'created_at' => date('Y-m-d H:i:s')
                // );

                $tran_data = array(
                    'user_name' => $cardholder, 'user_id' => $user_id, 'sub_id' => $sub_id, 'order_id' => $orderID, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'zipcode' => $zipcode, 'amount' => $amount, 'payment_type' => '1', 'start_date' => date('Y-m-d H:i:s'), 'end_date' => $end_date, 'paid_by_admin' => '2', 'status' => 'succeeded', 'currency' => 'usd', 'created_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->add('transaction', $tran_data);
                if (!empty($result)) {
                    $response['status'] = 1;
                    $response['message'] = 'you have added subscription successfully for this user.';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'some error occure.please try again.';
                }
            }
        }
        echo json_encode($response);
    }

    function get_expire_date($duration = '', $remainingDays = '') {
        $return = '';

        if ($duration == '1-Month') {
            $subDays = 30 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Month') {
            $subDays = 60 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '3-Month') {
            $subDays = 90 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '4-Month') {
            $subDays = 120 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '5-Month') {
            $subDays = 150 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '6-Month') {
            $subDays = 180 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '7-Month') {
            $subDays = 210 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '8-Month') {
            $subDays = 240 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '9-Month') {
            $subDays = 270 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '10-Month') {
            $subDays = 300 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '11-Month') {
            $subDays = 330 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '12-Month') {
            $subDays = 360 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '1-Year') {
            $subDays = 360 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Year') {
            $subDays = 720 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        }
        return $endDate;
    }

    function end_date($duration = '') {

        if ($duration == '1-Month') {
            $days = '30 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Month') {
            $days = '60 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '3-Month') {
            $days = '90 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '4-Month') {
            $days = '120 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '5-Month') {
            $days = '150 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '6-Month') {
            $days = '180 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '7-Month') {
            $days = '210 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '8-Month') {
            $days = '240 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '9-Month') {
            $days = '270 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '10-Month') {
            $days = '300 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '11-Month') {
            $days = '330 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '12-Month') {
            $days = '360 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '1-Year') {
            $days = '360 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Year') {
            $days = '720 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        }
        return $endDate;
    }

    public function generate_otp($length) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function update_event_payment() {
        //print_r($_POST);die;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $event_id = $this->input->post('event_id');
            $user_id = $this->input->post('user_id');
            $transaction = $this->input->post('transaction');
            $id = $this->input->post('id');

            $get_user_count = $this->db->query("select id from users where id = " . @$user_id . "")->num_rows();
            if ($get_user_count > 0) {
                $update_event_pay = $this->db->query("update event_invited_people set transaction = '" . @$transaction . "' where id = " . @$id . " and event_id = " . @$event_id . "");
                if ($transaction == 'Paid') {
                    if (!empty(@$update_event_pay)) {

                        $get_user = $this->db->query("select id, fname, lname, email, address, country, state, city, zipcode from users where id = " . @$user_id . "")->row();
                        $get_invited_people = $this->db->query("select distributed_event_price from event_invited_people where id = " . @$id . " and event_id = " . @$event_id . " ")->row();

                        $cardholder = @$get_user->fname . ' ' . @$get_user->lname;
                        $amount = @$get_invited_people->distributed_event_price;
                        $user_id = @$user_id;
                        $email = @$get_user->email;
                        $country = @$get_user->country;
                        $state = @$get_user->state;
                        $city = @$get_user->city;
                        $zipcode = @$get_user->zipcode;
                        $address = @$get_user->address;
                        $currency = "USD";
                        $orderID = "TEST_" . $this->generate_otp(6);

                        $tran_data = array(
                            'user_name' => $cardholder, 'user_id' => $user_id, 'order_id' => $orderID, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'zipcode' => $zipcode, 'amount' => $amount, 'payment_type' => '2', 'status' => 'succeeded', 'currency' => 'usd', 'event_id' => $event_id, 'paid_by_admin' => '2', 'created_at' => date('Y-m-d H:i:s')
                        );
                        $result = $this->Adminmodel->add('transaction', $tran_data);
                        if (!empty($result)) {
                            $response['status'] = 1;
                            $response['message'] = 'you have added event payment successfully for this user.';
                        } else {
                            $response['status'] = 0;
                            $response['message'] = 'some error occure.please try again.';
                        }
                    }
                } else {
                    if (!empty(@$update_event_pay)) {
                        $delete_tran = $this->db->query("delete from transaction where user_id = " . @$user_id . " and event_id = " . @$event_id . " and payment_type = '2' and paid_by_admin = '2'");

                        if (!empty($delete_tran)) {
                            $response['status'] = 1;
                            $response['message'] = 'transaction deleted successfully.';
                        } else {
                            $response['status'] = 0;
                            $response['message'] = 'some error occure.please try again.';
                        }
                    }
                }
            } else {
                $response['status'] = 0;
                $response['message'] = 'user not register yet.';
            }
        }
        echo json_encode($response);
    }

    function health_etity() {
        $output = '<option value="">Select Clinic</option>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $health_etity = $this->input->post('health_etity');
            $etity = $this->db->query("select * from clinic_admin where health_entity = " . @$health_etity . " AND status = '1'")->result();
            if ($etity) {
                foreach ($etity as $k => $v) {
                    $output .= '<option value="' . @$v->id . '">' . @$v->name . '</option>';
                }
            }
        }
        echo $output;
    }

    function get_clinic() {
        $output = '<option value="">Select Provide</option>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clinic = $this->input->post('clinic');
            $etity = $this->db->query("select * from provider where clinic_admin = " . @$clinic . "")->result();
            if ($etity) {
                foreach ($etity as $k => $v) {
                    $output .= '<option value="' . @$v->id . '">' . @$v->name . '</option>';
                }
            }
        }
        echo $output;
    }

    public function coach_admin() {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'Coach Admin List',
            'subpage' => 'coach-admin',
        );

        $data['userlist'] = $this->Adminmodel->get_all_record('*', 'coach_admin', '', array('id', 'DESC'), '');

        //$data['user_subscription'] = $this->Adminmodel->get_all_record('id, name', 'subscription', array('status' => '1'), array('name', 'ASC'), '');

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/coach_admin');
        $this->load->view('admin/footer');
    }

    public function addCoachadmin() {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'Add Coach Admin',
            'subpage' => 'coach-admin',
        );

        $user_id = 23;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_FILES['upload_image']['name'])) {
                $config['upload_path'] = 'uploads/clinic'; # check path is correct
                $config['allowed_types'] = 'jpg|png|jpeg|gif|mov|mp4|3gp|ogg|ogv|webm'; # add video extenstion on here
                $config['overwrite'] = FALSE;
                $config['remove_spaces'] = TRUE;
                $image_name = preg_replace("/\s+/", "_", $_FILES['upload_image']['name']);
                $config['file_name'] = $image_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('upload_image')) {
                    $array = array('error' => true, 'upload_image' => $this->upload->display_errors());
                    echo json_encode($array);
                    exit();
                } else {
                    $url = $image_name;
                    $data = array(
                        'first_name' => @$this->input->post('fname'),
                        'last_name' => @$this->input->post('lname'),
                        'email' => @$this->input->post('email'),
                        'phone' => @$this->input->post('phone'),
                        'address' => @$this->input->post('address'),
                        'city' => @$this->input->post('city'),
                        'country' => @$this->input->post('country'),
                        'zipcode' => @$this->input->post('zipcode'),
                        'clinic' => @$this->input->post('clinic'),
                        'certificates' => @$this->input->post('certificate'),
                        'languages' => @$this->input->post('language'),
                        'max_client' => @$this->input->post('max_client'),
                        'file' => @$image_name,
                        'user_id' => @$user_id,
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->Adminmodel->add('coach_admin', $data);
                    if ($result) {
                        //redirect(base_url('admin/users/coach_admin'));
                        // $response['status'] = 1;
                        // $response['message'] = 'Coach admin added successfully.';

                        $msg = '["Coach admin added successfully.", "success", "#A5DC86"]';
                        $this->session->set_flashdata('msg', $msg);
                        redirect(base_url('admin/users/coach_admin'), 'refresh');
                    } else {
                        // $response['status'] = 0;
                        // $response['message'] = 'Some error ocure.Please try again.';
                        //redirect(base_url('admin/users/coach_admin'));

                        $msg = 'Some error ocure.Please try again.';
                        $this->session->set_flashdata('msg', $msg);
                        redirect(base_url('admin/users/coach_admin'), 'refresh');
                    }
                }
            } else {

                $data = array(
                    'first_name' => @$this->input->post('fname'),
                    'last_name' => @$this->input->post('lname'),
                    'email' => @$this->input->post('email'),
                    'phone' => @$this->input->post('phone'),
                    'address' => @$this->input->post('address'),
                    'city' => @$this->input->post('city'),
                    'country' => @$this->input->post('country'),
                    'zipcode' => @$this->input->post('zipcode'),
                    'clinic' => @$this->input->post('clinic'),
                    'certificates' => @$this->input->post('certificate'),
                    'languages' => @$this->input->post('language'),
                    'max_client' => @$this->input->post('max_client'),
                    'user_id' => @$user_id,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->add('coach_admin', $data);
                if ($result) {
                    // $response['status'] = 1;
                    // $response['message'] = 'Coach admin added successfully.';
                    //redirect(base_url('admin/users/coach_admin'));

                    $msg = '["Coach admin added successfully.", "success", "#A5DC86"]';
                    $this->session->set_flashdata('msg', $msg);
                    redirect(base_url('admin/users/coach_admin'), 'refresh');
                } else {
                    // $response['status'] = 0;
                    // $response['message'] = 'Some error ocure.Please try again.';
                    //redirect(base_url('admin/users/coach_admin'));

                    $msg = 'Some error ocure.Please try again.';
                    $this->session->set_flashdata('msg', $msg);
                    redirect(base_url('admin/users/coach_admin'), 'refresh');
                }
            }
        }

        $data['clinic'] = $this->Adminmodel->get_all_record('*', 'clinic', array('status' => '1'), array('name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/add_coach_admin');
        $this->load->view('admin/footer');
    }

    public function editCoachadmin($id) {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'Edit Coach Admin',
            'subpage' => 'coach-admin',
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_FILES['upload_image']['name'])) {
                $config['upload_path'] = 'uploads/clinic'; # check path is correct
                $config['allowed_types'] = 'jpg|png|jpeg|gif|mov|mp4|3gp|ogg|ogv|webm'; # add video extenstion on here
                $config['overwrite'] = FALSE;
                $config['remove_spaces'] = TRUE;
                $image_name = preg_replace("/\s+/", "_", $_FILES['upload_image']['name']);
                $config['file_name'] = $image_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('upload_image')) {
                    $array = array('error' => true, 'upload_image' => $this->upload->display_errors());
                    echo json_encode($array);
                    exit();
                } else {
                    $url = $image_name;
                    $data1 = array(
                        'first_name' => @$this->input->post('fname'),
                        'last_name' => @$this->input->post('lname'),
                        'email' => @$this->input->post('email'),
                        'phone' => @$this->input->post('phone'),
                        'address' => @$this->input->post('address'),
                        'city' => @$this->input->post('city'),
                        'country' => @$this->input->post('country'),
                        'zipcode' => @$this->input->post('zipcode'),
                        'clinic' => @$this->input->post('clinic'),
                        'certificates' => @$this->input->post('certificate'),
                        'languages' => @$this->input->post('language'),
                        'max_client' => @$this->input->post('max_client'),
                        'file' => @$image_name,
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->Adminmodel->update($data1, 'coach_admin', array('id' => @$this->input->post('id')));
                    if ($result) {
                        $msg = '["Coach admin updated successfully.", "success", "#A5DC86"]';
                        $this->session->set_flashdata('msg', $msg);
                        redirect(base_url('admin/users/coach_admin'), 'refresh');
                    } else {
                        $msg = 'Some error ocure.Please try again.';
                        $this->session->set_flashdata('msg', $msg);
                        redirect(base_url('admin/users/coach_admin'), 'refresh');
                    }
                }
            } else {

                $data1 = array(
                    'first_name' => @$this->input->post('fname'),
                    'last_name' => @$this->input->post('lname'),
                    'email' => @$this->input->post('email'),
                    'phone' => @$this->input->post('phone'),
                    'address' => @$this->input->post('address'),
                    'city' => @$this->input->post('city'),
                    'country' => @$this->input->post('country'),
                    'zipcode' => @$this->input->post('zipcode'),
                    'clinic' => @$this->input->post('clinic'),
                    'certificates' => @$this->input->post('certificate'),
                    'languages' => @$this->input->post('language'),
                    'max_client' => @$this->input->post('max_client'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->update($data1, 'coach_admin', array('id' => @$this->input->post('id')));
                if ($result) {
                    $msg = '["Coach admin updated successfully.", "success", "#A5DC86"]';
                    $this->session->set_flashdata('msg', $msg);
                    redirect(base_url('admin/users/coach_admin'), 'refresh');
                } else {
                    $msg = 'Some error ocure.Please try again.';
                    $this->session->set_flashdata('msg', $msg);
                    redirect(base_url('admin/users/coach_admin'), 'refresh');
                }
            }
        }
        $data['result'] = $this->Adminmodel->get_by('coach_admin', 'single', array('id' => $id), '', 1);

        $data['clinic'] = $this->Adminmodel->get_all_record('*', 'clinic', array('status' => '1'), array('name', 'ASC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/edit_coach_admin');
        $this->load->view('admin/footer');
    }

    public function viewCoachadmin($id) {
        $data = array(
            'title' => 'Pact For Pain',
            'page' => 'View Coach Admin',
            'subpage' => 'coach-admin',
        );
        $data['result'] = $this->Adminmodel->get_by('coach_admin', 'single', array('id' => $id), '', 1);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/view_coach_admin');
        $this->load->view('admin/footer');
    }

    public function changestatus_coach_admin() {
        if ($this->input->post('userId')) {
            $userId = $this->input->post('userId');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Your status is Activate';
            } else {
                $msg = 'Your status is Inctivate';
            }

            if ($this->Adminmodel->update(['status' => $status], 'coach_admin', ['id' => $userId])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }

    function deleteUser_coach_admin($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from coach_admin where id = ' . $id . '');
        if ($result) {
            $msg = '["Coach admin is deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/users/coach_admin'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/users/coach_admin'), 'refresh');
        }
    }
}
