<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peminjaman extends CI_Controller
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
        //$this->load->model('order/Pesanan_model');
        $this->load->model('Report_model');
    }

    public function index()
    {
      # code...
        $data['aktif']        ='Laporan';
        $data['title']        ='Admin Panel';
        $data['judul_menu']   ='Laporan';
        $data['sub_judul']     ='Peminjaman';
        //$data['pesanan']      = $this->Pesanan_model->total_baru();
        $data['data']         = $this->Report_model->get_all();

        //$data['record']		= $this->Report_model->get_produk();
        $data['chart']		= $this->Report_model->show_all_data();
		    $this->load->view('pinjam/report', $data);

    }

    public function view_table(){
        $result = $this->Report_model->show_all_data();
        if ($result != false) {
        return $result;
        } else {
        return 'Database is empty !';
        }
    }

    public function periode() {
        //proses
        if($this->input->post('proses')){
        $date1 = $this->input->post('date_from');
        $date2 = $this->input->post('date_to');
        $data = array(
          'date1' => $date1,
          'date2' => $date2
        );
        if ($date1 == "" || $date2 == "") {
        $data['date_range_error_message'] = "Both date fields are required";
        } else {
        $result = $this->Report_model->show_data_by_date_range($data);
        if ($result != false) {
        $data['result_display'] = $result;
        } else {
        $data['result_display'] = "No record found !";
        }
        }
        $data['aktif']      ='Laporan';
        $data['title']       ='Admin Panel';
        $data['judul_menu']  ='Laporan';
        $data['sub_judul']    ='Peminjaman';
        //$data['pesanan'] = $this->Pesanan_model->total_baru();
        $data['data']=$this->Report_model->get_all();
        //$data['record']		= $this->Report_model->get_produk();
        //$sum = $this->Report_model->sum($data);
        //$data['sum'] = $sum;
        $data['show_table'] = $this->view_table();
        $this->load->view('pinjam/report', $data);
        }
        //cetak
        if($this->input->post('cetak')){
          $date1 = $this->input->post('date_from');
          $date2 = $this->input->post('date_to');
          $data = array(
            'date1' => $date1,
            'date2' => $date2
          );
          $this->load->library('dompdf_gen');
          if ($date1 == "" || $date2 == "") {
          $data['date_range_error_message'] = "Both date fields are required";
          } else {
          $result = $this->Report_model->show_data_by_date_range($data);
          if ($result != false) {
          $data['result_display'] = $result;
          } else {
          $data['result_display'] = "No record found !";
          }
          }
          //$data['pesanan'] = $this->Pesanan_model->total_baru();
          $data['data']=$this->Report_model->get_all();
          //$data['record']		= $this->Report_model->get_produk();
          //$sum = $this->Report_model->sum($data);
          //$data['sum'] = $sum;
          $html = $this->load->view('pinjam/table_report', $data, true);

    	    $this->dompdf_gen->generate($html,'contoh');
        }
    }

    public function bulanan() {
        if($this->input->post('proses')){
        $date1 = $this->input->post('bulan');
        $date2 = $this->input->post('tahun');
        $data = array(
          'date1' => $date1,
          'date2' => $date2
        );
        if ($date1 == "" || $date2 == "") {
        $data['date_range_error_message'] = "Both date fields are required";
        } else {
        $result = $this->Report_model->show_data_by_date($data);
        if ($result != false) {
        $data['result_display'] = $result;
        } else {
        $data['result_display'] = "No record found !";
        }
        }
        $data['aktif']      ='Laporan';
        $data['title']       ='Admin Panel';
        $data['judul_menu']  ='Laporan';
        $data['sub_judul']    ='Peminjaman';
        //$data['pesanan'] = $this->Pesanan_model->total_baru();
        $data['data']=$this->Report_model->get_all();
        //$data['record']		= $this->Report_model->get_produk();
        //$sum = $this->Report_model->sum2($data);
        //$data['sum'] = $sum;
        $data['show_table'] = $this->view_table();
        $this->load->view('pinjam/report', $data);
        }
        //cetak
        if($this->input->post('cetak')){
          $date1 = $this->input->post('bulan');
          $date2 = $this->input->post('tahun');
          $data = array(
            'date1' => $date1,
            'date2' => $date2
          );

          $this->load->library('dompdf_gen');
          if ($date1 == "" || $date2 == "") {
          $data['date_range_error_message'] = "Both date fields are required";
          } else {
          $result = $this->Report_model->show_data_by_date($data);
          if ($result != false) {
          $data['result_display'] = $result;
          } else {
          $data['result_display'] = "No record found !";
          }
          }
          //$data['pesanan'] = $this->Pesanan_model->total_baru();
          $data['data']=$this->Report_model->get_all();
          //$data['record']		= $this->Report_model->get_produk();
          //$sum = $this->Report_model->sum2($data);
          //$data['sum'] = $sum;
          $html = $this->load->view('pinjam/reportpdf', $data, true);

    	    $this->dompdf_gen->generate($html,'contoh');
          // $this->load->helper('exportexcel');
          // $namaFile = "reportreperiode.xls";
          // $judul = "Generate Report Periode";
          // $tablehead = 0;
          // $tablebody = 1;
          // $nourut = 1;
          // //penulisan header
          // header("Pragma: public");
          // header("Expires: 0");
          // header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
          // header("Content-Type: application/force-download");
          // header("Content-Type: application/octet-stream");
          // header("Content-Type: application/download");
          // header("Content-Disposition: attachment;filename=" . $namaFile . "");
          // header("Content-Transfer-Encoding: binary ");
          //
          // xlsBOF();
          //
          // $kolomhead = 0;
          // xlsWriteLabel($tablehead, $kolomhead++, "No.");
          // xlsWriteLabel($tablehead, $kolomhead++, "Kode Pesanan");
        	// xlsWriteLabel($tablehead, $kolomhead++, "Produk");
        	// xlsWriteLabel($tablehead, $kolomhead++, "QTY");
        	// xlsWriteLabel($tablehead, $kolomhead++, "Harga Satuan");
          // xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
          // xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Invoice");
          //
        	// foreach ($this->Report_model->show_data_by_date($data) as $row) {
          //           $kolombody = 0;
          //
          //     //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
          //     xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    // xlsWriteLabel($tablebody, $kolombody++, $row->kode_pesanan);
    	    // xlsWriteLabel($tablebody, $kolombody++, $row->produk);
    	    // xlsWriteLabel($tablebody, $kolombody++, $row->qty);
          // xlsWriteLabel($tablebody, $kolombody++, $row->hrg_satuan);
          // xlsWriteLabel($tablebody, $kolombody++, $row->subtotal);
          // xlsWriteLabel($tablebody, $kolombody++, $row->tgl);
          //
    	    // $tablebody++;
          //       $nourut++;
          //   }
          //
          // xlsEOF();
          // exit();
        }
      }


}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-13 05:41:34 */
/* http://harviacode.com */
