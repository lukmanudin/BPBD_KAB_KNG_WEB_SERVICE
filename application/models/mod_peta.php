<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_peta extends CI_Model{

	// function mobile_peta_detail($id){
	// 	$return = $this->db->query("select * from t_peta where id='".$id."'");
	// 	return $return->result();
	// }

	function peta_published(){
		$return = $this->db->query("select * from t_peta where status='Publish' order by tanggal_upload desc limit 20");
		return $return->result();
	}
	

	function peta(){
		$return = $this->db->query("select * from t_peta order by id desc");
		return $return->result();
	}

	function peta_input($data){
		$this->db->insert('t_peta',$data);
        return $this->db->affected_rows();
	} 

	function peta_edit($id){
		$return = $this->db->query("select * from t_peta where id='".$id."'");
		return $return->result();
	}

	function peta_update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('t_peta', $data); 
		return $this->db->affected_rows();
	}

	function peta_delete($id){
		$this->db->query("delete from t_peta where id='".$id."'");
        return $this->db->affected_rows();
	} 

	function mobile_peta_list($jenis){
		$return = $this->db->query("select * from t_peta where jenis='".$jenis."' and status='Publish' order by id desc");
		return $return->result();
	}

	function mobile_peta_detail($id){
		$return = $this->db->query("select * from t_peta where id='".$id."'");
		return $return->result();
	}


	//----ref peta
	function ref_peta(){
		$return = $this->db->query("select * from t_ref_jenis_peta order by id asc");
		return $return->result();
	}

	function peta_total(){
		$return = $this->db->query("select count(*) as jumlah from t_peta");
        return $return->result();
	}

	function peta_publish(){
		$return = $this->db->query("select count(*) as jumlah from t_peta where status='Publish'");
        return $return->result();
	}

	function peta_draft(){
		$return = $this->db->query("select count(*) as jumlah from t_peta where status='Draft'");
        return $return->result();
	}

	


}