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
			'page' => 'dashboard',
			'subpage' => ''
		);
        $this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}

}