<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//frontend
$route['course_zipcode'] = 'home/course_zipcode';
$route['drivers-ed'] = 'home/drivers_ed';
$route['getcourselistbyzipcode'] = 'home/getcourselistbyzipcode';
$route['courses'] = 'home/courses';
$route['course/course_details'] = 'home/course_details';
$route['registration'] = 'home/registration';
$route['registration_process'] = 'home/registration_process';
$route['booking_slot'] = 'home/booking_slot';
$route['create-booking'] = 'home/create_booking';
$route['confirm-booking'] = 'home/confirm_booking';
$route['payment-details'] = 'home/payment_details';
$route['create-payment'] = 'home/create_payment';
$route['complete-payment'] = 'home/complete_payment';
$route['instructor_list'] = 'home/instructor_list';
$route['instructor-details'] = 'home/instructor_details';
$route['instructor-slot'] = 'home/instructor_slot';
$route['student_form'] = 'home/student_form';
$route['faq'] = 'home/faq';
$route['terms'] = 'home/terms';
$route['contact'] = 'home/contact_us';
$route['contact_store'] = 'home/contact_store';
$route['login'] = 'home/login';
$route['login_process'] = 'home/login_process';
$route['dashboard'] = 'users/dashboard';
$route['logout'] = 'users/dashboard/logout';

//admin
$route['admin'] = 'admin/login';
$route['userLogin'] = 'user/login';
$route['admin/userfull_link'] = 'admin/dashboard/userfull_link';
$route['admin/trainer'] = 'admin/trainer';
$route['admin/booking'] = 'admin/course/booking_list';
