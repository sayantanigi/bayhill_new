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
}