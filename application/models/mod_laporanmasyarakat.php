<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_laporanmasyarakat extends CI_Model{

	function mobile_laporan_masyarakat_detail($id){
		$return = $this->db->query("select
		t_laporan_masyarakat.id,
		t_laporan_masyarakat.pengirim,
		t_laporan_masyarakat.tanggal_kejadian,
		t_laporan_masyarakat.judul,
		t_laporan_masyarakat.kategori,
		t_laporan_masyarakat.kampung, 
		t_laporan_masyarakat.kelurahan,
		t_laporan_masyarakat.kecamatan,
		t_laporan_masyarakat.kabupaten,
		t_laporan_masyarakat.kronologis,
		t_laporan_masyarakat.lampiran,
		t_laporan_masyarakat.status,
		t_laporan_masyarakat.tanggal_buat,
		t_ref_status_laporan.status as status_laporan,
		t_ref_bencana.nama_bencana as ben,
		t_user.nama as nama_pengirim
		from t_laporan_masyarakat
		inner join 
		t_ref_status_laporan on 
		t_ref_status_laporan.id = t_laporan_masyarakat.status
		inner join 
		t_ref_bencana on 
		t_ref_bencana.id = t_laporan_masyarakat.status 
		inner join 
		t_user on  
		t_user.id = t_laporan_masyarakat.pengirim
		where t_laporan_masyarakat.id ='".$id."'");
		return $return->result();
	}
	
	function last_laporan_masyarakat(){
		$return = $this->db->query("select * from t_laporan_masyarakat order by id desc limit 5");
		return $return->result();
	}

	function laporan_masyarakat(){
		$return = $this->db->query("select
		 t_laporan_masyarakat.id,
		 t_laporan_masyarakat.pengirim,
		 t_laporan_masyarakat.tanggal_kejadian,
		 t_laporan_masyarakat.judul,
		 t_laporan_masyarakat.kategori,
		 t_laporan_masyarakat.kampung, 
		 t_laporan_masyarakat.kelurahan,
		 t_laporan_masyarakat.kecamatan,
		 t_laporan_masyarakat.kabupaten,
		 t_laporan_masyarakat.kronologis,
		 t_laporan_masyarakat.lampiran,
		 t_laporan_masyarakat.status,
		 t_laporan_masyarakat.tanggal_buat,
		 t_ref_status_laporan.status as status_laporan,
		 t_ref_bencana.nama_bencana as ben,
		 t_user.nama as nama_pengirim
		 from t_laporan_masyarakat
		 inner join 
		 t_ref_status_laporan on 
		 t_ref_status_laporan.id = t_laporan_masyarakat.status
		 inner join 
		 t_ref_bencana on 
		 t_ref_bencana.id = t_laporan_masyarakat.status 
		 inner join 
		 t_user on  
		 t_user.id = t_laporan_masyarakat.pengirim order by id desc");
		return $return->result();
	}

	function laporan_masyarakat_input($data){
		$this->db->insert('t_laporan_masyarakat',$data);
        return $this->db->affected_rows();
	} 

	function laporan_masyarakat_edit($id){
		$return = $this->db->query("select * from t_laporan_masyarakat where id='".$id."'");
		return $return->result();
	}

	function laporan_masyarakat_update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('t_laporan_masyarakat', $data); 
		return $this->db->affected_rows();
	}

	function laporan_masyarakat_delete($id){
		$this->db->query("delete from t_laporan_masyarakat where id='".$id."'");
        return $this->db->affected_rows();
	} 

	function laporan_masyarakat_by_pengirim($pengirim){
		$return = $this->db->query("select * from t_laporan_masyarakat where pengirim ='".$pengirim."' and status != '5' order by id desc");
		return $return->result();
	}

	function notifikasi($pengirim){
		$return = $this->db->query("select * from t_laporan_masyarakat where pengirim ='".$pengirim."'");
		return $return->result();
	} 

	//--ref status laporan
	function ref_st(){
		$return = $this->db->query("select * from t_ref_status_laporan");
		return $return->result();
	}

	function laporan_masyarakat_total(){
		$return = $this->db->query("select count(*) as jumlah from t_laporan_masyarakat");
        return $return->result();
	}

	function laporan_masyarakat_waiting(){
		$return = $this->db->query("select count(*) as jumlah from t_laporan_masyarakat where status='1'");
        return $return->result();
	}

	function laporan_masyarakat_assessment(){
		$return = $this->db->query("select count(*) as jumlah from t_laporan_masyarakat where status='2'");
        return $return->result();
	}
	
	function laporan_masyarakat_process(){
		$return = $this->db->query("select count(*) as jumlah from t_laporan_masyarakat where status='3'");
        return $return->result();
	}

	function laporan_masyarakat_selesai(){
		$return = $this->db->query("select count(*) as jumlah from t_laporan_masyarakat where status='4'");
        return $return->result();
	}
	
	function laporan_masyarakat_victim(){
		$return = $this->db->query("select count(*) as jumlah from t_laporan_masyarakat where status='5'");
        return $return->result();
	}
}