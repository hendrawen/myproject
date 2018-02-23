<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rak_buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rak_buku_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'rak_buku/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'rak_buku/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'rak_buku/index.html';
            $config['first_url'] = base_url() . 'rak_buku/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Rak_buku_model->total_rows($q);
        $rak_buku = $this->Rak_buku_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rak_buku_data' => $rak_buku,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );  
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Rak Buku';
            $data['content']        ='rak_buku/rak_buku_list';
            $data['rak_buku']       = $this->Rak_buku_model->get_all();
            $this->load->view('dashboard', $data);
    }

    public function read($id) 
    {
        $row = $this->Rak_buku_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_rak' => $row->kode_rak,
		'lokasi' => $row->lokasi,
        'bagian' => $row->bagian,
	    );  
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Rak Buku Detail';
            $data['content']        ='rak_buku/rak_buku_read';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Record Tidak Ditemukan');
            redirect(site_url('panelib/rak_buku'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('panelib/rak_buku/create_action'),
	    'kode_rak' => set_value('kode_rak'),
	    'lokasi' => set_value('lokasi'),
        'bagian' => set_value('bagian'),
	);  
        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Rak Buku Add';
        $data['content']        ='rak_buku/rak_buku_form';
        $this->load->view('dashboard', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'kode_rak' => $this->Rak_buku_model->buat_kode(),
		'lokasi' => $this->input->post('lokasi',TRUE),
        'bagian' => $this->input->post('bagian',TRUE),
        'create_at' => date('Y-m-d H:i:s'),
	    );
            $this->Rak_buku_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
            redirect(site_url('panelib/rak_buku'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Rak_buku_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('panelib/rak_buku/update_action'),
        		'kode_rak' => set_value('kode_rak', $row->kode_rak),
        		'lokasi' => set_value('lokasi', $row->lokasi),
                'bagian' => set_value('bagian', $row->bagian),
	    );  
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Rak Buku Edit';
            $data['content']        ='rak_buku/rak_buku_form';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ditemukan');
            redirect(site_url('panelib/rak_buku'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_rak', TRUE));
        } else {
            $data = array(
		'lokasi' => $this->input->post('lokasi',TRUE),
        'bagian' => $this->input->post('bagian',TRUE),
        'update_at' => date('Y-m-d H:i:s'),
	    );

            $this->Rak_buku_model->update($this->input->post('kode_rak', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Sukses');
            redirect(site_url('panelib/rak_buku'));
        }
    }
    
    public function delete($id) 
    {
        $cek = $this->Rak_buku_model->cek_koderak($id);

        if ($cek) {
            $this->session->set_flashdata('msg', 'Data Buku Masih diRak Ini, Hapus atau Ganti Data Buku Dahulu!!');
            redirect(site_url('panelib/rak_buku'));
        } else {
            $this->Rak_buku_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('panelib/rak_buku'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
    $this->form_validation->set_rules('bagian', 'bagian', 'trim|required');
	$this->form_validation->set_rules('kode_rak', 'kode_rak', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "rak_buku.xls";
        $judul = "rak_buku";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Rak");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
	    xlsWriteLabel($tablehead, $kolomhead++, "Bagian");

	foreach ($this->Rak_buku_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->kode_rak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
        xlsWriteLabel($tablebody, $kolombody++, $data->bagian);
	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=rak_buku.doc");

        $data = array(
            'rak_buku_data' => $this->Rak_buku_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('panelib/rak_buku/rak_buku_doc',$data);
    }

}

/* End of file Rak_buku.php */
/* Location: ./application/controllers/Rak_buku.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-27 03:30:16 */
/* http://harviacode.com */