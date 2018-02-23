<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buku extends CI_Controller
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
        
        $this->load->model('Buku_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        
        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Buku';
        $data['content']        ='buku/buku_list';
        $data['buku']           = $this->Buku_model->get_all();
        $this->load->view('dashboard', $data);
    }

    public function read($id) 
    {
        $row = $this->Buku_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id_buku' => $row->id_buku,
        'kode_buku' => $row->kode_buku,
        'ISBN' => $row->ISBN,
        'judul' => $row->judul,
        'gambar' => $row->gambar,
        'pengarang' => $row->pengarang,
        'penerbit' => $row->penerbit,
        'tahun_terbit' => $row->tahun_terbit,
        'stok' => $row->stok,
        'kode_rak' => $row->kode_rak,
        'created_at' => $row->created_at,
        'updated_at' => $row->updated_at,
        );  
            $data['aktif']      ='Master';
            $data['title']      ='Member Panel';
            $data['judul_menu'] ='Master';
            $data['sub_judul']  ='Detail Buku';
            $data['content']    = 'buku/buku_read';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('pesan', 'Data Tidak Ditemukan');
            redirect(site_url('panelib/buku'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('panelib/buku/create_action'),
        'id_buku' => set_value('id_buku'),
        'kode_buku' => set_value('kode_buku'),
        'ISBN' => set_value('ISBN'),
        'judul' => set_value('judul'),
        'gambar' => set_value('gambar'),
        'pengarang' => set_value('pengarang'),
        'penerbit' => set_value('penerbit'),
        'tahun_terbit' => set_value('tahun_terbit'),
        'stok' => set_value('stok'),
        'created_at' => set_value('created_at'),
        'kode_rak' => set_value('kode_rak'),
    );  
        $data['aktif']      ='Master';
        $data['title']      ='Member Panel';
        $data['judul_menu'] ='Master';
        $data['sub_judul']  ='Add Buku';
        //$data['judul_menu']   ='My Library';
        $data['content']    = 'buku/buku_form';
        $this->load->view('dashboard', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // setting konfigurasi upload
        $config['upload_path']   = './assets/buku/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']      = 500000;
        // load library upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('gambar');
        
        $result = $this->upload->data();
               //Compress Image
                $config['image_library']    ='gd2';
                $config['source_image']     ='./assets/buku/'.$result['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = FALSE;
                $config['width']            = 270;
                $config['height']           = 320;
                $config['new_image']        = './assets/buku/'.$result['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
        $gambar = $result['file_name'];

        if ($gambar != '') {
            $data = array(
                'id_buku' => $this->Buku_model->buat_kode(),
                'kode_buku' => $this->input->post('kode_buku',TRUE),
                'ISBN' => $this->input->post('ISBN',TRUE),
                'gambar' => $gambar,
                'judul' => $this->input->post('judul',TRUE),
                'pengarang' => $this->input->post('pengarang',TRUE),
                'penerbit' => $this->input->post('penerbit',TRUE),
                'tahun_terbit' => $this->input->post('tahun_terbit',TRUE),
                'stok' => $this->input->post('stok',TRUE),
                'kode_rak' => $this->input->post('kode_rak',TRUE),
                'created_at' => date('Y-m-d H:i:s'),            
            );
        } elseif ($gambar == '') {
            $data = array(
                'id_buku' => $this->Buku_model->buat_kode(),
                'kode_buku' => $this->input->post('kode_buku',TRUE),
                'ISBN' => $this->input->post('ISBN',TRUE),
                'judul' => $this->input->post('judul',TRUE),
                'pengarang' => $this->input->post('pengarang',TRUE),
                'penerbit' => $this->input->post('penerbit',TRUE),
                'tahun_terbit' => $this->input->post('tahun_terbit',TRUE),
                'stok' => $this->input->post('stok',TRUE),
                'kode_rak' => $this->input->post('kode_rak',TRUE),
                'created_at' => date('Y-m-d H:i:s'),
            );  
        }
            $this->Buku_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('panelib/buku'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Buku_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('panelib/buku/update_action'),
        'id_buku' => set_value('id_buku', $row->id_buku),
        'kode_buku' => set_value('kode_buku', $row->kode_buku),
        'ISBN' => set_value('ISBN', $row->ISBN),
        'judul' => set_value('judul', $row->judul),
        'gambar' => set_value('judul', $row->gambar),
        'pengarang' => set_value('pengarang', $row->pengarang),
        'penerbit' => set_value('penerbit', $row->penerbit),
        'tahun_terbit' => set_value('tahun_terbit', $row->tahun_terbit),
        'stok' => set_value('stok', $row->stok),
        'kode_rak' => set_value('kode_rak', $row->kode_rak),
        'created_at' => set_value('created_at', $row->created_at),
        'updated_at' => set_value('updated_at', $row->updated_at),
        );
            $data['aktif']      ='Master';
            $data['title']      ='Member Panel';
            $data['judul_menu'] ='Master';
            $data['sub_judul']  ='Edit Buku';
            //$data['judul_menu']   ='My Library';
            $data['content']    = 'buku/buku_form';
            $this->load->view('dashboard', $data);
            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('panelib/buku'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_buku', TRUE));
        } else {
            // setting konfigurasi upload
        $config['upload_path']   = './assets/buku/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']      = 500000;
        // load library upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('gambar');
        
        $result = $this->upload->data();
               //Compress Image
                $config['image_library']    ='gd2';
                $config['source_image']     ='./assets/buku/'.$result['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = FALSE;
                $config['width']            = 270;
                $config['height']           = 320;
                $config['new_image']        = './assets/buku/'.$result['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
        $gambar = $result['file_name'];
        if ($gambar != '') {
                $gambar     = $gambar;
                $kode_buku  = $this->input->post('kode_buku',TRUE);
                $ISBN       = $this->input->post('ISBN',TRUE);
                $judul      = $this->input->post('judul',TRUE);
                $pengarang  = $this->input->post('pengarang',TRUE);
                $penerbit   = $this->input->post('penerbit',TRUE);
                $tahun_terbit   = $this->input->post('tahun_terbit',TRUE);
                $kode_rak  = $this->input->post('kode_rak',TRUE);
                $stok       = $this->input->post('stok',TRUE);
                $id_buku    = $this->input->post('id_buku', TRUE);

            $query = $this->db->query("SELECT * FROM buku WHERE id_buku= '{$id_buku}'");
                foreach ($query->result() as $key) {
                unlink('./assets/buku/'.$key->gambar);
            }
            $data = array(
                'kode_buku' => $kode_buku,
                'ISBN' => $ISBN,
                'judul' => $judul,
                'gambar' => $gambar,
                'pengarang' => $pengarang,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'stok' => $stok,
                'kode_rak' => $kode_rak,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
        } elseif ($gambar == '') {
            $data = array(
                //'id_buku' => $this->Buku_model->buat_kode(),
                'kode_buku' => $this->input->post('kode_buku',TRUE),
                'ISBN' => $this->input->post('ISBN',TRUE),
                'judul' => $this->input->post('judul',TRUE),
                'pengarang' => $this->input->post('pengarang',TRUE),
                'penerbit' => $this->input->post('penerbit',TRUE),
                'tahun_terbit' => $this->input->post('tahun_terbit',TRUE),
                'kode_rak' => $this->input->post('kode_rak',TRUE),
                'stok' => $this->input->post('stok',TRUE),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
        }
            $this->Buku_model->update($this->input->post('id_buku', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('panelib/buku'));
        }
    }
    
    public function delete($id) 
    {
        $cek = $this->Buku_model->cek_status($id);
        if ($cek) {
            $this->session->set_flashdata('msg', 'Buku Masih DiPinjam');
            redirect(site_url('panelib/buku'));
        } else {
            $this->Buku_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('panelib/buku'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('kode_buku', 'kode buku', 'trim|required');
    $this->form_validation->set_rules('ISBN', 'isbn', 'trim|required');
    $this->form_validation->set_rules('judul', 'judul', 'trim|required');
    $this->form_validation->set_rules('pengarang', 'pengarang', 'trim|required');
    $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
    $this->form_validation->set_rules('tahun_terbit', 'tahun terbit', 'trim|required');
    $this->form_validation->set_rules('stok', 'stok', 'trim|required');
    /*$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
    $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');*/

    $this->form_validation->set_rules('id_buku', 'id_buku', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "buku.xls";
        $judul = "buku";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Kode Buku");
    xlsWriteLabel($tablehead, $kolomhead++, "ISBN");
    xlsWriteLabel($tablehead, $kolomhead++, "Judul");
    xlsWriteLabel($tablehead, $kolomhead++, "Pengarang");
    xlsWriteLabel($tablehead, $kolomhead++, "Penerbit");
    xlsWriteLabel($tablehead, $kolomhead++, "Tahun Terbit");
    xlsWriteLabel($tablehead, $kolomhead++, "Stok");
    //xlsWriteLabel($tablehead, $kolomhead++, "Created At");
    //xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

    foreach ($this->Buku_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->kode_buku);
        xlsWriteLabel($tablebody, $kolombody++, $data->ISBN);
        xlsWriteLabel($tablebody, $kolombody++, $data->judul);
        xlsWriteLabel($tablebody, $kolombody++, $data->pengarang);
        xlsWriteLabel($tablebody, $kolombody++, $data->penerbit);
        xlsWriteLabel($tablebody, $kolombody++, $data->tahun_terbit);
        xlsWriteNumber($tablebody, $kolombody++, $data->stok);
        //xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
        //xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);

        $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=buku.doc");

        $data = array(
            'buku_data' => $this->Buku_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('panelib/buku/buku_doc',$data);
    }

}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 05:32:23 */
/* http://harviacode.com */