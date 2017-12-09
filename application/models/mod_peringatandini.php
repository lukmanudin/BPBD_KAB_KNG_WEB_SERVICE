<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_peringatandini extends CI_Model{
    
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

	


}