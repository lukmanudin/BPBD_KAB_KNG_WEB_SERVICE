<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_peringatandini extends CI_Model{

	function mobile_peringatan_dini_detail($id){
		$return = $this->db->query("select * from t_peringatan_dini where id='".$id."'");
		return $return->result();
	}

	function peringatan_dini_published(){
		$return = $this->db->query("select * from t_peringatan_dini where status='Publish' order by tanggal_publish desc limit 20");
		return $return->result();
	}

	function last_peringatan_dini(){
		$return = $this->db->query("select * from t_peringatan_dini order by id desc limit 5");
		return $return->result();
	}

	function peringatan_dini(){
		$return = $this->db->query("select * from t_peringatan_dini order by id desc");
		return $return->result();
	}

	function peringatan_dini_input($data){
		$this->db->insert('t_peringatan_dini',$data);
        return $this->db->affected_rows();
	} 

	function peringatan_dini_edit($id){
		$return = $this->db->query("select * from t_peringatan_dini where id='".$id."'");
		return $return->result();
	}

	function peringatan_dini_update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('t_peringatan_dini', $data); 
		return $this->db->affected_rows();
	}

	function peringatan_dini_delete($id){
		$this->db->query("delete from t_peringatan_dini where id='".$id."'");
        return $this->db->affected_rows();
	} 

	function notifikasi(){
		$return = $this->db->query("select count(*) as jumlah from t_peringatan_dini");
        return $return->result();
	}

	function peringatan_dini_total(){
		$return = $this->db->query("select count(*) as jumlah from t_peringatan_dini");
        return $return->result();
	}

	function peringatan_dini_publish(){
		$return = $this->db->query("select count(*) as jumlah from t_peringatan_dini where status='Publish'");
        return $return->result();
	}

	function peringatan_dini_draft(){
		$return = $this->db->query("select count(*) as jumlah from t_peringatan_dini where status='Draft'");
        return $return->result();
	}
	
	

	


}