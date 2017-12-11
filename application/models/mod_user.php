<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_user extends CI_Model{
	
	function get_user_by_username($data){
        $query = "select t_user.id, t_user.username, t_user.password, t_user.nama, t_user.tipe, t_user.status, t_user.email "
                ."from t_user "
                ."where "
                ."t_user.username = '".$data["username"]."' ";
        $result = $this->db->query($query);
        return $result->result();
    }
    
    function update_login_timestamp($id,$data){
        $this->db->where('id', $id);
        $this->db->update('t_user', $data);  
    }
    
    function last_login($id){
        $query_str = "select t_user.last_login from t_user where id='".$id."'";
        $query = $this->db->query($query_str);
        return $query->result();
    } 
	

	


}