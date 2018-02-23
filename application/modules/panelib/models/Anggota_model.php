<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota_model extends CI_Model
{

    public $table = 'anggota';
    public $table1 = 'kelas';
    public $id = 'kode_anggota';
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
        $this->db->like('kode_anggota', $q);
	$this->db->or_like('NISP', $q);
	$this->db->or_like('id_kelas', $q);
	$this->db->or_like('nama_anggota', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('telepon', $q);
	$this->db->or_like('alamat', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_anggota', $q);
	$this->db->or_like('NISP', $q);
	$this->db->or_like('id_kelas', $q);
	$this->db->or_like('nama_anggota', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('telepon', $q);
	$this->db->or_like('alamat', $q);
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
        //$this->db->delete($this->table);
        $delete = $this->db->get($this->table);
        $row = $delete->row();
        unlink("./assets/anggota/$row->foto");
        $hapus = $this->db->delete($this->table, array($this->id => $id));
        return $hapus;
    }

    //cek status peminjaman buku
    public function cek_status($kode_anggota){
        $this->db->where('kode_anggota', $kode_anggota);
        $this->db->where('status', 'pinjam');
        $cek = $this->db->get('transaksi');
        if ($cek->num_rows() > 0) {
          return TRUE;
        } else return FALSE;
    }

    function get_anggota() {
      $this->db->select("anggota.kode_anggota, anggota.NISP, anggota.nama_anggota, anggota.jenis_kelamin, anggota.tempat_lahir, anggota.tgl_lahir, anggota.telepon, kelas.jurusan, kelas.kelas");
      $this->db->from($this->table);
      $this->db->join($this->table1, 'kelas.id_kelas = anggota.id_kelas');
      $this->db->order_by($this->id, $this->order);
      return $query = $this->db->get()->result();
    }

    //koding untuk pagination
    function get_allanggota($batas =null,$offset=null,$key=null) {
        //$this->db->from($this->table);
        $this->db->select("anggota.kode_anggota, anggota.NISP, anggota.nama_anggota, anggota.jenis_kelamin, anggota.tempat_lahir, anggota.tgl_lahir, anggota.telepon, kelas.jurusan, kelas.kelas");
      $this->db->from($this->table);
      $this->db->join($this->table1, 'kelas.id_kelas = anggota.id_kelas');
      $this->db->order_by($this->id, $this->order);
      //$this->db->where(array('produk.username' => $this->session->identity));

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

    function count_anggota(){
        $query = $this->db->get($this->table)->num_rows();
        return $query;
        }

    function  count_anggota_search($orlike) {
        $this->db->or_like($orlike);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    public function buat_kode()   {
          $this->db->select('RIGHT(anggota.kode_anggota, 2) as kode', FALSE);
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
          $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 2 menunjukkan jumlah digit angka 0
          $kodejadi = "AG0000".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;
    }

    public function cek_nisp($nisp){
        $this->db->where('NISP', $nisp);
        $cek = $this->db->get($this->table);
        if($cek->num_rows() > 0) {
            return TRUE;
        } else return FALSE;
    }

    public function get_kelas(){
        $this->db->select('*');
        $this->db->from($this->table1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

     public function by_jurusan($id_kelas){
        $this->db->where('id_kelas', $id_kelas);
        $result = $this->db->get('kelas');
        if ($result->num_rows() > 0 ) {
            return $result->result_array();
        } else {
          return array();
        }
    }

}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-02 05:35:00 */
/* http://harviacode.com */
