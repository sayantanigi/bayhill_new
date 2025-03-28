<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Mymodel');
    }
    public function index() {
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Home',
            'subpage' => 'home',
        );
        $this->load->view('header', $data);
        $this->load->view('home');
        $this->load->view('footer');
    }
    public function drivers_ed() {
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Driver\'s ED',
            'subpage' => 'driver\'s ED',
        );
        $this->load->view('header', $data);
        $this->load->view('frontend/drivers_ed');
        $this->load->view('footer');
    }
    public function student_form(){
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Student Information',
            'subpage' => 'Student Information',
        );
        $this->load->view('header', $data);
        $this->load->view('frontend/student_registration');
        $this->load->view('footer');
    }
    public function courses(){
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Courses',
            'subpage' => 'Courses',
        );
        $this->load->view('header', $data);
        $this->load->view('frontend/courses');
        $this->load->view('footer');
    }
    public function booking_slot(){
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Booking Slot',
            'subpage' => 'Booking Slot',
        );
        $this->load->view('header', $data);
        $this->load->view('frontend/booking_slot');
        $this->load->view('footer');
    }
    public function payment_details(){
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Payment Details',
            'subpage' => 'Payment Details',
        );
        $this->load->view('header', $data);
        $this->load->view('frontend/payment_details');
        $this->load->view('footer');
    }
    public function faq() {
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'FAQ',
            'subpage' => 'faq',
        );
        $data['faq_list'] = $this->db->query("SELECT * FROM faq WHERE status = '1'")->result();
        $this->load->view('header', $data);
        $this->load->view('frontend/faq');
        $this->load->view('footer');
    }
    public function contact_us() {
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'Contact',
            'subpage' => 'contact',
        );
        $this->load->view('header', $data);
        $this->load->view('frontend/contact_us');
        $this->load->view('footer');
    }
    public function contact_store() {
        if(!empty($_POST)) {
            $data=array(
                'firstname' =>$_POST['first_name'],
                'lastname' => $_POST['last_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'message' => $_POST['message'],
                'created_at' => date('Y-m-d H:i:s'),
            );
            $result = $this->Mymodel->add('contact',$data);
            $insert_id = $this->db->insert_id();
            
            $get_setting = $this->db->query("SELECT * FROM settings WHERE settingId = '1'")->row();
            if(!empty($get_setting->smtp_host)) {
                if(!empty($insert_id)) {
                    $data=array(
                        'activationURL' => base_url() . "email-verification/" . urlencode(base64_encode($insert_id)),
                        'imagePath' => base_url().'uploads/logo/'.$get_setting->logo,
                    );
                    $message = "<body>
                        <div style='width:600px;margin: 0 auto;background: #fff; border: 1px solid #e6e6e6;'>
                            <div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'>
                                <img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'>
                                <h3 style='padding-top:40px; line-height: 30px;'>Greetings from <span style='font-weight: 900;font-size: 35px, color: #2892ff; display: block;'>$get_setting->title</span></h3><p style='font-size: 15px;'>Hello Admin,</p>
                                <p style='font-size: 15px;'>Please find the below contact form details.</p>
                                <p style='font-size: 15px; padding: 0; margin: 0;'>First Name : ".$_POST['firstname']."</p>
                                <p style='font-size: 15px; padding: 0; margin: 0;'>Last Name : ".$_POST['lastname']."</p>
                                <p style='font-size: 15px; padding: 0; margin: 0;'>Email : ".$_POST['email']."</p>
                                <p style='font-size: 15px; padding: 0; margin: 0;'>Phone : ".$_POST['phone']."</p>
                                <p style='font-size: 15px; padding: 0; margin: 0;'>Message: ".$_POST['message']."</p>
                                <p style='font-size: 15px; padding: 0; margin: 18px 0 0 0;'>Thank you!</p>
                                <p style='font-size:20px;list-style: none;'>Sincerly</p>
                                <p style='list-style: none;'><b>$get_setting->title</b></p>
                                <p style='list-style:none;'><b>Visit us:</b> <span>$get_setting->address</span></p>
                                <p style='list-style:none'><b>Email us:</b> <span>$get_setting->email</span></p>
                            </div>
                            <table style='width: 100%;'>
                                <tr>
                                    <td style='height:30px;width:100%; background: #2892ff;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> $get_setting->title. All rights reserved.</td>
                                </tr>
                            </table>
                        </div>
                    </body>";
                    require 'vendor/autoload.php';
                    $mail = new PHPMailer(true);
                    try {
                        $mail->CharSet = 'UTF-8';
                        $mail->SetFrom($get_setting->email, $get_setting->title);
                        $mail->AddAddress($_POST['email']);
                        $mail->IsHTML(true);
                        $mail->Subject = 'Verify Your Email Address From'. $get_setting->title;
                        $mail->AddEmbeddedImage('uploads/logo/'.$get_setting->logo, $get_setting->title);
                        $mail->Body = $message;
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Host = $get_setting->smtp_host;
                        $mail->Port = $get_setting->smtp_port; //587 465
                        $mail->Username = $get_setting->smtp_email;
                        $mail->Password = $get_setting->smtp_pass;
                        if(!$mail->send()) {
                            $data = array('result' => 'success', 'data' => "Thank you for your message. Our team will contact you soon!");
                        } else {
                            $data = array('result' => 'success', 'data' => "Your message could not be sent. Please, try again later.");
                        }
                    } catch (Exception $e) {
                        $data = array('result' => 'success', 'data' => "Something went wrong. Please try again later!");
                    }
                }
            } else {
                $data = array('result' => 'success', 'data' => "Thank you for your message. Our team will contact you soon!");
            }
        }
        echo json_encode($data); exit;
    }
}