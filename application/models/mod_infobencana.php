<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_infobencana extends CI_Model{

	function mobile_info_bencana_detail($id){
		$return = $this->db->query("select * from t_info_bencana where id='".$id."'");
		return $return->result();
	}

	function info_bencana_published(){
		$return = $this->db->query("select * from t_info_bencana where status='Publish' order by tanggal_publish desc limit 20");
		return $return->result();
	}
	
	function last_info_bencana(){
		$return = $this->db->query("select * from t_info_bencana order by id desc limit 5");
		return $return->result();
	}
	
	function info_bencana(){
		$return = $this->db->query("select * from t_info_bencana order by id desc");
		return $return->result();
	}

	function info_bencana_input($data){
		$this->db->insert('t_info_bencana',$data);
        return $this->db->affected_rows();
	} 

	function info_bencana_edit($id){
		$return = $this->db->query("select * from t_info_bencana where id='".$id."'");
		return $return->result();
	}

	function info_bencana_update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('t_info_bencana', $data); 
		return $this->db->affected_rows();
	}

	function info_bencana_delete($id){
		$this->db->query("delete from t_info_bencana where id='".$id."'");
        return $this->db->affected_rows();
	} 

	function notifikasi(){
		$return = $this->db->query("select count(*) as jumlah from t_info_bencana");
        return $return->result();
	} 

	//----ref bencana
	function ref_bencana(){
		$return = $this->db->query("select * from t_ref_bencana order by id asc");
		return $return->result();
	}

	


}