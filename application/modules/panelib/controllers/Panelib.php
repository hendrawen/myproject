<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panelib extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
	}

	public function index()
	{	
		$data['aktif']		='Dashboard';
		$data['title']		='Member Panel';
		$data['judul_menu'] ='Dashboard';
		$data['sub_judul']	='';
		//$data['judul_menu']	='My Library';
		$data['content'] 	= 'content';
		$this->load->view('dashboard',$data);
	}
}
