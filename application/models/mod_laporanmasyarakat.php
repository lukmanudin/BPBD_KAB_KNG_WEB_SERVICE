<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_laporanmasyarakat extends CI_Model{
	
	function last_laporan_masyarakat(){
		$return = $this->db->query("select * from t_laporan_masyarakat order by id desc limit 5");
		return $return->result();
	}

	function laporan_masyarakat(){
		$return = $this->db->query("select * from t_laporan_masyarakat order by id desc");
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
}