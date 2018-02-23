<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table1 = 'buku';
    public $table = 'transaksi';
    public $id = 'id';
    public $id_buku = 'id_buku';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('judul', $q);
	$this->db->or_like('nama_anggota', $q);
	$this->db->or_like('tgl_pinjam', $q);
	$this->db->or_like('tgl_kembali', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('judul', $q);
	$this->db->or_like('nama_anggota', $q);
	$this->db->or_like('tgl_pinjam', $q);
	$this->db->or_like('tgl_kembali', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_transaksi() {
        $this->db->select("transaksi.id, transaksi.id_buku, transaksi.terlambat, transaksi.denda, transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.judul, buku.pengarang, anggota.nama_anggota");
      $this->db->from($this->table);
      $this->db->join($this->table1, 'buku.id_buku = transaksi.id_buku');
      $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
      $this->db->order_by($this->id, $this->order);
      $this->db->where('status', 'pinjam');
        $query = $this->db->get();
        return $query->result();
    }

    function get_alltransaksi($batas =null,$offset=null,$key=null) {
        $this->db->select("transaksi.id, transaksi.buku_id_buku, transaksi.terlambat, transaksi.denda, transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.judul, buku.pengarang, anggota.nama_anggota");
      $this->db->from($this->table);
      $this->db->join($this->table1, 'buku.id_buku = transaksi.buku_id_buku');
      $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
      $this->db->order_by($this->id, $this->order);
      $this->db->where('status', 'pinjam');

        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        if ($key != null) {
           $this->db->or_like($key);
        }
        $query = $this->db->get();

        //cek apakah ada barang
        if ($query->num_rows() > 0) {
            return $query->result();
            }
    }

    function count_transaksi(){
        $this->db->select("transaksi.id, transaksi.buku_id_buku, transaksi.terlambat, transaksi.denda, transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.judul, buku.pengarang, anggota.nama_anggota");
        $this->db->from($this->table);
        $this->db->join($this->table1, 'buku.id_buku = transaksi.buku_id_buku');
        $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', 'pinjam');
            $query = $this->db->get();
                return $query->num_rows();
        }

    function  count_transaksi_search($orlike) {
        $this->db->or_like($orlike);
        $this->db->select("transaksi.id, transaksi.buku_id_buku, transaksi.terlambat, transaksi.denda, transaksi.tgl_pinjam, transaksi.tgl_kembali, transaksi.status, buku.judul, buku.pengarang, anggota.nama_anggota");
        $this->db->from($this->table);
        $this->db->join($this->table1, 'buku.id_buku = transaksi.buku_id_buku');
        $this->db->join('anggota', 'anggota.kode_anggota = transaksi.kode_anggota');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', 'pinjam');
            $query = $this->db->get();
                return $query->num_rows();
    }

    public function get_buku(){
        $this->db->order_by('id_buku', $this->order);
        return $this->db->get($this->table1)->result();
    }

    public function get_anggota(){
        $this->db->order_by('kode_anggota', $this->order);
        return $this->db->get('anggota')->result();
    }

    public function get_stok($id_tr, $buku_id){
        $query = $this->db->query("UPDATE transaksi set status= 'kembali' WHERE id= '$id_tr'");
        $query = $this->db->query("UPDATE buku set stok= (stok+1) WHERE id_buku= '$buku_id'");
        return $query;
    }

    public function get_denda(){
        $this->db->select('denda');
        $this->db->from('denda');
        $this->db->where('id_denda', '1');
        return $this->db->get()->row();
    }

    public function buat_kode()   {
          $this->db->select('RIGHT(transaksi.id, 2) as kode', FALSE);
          $this->db->order_by($this->id, $this->order);
          $this->db->limit(1);
          $query = $this->db->get($this->table, $this->id);      //cek dulu apakah ada sudah ada kode di tabel.
          if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
           $data = $query->row();
           $kode = intval($data->kode) + 1;
          }
          else {
           //jika kode belum ada
           $kode = 1;
          }
          $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "1010".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;
    }

    public function cek_kode_anggota($kode_anggota){
        $this->db->where('kode_anggota', $kode_anggota);
        $this->db->where('status','pinjam');
        $cek = $this->db->get($this->table);
        if($cek->num_rows() > 1) {
            return TRUE;
        } else return FALSE;
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-09 09:14:26 */
/* http://harviacode.com */
