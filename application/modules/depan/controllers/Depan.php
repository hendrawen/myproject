<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Depan extends CI_Controller
{
	
	function __construct() {
       parent::__construct();
        
        $this->load->model('Depan_model');
        
        $this->load->library('javascript');
    }
    

    public function index() {

        $this->load->library('calendar');
        $kalender =  $this->calendar->generate();
        $data = array('kalender' => $kalender);

        $data['aktif']        ='Dashboard';
        $data['title']        ='Selamat Datang Di SI Perpustakaan';
        $data['judul_menu']   ='Beranda';
        $data['sub_judul']    ='';
        $data['sambutan']     ='Di MyLibray';
        $data['content']      ='content';
        $this->load->view('dashboard',$data);
    }
   
    public function insert() 
    {
        $nama           = $this->input->post('nama', TRUE);
        $jenis_kelamin  = $this->input->post('jenis_kelamin', TRUE);
        $jenis          = $this->input->post('jenis', TRUE);
        $perlu          = implode(', ', $this->input->post('perlu', TRUE));
        $saran          = $this->input->post('saran', TRUE);

        $data = array(
            'id'   => $this->Depan_model->buat_kode(),
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'jenis' => $jenis,
            'perlu' => $perlu,
            'saran' => $saran,
            'tgl' => date('Y-m-d H:i:s')
        );
            $this->Depan_model->insert($data);
            $this->session->set_flashdata('msg','Data Kunjungan Anda Berhasil di Simpan!!!');
            redirect(site_url('depan'));
            /*$pengunjung = $this->Depan_model->insert($data);
            if ($pengunjung) {
                 $this->Depan_model->insert($data);
                 $this->session->set_flashdata('msg','Data Kunjungan Anda Berhasil di Simpan!!!');
                 redirect(site_url('depan'));
             } else {
                 $this->session->set_flashdata('msg','Gagal Simpan Data Kunjungan!!!');
                redirect(site_url('depan'));  
             }*/
    }

    public function cari_buku() {
           
            $data['aktif']        ='Cari';
            $data['title']        ='Selamat Datang Di SI Perpustakaan';
            $data['judul_menu']   ='Beranda';
            $data['sub_judul']    ='Cari Buku';
            $data['sambutan']     ='Di MyLibray';
            $data['content']      ='cari/cari_list';
            $this->load->view('dashboard',$data);
  
    }

    public function hasil_cari(){
         $book = $this->input->get('keyword',TRUE);

        if ($book == '') {
            echo '<script>(‘#tabel_cari’).hide();</script>';
        } else {

            $query = $this->Depan_model->get_buku($book);
            //print_r($query);

             foreach ($query as $key) { ?>
                <tr>
                    <td><img src='<?=base_url()?>assets/buku/<?=$key->gambar; ?>' width='70' height='70'></td>
                    <td><?php echo $key->judul ?></td>
                    <td><?php echo $key->pengarang ?></td>
                    <td><?php echo $key->penerbit ?></td>
                    <td><?php echo $key->lokasi ?></td>
                    <td><?php echo $key->bagian ?></td>
                <tr>;
            <?php }
        }
    }
}
