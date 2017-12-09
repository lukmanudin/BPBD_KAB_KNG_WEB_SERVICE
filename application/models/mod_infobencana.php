<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_infobencana extends CI_Model{
    
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

	//----ref bencana
	function ref_bencana(){
		$return = $this->db->query("select * from t_ref_bencana order by id asc");
		return $return->result();
	}

	


}