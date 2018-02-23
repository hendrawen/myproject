<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        /*$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kelas/index.html';
            $config['first_url'] = base_url() . 'kelas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelas_model->total_rows($q);
        $kelas = $this->Kelas_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);*/

        /*$page=$this->input->get('per_page');
        $batas=5; //jlh data yang ditampilkan per halaman
        if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
           $offset = 0;
        else:
           $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
        endif;

        $config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
        $config['base_url'] = base_url().'panelib/kelas/';   //url yang muncul ketika tombol pada paging diklik
        $config['total_rows'] = $this->Kelas_model->count_kelas(); // jlh total barang
        $config['per_page'] = $batas; //batas sesuai dengan variabel batas

        $config['uri_segment'] = $page; //merupakan posisi pagination dalam url pada kesempatan ini saya menggunakan method get untuk menentukan posisi pada url yaitu per_page

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        //$data['paging']=$this->pagination->create_links();
        //$data['jlhpage']=$page;
        //$data['title'] = 'CRUD CodeIgniter Studi Kasus Barang'; //judul title
        $kelas = $this->Kelas_model->get_allkelas($batas,$offset); //query model semua barang

        //$this->load->view('vbarang',$data);

        $data = array(
            'kelas_data' => $kelas,
            /*'q' => $q,*/
                /*'jlhpage' => $page,
                'paging' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],*/
            /*'start' => $start,*/
        //);
        $data['kelas']          = $this->Kelas_model->get_all();
        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Kelas';
        $data['content']        ='kelas/kelas_list';
        $this->load->view('dashboard', $data);
    }

    public function cari(){
        $key= $this->input->get('key'); //method get key
        $page=$this->input->get('per_page');  //method get per_page

        $search=array(
            'id_kelas'=> $key,
            'kelas'=> $key,
            'jurusan'=> $key
        ); //array pencarian yang akan dibawa ke model

        $batas=5; //jlh data yang ditampilkan per halaman
        if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
           $offset = 0;
        else:
           $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
        endif;

        $config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
        $config['base_url'] = base_url().'panelib/kelas/key='.$key;   //url yang muncul ketika tombol pada paging diklik
        $config['total_rows'] = $this->Kelas_model->count_kelas_search($search); // jlh total barang
        $config['per_page'] = $batas; //batas sesuai dengan variabel batas

        $config['uri_segment'] = $page; //merupakan posisi pagination dalam url pada kesempatan ini saya menggunakan method get untuk menentukan posisi pada url yaitu per_page

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);
    
        $kelas = $this->Kelas_model->get_allkelas($batas,$offset,$search); //query model semua barang

        //$this->load->view('vbarang',$data);
        $data = array(
            'kelas_data' => $kelas,
            'jlhpage' => $page,
            'paging' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            //'no' => $no,
        );

        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Kelas';
        $data['content']        ='kelas/kelas_list';
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kelas' => $row->id_kelas,
		'kelas' => $row->kelas,
		'jurusan' => $row->jurusan,
	    );
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Detail Kelas';
            $data['content']        ='kelas/kelas_read';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Record Not Found');
            redirect(site_url('panelib/kelas'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('panelib/kelas/create_action'),
	    'id_kelas' => set_value('id_kelas'),
	    'kelas' => set_value('kelas'),
	    'jurusan' => set_value('jurusan[]'),
	);
        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Add Kelas';
        $data['content']        ='kelas/kelas_form';
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            
            $kelas = $this->input->post('kelas', TRUE);
            $jurusan = implode(' ',$this->input->post('jurusan', TRUE));

            $data = array(
                    'id_kelas' => $this->Kelas_model->buat_kode(),
                    'kelas' => $kelas,
                    'jurusan' => $jurusan
            );

            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('msg', 'Create Record Success');
            redirect(site_url('panelib/kelas'));
        }
    }

    public function update($id)
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('panelib/kelas/update_action'),
          		'id_kelas' => set_value('id_kelas', $row->id_kelas),
          		'kelas' => set_value('kelas', $row->kelas),
          		'jurusan' => set_value('jurusan', explode(' ', $row->jurusan)),
        //'keberapa' => set_value('keberapa', $row->keberapa),
	    );
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Edit Kelas';
            $data['content']        ='kelas/kelas_edit';
            $this->load->view('dashboard', $data);
            //$this->load->view('kelas/kelas_form', $data);
        } else {
            $this->session->set_flashdata('msg', 'Record Not Found');
            redirect(site_url('panelib/kelas'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
		'kelas' => $this->input->post('kelas',TRUE),
		'jurusan' => implode(' ',$this->input->post('jurusan',TRUE)),
	    );

            $this->Kelas_model->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('msg', 'Update Record Success');
            redirect(site_url('panelib/kelas'));
        }
    }

    public function delete($id)
    {
        $cek = $this->Kelas_model->cek_idkelas($id);

        if ($cek) {
            $this->session->set_flashdata('message', 'Status ID Kelas Masih DiGunakan Anggota, Hapus Anggota Terlebih Dahulu');
            redirect(site_url('panelib/kelas'));
        } else {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('msg', 'Delete Record Success');
            redirect(site_url('panelib/kelas'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
	$this->form_validation->set_rules('jurusan[]', 'jurusan', 'trim|required');
    /*$this->form_validation->set_rules('jurusan[]', 'jurusan[]', 'trim|required');*/

	$this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kelas.xls";
        $judul = "kelas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas");
	xlsWriteLabel($tablehead, $kolomhead++, "Jurusan");

	foreach ($this->Kelas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jurusan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kelas.doc");

        $data = array(
            'kelas_data' => $this->Kelas_model->get_all(),
            'start' => 0
        );

        $this->load->view('panelib/kelas/kelas_doc',$data);
    }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-03 14:53:01 */
/* http://harviacode.com */
