<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota extends CI_Controller
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
        $this->load->model('Anggota_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Anggota';
        $data['content']        ='anggota/anggota_list';
        $data['anggota']        = $this->Anggota_model->get_anggota();
        $this->load->view('dashboard', $data);
    }

    public function get_jurusan(){
        $id_kelas = $this->input->post('id_kelas');
        $jurusan = $this->Anggota_model->by_jurusan($id_kelas);
        $data .= '</<option value="">--Pilih Jurusan--</option>';
        foreach ($jurusan as $rows) {
            $data .= "<option value='$rows[id_kelas]'>$rows[jurusan]</option>\n";
        }
            echo $data;
        }

    public function read($id)
    {
        $row = $this->Anggota_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_anggota' => $row->kode_anggota,
		'NISP' => $row->NISP,
		'id_kelas' => $row->id_kelas,
		'nama_anggota' => $row->nama_anggota,
        'foto' => $row->foto,
		'jenis_kelamin' => $row->jenis_kelamin,
		'tempat_lahir' => $row->tempat_lahir,
		'tgl_lahir' => $row->tgl_lahir,
		'telepon' => $row->telepon,
		'alamat' => $row->alamat,
	    );
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Detail Anggota';
            $data['content']        ='anggota/anggota_read';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('panelib/anggota'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => base_url('panelib/anggota/create_action'),
      	    'kode_anggota' => set_value('kode_anggota'),
      	    'NISP' => set_value('NISP'),
      	    'id_kelas' => set_value('id_kelas'),
      	    'nama_anggota' => set_value('nama_anggota'),
            'foto' => set_value('foto'),
      	    'jenis_kelamin' => set_value('jenis_kelamin'),
      	    'tempat_lahir' => set_value('tempat_lahir'),
      	    'tgl_lahir' => set_value('tgl_lahir'),
      	    'telepon' => set_value('telepon'),
      	    'alamat' => set_value('alamat'),
	);
        $data['kelas']          = $this->Anggota_model->get_kelas();
        $data['aktif']          ='Master';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Master';
        $data['sub_judul']      ='Add Anggota';
        $data['content']        ='anggota/anggota_form';
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // setting konfigurasi upload
        $config['upload_path']   = './assets/anggota/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']      = 500000;
        // load library upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('foto');

        $result = $this->upload->data();
               //Compress Image
                $config['image_library']    ='gd2';
                $config['source_image']     ='./assets/anggota/'.$result['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = FALSE;
                $config['width']            = 270;
                $config['height']           = 320;
                $config['new_image']        = './assets/anggota/'.$result['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $foto = $result['file_name'];
                //print_r($foto);
                $foto           = $foto;
                $NISP           = $this->input->post('NISP',TRUE);
                $id_kelas       = $this->input->post('id_kelas',TRUE);
                $nama_anggota   = $this->input->post('nama_anggota',TRUE);
                $jenis_kelamin  = $this->input->post('jenis_kelamin',TRUE);
                $tempat_lahir   = $this->input->post('tempat_lahir',TRUE);
                $tgl_lahir      = $this->input->post('tgl_lahir',TRUE);
                $telepon        = $this->input->post('telepon',TRUE);
                $alamat         = $this->input->post('alamat',TRUE);

        $data = array(
    		'NISP' => $NISP,
    		'id_kelas' => $id_kelas,
            'kode_anggota' => $this->Anggota_model->buat_kode(),
    		'nama_anggota' => $nama_anggota,
            'foto' => $foto,
    		'jenis_kelamin' => $jenis_kelamin,
    		'tempat_lahir' => $tempat_lahir,
    		'tgl_lahir' => $tgl_lahir,
    		'telepon' => $telepon,
    		'alamat' => $alamat);

            $cek = $this->Anggota_model->cek_nisp($data['NISP']);
            if ($cek) {
                $this->session->set_flashdata('message', 'No Induk Siswa Sudah Ada');
                redirect(site_url('panelib/anggota/create'));
            } else {
                $this->Anggota_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('panelib/anggota'));
            }
        }

    }

    public function update($id)
    {
        $row = $this->Anggota_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('panelib/anggota/update_action'),
		'kode_anggota' => set_value('kode_anggota', $row->kode_anggota),
		'NISP' => set_value('NISP', $row->NISP),
		'id_kelas' => set_value('id_kelas', $row->id_kelas),
		'nama_anggota' => set_value('nama_anggota', $row->nama_anggota),
        'foto' => set_value('foto', $row->foto),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
		'telepon' => set_value('telepon', $row->telepon),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $data['aktif']          ='Master';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Master';
            $data['sub_judul']      ='Edit Anggota';
            $data['content']        ='anggota/anggota_form';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('panelib/anggota'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_anggota', TRUE));
        } else {
        // setting konfigurasi upload
        $config['upload_path']   = './assets/anggota/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']      = 500000;
        // load library upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('foto');

        $result = $this->upload->data();
               //Compress Image
                $config['image_library']    ='gd2';
                $config['source_image']     ='./assets/anggota/'.$result['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = FALSE;
                $config['width']            = 270;
                $config['height']           = 320;
                $config['new_image']        = './assets/anggota/'.$result['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $foto = $result['file_name'];

        if ($foto != '') {
                $foto           = $foto;
                $NISP           = $this->input->post('NISP',TRUE);
                $id_kelas       = $this->input->post('id_kelas',TRUE);
                $nama_anggota   = $this->input->post('nama_anggota',TRUE);
                $jenis_kelamin  = $this->input->post('jenis_kelamin',TRUE);
                $tempat_lahir   = $this->input->post('tempat_lahir',TRUE);
                $tgl_lahir      = $this->input->post('tgl_lahir',TRUE);
                $telepon        = $this->input->post('telepon',TRUE);
                $alamat         = $this->input->post('alamat',TRUE);
                $kode_anggota   = $this->input->post('kode_anggota',TRUE);

             $query = $this->db->query("SELECT * FROM anggota WHERE kode_anggota= '{$kode_anggota}'");
                foreach ($query->result() as $key) {
                unlink('./assets/anggota/'.$key->foto);
              }
                $data = array(
                    'NISP' => $NISP,
                    'id_kelas' => $id_kelas,
                    //'kode_anggota' => $this->Anggota_model->buat_kode(),
                    'nama_anggota' => $nama_anggota,
                    'foto' => $foto,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'telepon' => $telepon,
                    'alamat' => $alamat
                    );
         } elseif ($foto == '') {
                $NISP           = $this->input->post('NISP',TRUE);
                $id_kelas       = $this->input->post('id_kelas',TRUE);
                $nama_anggota   = $this->input->post('nama_anggota',TRUE);
                $jenis_kelamin  = $this->input->post('jenis_kelamin',TRUE);
                $tempat_lahir   = $this->input->post('tempat_lahir',TRUE);
                $tgl_lahir      = $this->input->post('tgl_lahir',TRUE);
                $telepon        = $this->input->post('telepon',TRUE);
                $alamat         = $this->input->post('alamat',TRUE);
                $kode_anggota   = $this->input->post('kode_anggota',TRUE);

                $data = array(
                    'NISP' => $NISP,
                    'id_kelas' => $id_kelas,
                    //'kode_anggota' => $this->Anggota_model->buat_kode(),
                    'nama_anggota' => $nama_anggota,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'telepon' => $telepon,
                    'alamat' => $alamat);
            }
            $this->Anggota_model->update($kode_anggota, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('panelib/anggota'));
        }
    }

    public function delete($id)
    {
        $cek = $this->Anggota_model->cek_status($id);
        if ($cek) {
            $this->session->set_flashdata('msg', 'Status Masih Meminjam Buku');
            redirect(site_url('panelib/anggota'));
        } else {
            $this->Anggota_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('panelib/anggota'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_anggota', 'kode_anggota', 'trim|required');
    $this->form_validation->set_rules('NISP', 'nisp', 'trim|required');
	$this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required');
	$this->form_validation->set_rules('nama_anggota', 'nama anggota', 'trim|required');
    //$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('kode_anggota', 'kode_anggota', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "anggota.xls";
        $judul = "anggota";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NISP");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kelas");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Anggota");
    xlsWriteLabel($tablehead, $kolomhead++, "Foto");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Telepon");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

	foreach ($this->Anggota_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NISP);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kelas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_anggota);
        xlsWriteLabel($tablebody, $kolombody++, $data->gambar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telepon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=anggota.doc");

        $data = array(
            'anggota_data' => $this->Anggota_model->get_all(),
            'start' => 0
        );

        $this->load->view('panelib/anggota/anggota_doc',$data);
    }

}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-02 05:35:00 */
/* http://harviacode.com */
