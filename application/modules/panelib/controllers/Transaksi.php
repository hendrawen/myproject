<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
        $this->load->model('Transaksi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['denda']          = $this->Transaksi_model->get_denda();
        $data['transaksi']      = $this->Transaksi_model->get_transaksi();
        $data['aktif']          ='Transaksi';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Transaksi';
        $data['sub_judul']      ='Peminjaman dan Pengembalian';
        $data['content']        ='transaksi/transaksi_list';
        $this->load->view('dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_buku' => $row->id_buku,
		'kode_anggota' => $row->kode_anggota,
		'tgl_pinjam' => $row->tgl_pinjam,
		'tgl_kembali' => $row->tgl_kembali,
		'status' => $row->status,
	    );
            $data['aktif']          ='Transaksi';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Transaksi';
            $data['sub_judul']      ='Detail Peminjaman dan Pengembalian';
            $data['content']        ='transaksi/transaksi_read';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('panelib/transaksi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('panelib/transaksi/create_action'),
	    'id' => set_value('id'),
	    'id_buku' => set_value('id_buku'),
	    'kode_anggota' => set_value('kode_anggota'),
	    'tgl_pinjam' => set_value('tgl_pinjam'),
	    'tgl_kembali' => set_value('tgl_kembali'),
	    'status' => set_value('status'),
	);
        $data['buku']           = $this->Transaksi_model->get_buku();
        $data['anggota']        = $this->Transaksi_model->get_anggota();
        $data['aktif']          ='Transaksi';
        $data['title']          ='Member Panel';
        $data['judul_menu']     ='Transaksi';
        $data['sub_judul']      ='Add Peminjaman';
        $data['content']        ='transaksi/transaksi_form_ajax';
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

		$id_buku        = $this->input->post('id_buku',TRUE);
		$kode_anggota = $this->input->post('kode_anggota',TRUE);
        $tgl_pinjam = $this->input->post('tgl_pinjam',TRUE);
        $tgl_kembali = $this->input->post('tgl_kembali',TRUE);
        $status = "pinjam";

            $sql = $this->db->query("SELECT * FROM buku WHERE id_buku = '$id_buku'");
                foreach ($sql->result_array() as $key) {
                    $sisa = $key['stok'];
                    if ($sisa == 0) {
                        $this->session->set_flashdata('message', 'Stok Buku Tidak Ada, Mohon Isi Stok Buku Terlebih Dahulu!!!!');
                        redirect(site_url('panelib/transaksi/create'));
                    } elseif($sisa != '' ) {
                        $this->db->query("UPDATE buku set stok= (stok-1) WHERE id_buku= '$id_buku'");

                        $data = array(
                           'id'    => $this->Transaksi_model->buat_kode(),
                           'id_buku' => $id_buku,
                           'kode_anggota' => $kode_anggota,
                           'tgl_pinjam' => $tgl_pinjam,
                           'tgl_kembali' => $tgl_kembali,
                           'status' => $status,
                           'bulan' => date('Y-m-d')
                       );
                       $cek = $this->Transaksi_model->cek_kode_anggota($data['kode_anggota']);
                        if ($cek) {
                            $this->session->set_flashdata('msg','Maaf, Tidak Dapat Meminjam Lebih Dari 2 Buku');
                            redirect(site_url('panelib/transaksi'));
                        } else {
                        $this->Transaksi_model->insert($data);
                        $this->session->set_flashdata('message', 'Create Record Success');
                        redirect(site_url('panelib/transaksi'));
                        }
                    }
                }
        }
    }

    public function kembali($id, $id_buku){
            $lambat = $this->uri->segment(6);
            $denda1 = $this->uri->segment(7);

            $sql = $this->Transaksi_model->get_stok($id, $id_buku);

        if ($sql) {
            $this->db->query("UPDATE transaksi set terlambat= '$lambat', denda= '$denda1' WHERE id= '$id'");
            $this->session->set_flashdata('message', 'Pengembalian Buku Berhasil');
            redirect(site_url('panelib/transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Pengembalian Buku Gagal');
            redirect(site_url('panelib/transaksi'));
        }
    }

    public function perpanjang(){
        $id = $this->uri->segment(4);
        //$buku_id = $this->uri->segment(4);
        $lambat = $this->uri->segment(5);
        $tgl_kembali = $this->uri->segment(6);

        if ($lambat > 0) {
            $this->session->set_flashdata('msg', 'Gagal Perpanjangan Buku, Karena Lebih Dari 7 hari, Harap Kembalikan Buku Terlebih Dahulu!!!');
            redirect(site_url('panelib/transaksi'));
        } else {

            $timestamp = strtotime($tgl_kembali); // 1488236400
            $hari_next = date('Y-m-d', strtotime('+7 day', $timestamp)); // 01-03-2017
            //print_r($hari_next);
            $sql = $this->db->query("UPDATE transaksi set tgl_kembali= '$hari_next' WHERE id= '$id'");

            if ($sql) {
                $this->session->set_flashdata('message', 'Peminjaman Berhasil di Perpanjang!!!');
                redirect(site_url('panelib/transaksi'));
            } else {
                $this->session->set_flashdata('message', 'Peminjaman Gagal di Perpanjang!!!');
                redirect(site_url('panelib/transaksi'));
            }
        }
    }

    /*public function update($id)
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
		'id' => set_value('id', $row->id),
		'id_buku' => set_value('id_buku', $row->id_buku),
		'kode_anggota' => set_value('kode_anggota', $row->kode_anggota),
		'tgl_pinjam' => set_value('tgl_pinjam', $row->tgl_pinjam),
		'tgl_kembali' => set_value('tgl_kembali', $row->tgl_kembali),
		'status' => set_value('status', $row->status),
	    );
            $data['aktif']          ='Transaksi';
            $data['title']          ='Member Panel';
            $data['judul_menu']     ='Transaksi';
            $data['sub_judul']      ='Edit Peminjaman';
            $data['content']        ='transaksi/transaksi_form';
            $this->load->view('dashboard', $data);
            //$this->load->view('transaksi/transaksi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_buku' => $this->input->post('id_buku',TRUE),
		'kode_anggota' => $this->input->post('kode_anggota',TRUE),
		'tgl_pinjam' => $this->input->post('tgl_pinjam',TRUE),
		'tgl_kembali' => $this->input->post('tgl_kembali',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Transaksi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('panelib/transaksi'));
        }
    }

    public function delete($id)
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('panelib/transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('panelib/transaksi'));
        }
    }*/

    public function _rules()
    {
	$this->form_validation->set_rules('id_buku', 'id_buku', 'trim|required');
	$this->form_validation->set_rules('kode_anggota', 'kode_anggota', 'trim|required');
	$this->form_validation->set_rules('tgl_pinjam', 'tgl pinjam', 'trim|required');
	$this->form_validation->set_rules('tgl_kembali', 'tgl kembali', 'trim|required');
	//$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi.xls";
        $judul = "transaksi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Judul");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Pinjam");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kembali");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Transaksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_buku);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_anggota);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pinjam);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_kembali);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=transaksi.doc");

        $data = array(
            'transaksi_data' => $this->Transaksi_model->get_all(),
            'start' => 0
        );

        $this->load->view('transaksi/transaksi_doc',$data);
    }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-09 09:14:26 */
/* http://harviacode.com */
