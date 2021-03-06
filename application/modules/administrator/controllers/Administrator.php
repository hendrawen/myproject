<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
	}

	public function index()
	{
		$data['aktif']		='Dashboard';
		$data['title']		='Admin Panel';
		$data['judul_menu'] ='Administrator';
		$data['sub_judul']	='';
		$data['content'] 	= 'content';
		$this->load->view('dashboard',$data);
	}
}
