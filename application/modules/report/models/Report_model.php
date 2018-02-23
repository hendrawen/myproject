<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model
{

    public $table = 'transaksi';
    public $table1 = 'buku';
    //public $id2 = 'qty';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
      $this->db->select("transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.kode_buku, buku.judul, buku.pengarang, anggota.kode_anggota, anggota.nama_anggota");
      $this->db->from($this->table);
      $this->db->join($this->table1, 'buku.id_buku = transaksi.id_buku');
      $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
      $this->db->order_by($this->id, $this->order);
      $this->db->where('status', 'pinjam');
        $query = $this->db->get();
      if($query->num_rows() > 0){
          foreach($query->result() as $data){
              $hasil[] = $data;
          }
          return $hasil;
      }
    }

    function get_transaksi()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 'pinjam');
        //$this->db->where('username', $this->session->identity);
        $this->db->limit('10');
        return $this->db->get($this->table)->result();
    }

    public function show_all_data() {
        $this->db->select('*');
        $this->db->from('transaksi');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }

    //function utk menjumlahkan total denda
    /*public function sum($data) {
        $condition = "bulan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('SUM(subtotal) AS total');
        $this->db->from('pesanan');
        $this->db->where('status', 'Selesai');
        $this->db->where($condition);
        //$this->db->where('username', $this->session->identity);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }*/

    //Peminjaman Buku Berdasarkan Periode
    public function show_data_by_date_range($data) {
        $condition = "transaksi.bulan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.kode_buku, buku.judul, buku.pengarang, anggota.kode_anggota, anggota.nama_anggota');
        $this->db->from($this->table);
        $this->db->join($this->table1, 'buku.id_buku = transaksi.id_buku');
        $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', 'pinjam');
        $this->db->where($condition);
        //$this->db->where('username', $this->session->identity);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }

    /*public function show_laba_by_date_range($data) {
        $condition = "bulan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('SUM(modal) as modal, SUM(labakotor) as labakotor, SUM(labakotor)-SUM(modal) AS lababersih');
        $this->db->from('laporan');
        $this->db->where($condition);
        $this->db->where('username', $this->session->identity);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }*/

    //SELECT SUM(modal) as modal , SUM(labakotor) as labakotor, SUM(labakotor)-SUM(modal) AS lababersih FROM `qreport` WHERE bulan BETWEEN '2017-11-08' AND '2017-11-11'
    /*public function sum2($data) {
        $condition = "MONTH(bulan) =" . "'" . $data['date1'] . "'" . " AND YEAR(bulan) =" . "'" . $data['date2'] . "'";
        $this->db->select('SUM(subtotal) AS total');
        $this->db->from('pesanan');
        $this->db->where('status', 'Selesai');
        $this->db->where($condition);
        $this->db->where('username', $this->session->identity);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }*/

    //Peminjaman Buku Berdasarkan Bulan
    public function show_data_by_date($data) {
        $condition = "MONTH(bulan) =" . "'" . $data['date1'] . "'" . " AND YEAR(bulan) =" . "'" . $data['date2'] . "'";
        $this->db->select('transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.kode_buku, buku.judul, buku.pengarang, anggota.kode_anggota, anggota.nama_anggota');
        $this->db->from($this->table);
        $this->db->join($this->table1, 'buku.id_buku = transaksi.id_buku');
        $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', 'pinjam');
        $this->db->where($condition);
        /*$this->db->where('username', $this->session->identity);*/
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }

    //Pengembalian Buku Berdasarkan Periode
    public function show_data_by_date_range2($data) {
        $condition = "transaksi.bulan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, transaksi.terlambat, transaksi.denda, buku.kode_buku, buku.judul, buku.pengarang, anggota.kode_anggota, anggota.nama_anggota');
        $this->db->from($this->table);
        $this->db->join($this->table1, 'buku.id_buku = transaksi.id_buku');
        $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', 'kembali');
        $this->db->where($condition);
        //$this->db->where('username', $this->session->identity);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }

    //Pengembalian Buku Berdasarkan Bulan
    public function show_data_by_date2($data) {
        $condition = "MONTH(bulan) =" . "'" . $data['date1'] . "'" . " AND YEAR(bulan) =" . "'" . $data['date2'] . "'";
        $this->db->select('transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, transaksi.terlambat, transaksi.denda, buku.kode_buku, buku.judul, buku.pengarang, anggota.kode_anggota, anggota.nama_anggota');
        $this->db->from($this->table);
        $this->db->join($this->table1, 'buku.id_buku = transaksi.id_buku');
        $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', 'kembali');
        $this->db->where($condition);
        /*$this->db->where('username', $this->session->identity);*/
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
    }
}
