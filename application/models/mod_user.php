<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_user extends CI_Model{
	
	function get_user_by_username($data){
        $query = "select t_user.id, t_user.username, t_user.password, t_user.nama, t_user.tipe, t_user.status, t_user.email, t_user.alamat "
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

    function verifikasi_daftar($data){
        $query = "select t_user.username "
                ."from t_user "
                ."where "
                ."t_user.username = '".$data["username"]."' or email = '".$data["email"]."'";
        $result = $this->db->query($query);
        return $result->result();
    }

    function daftar($data){
        $this->db->insert('t_user',$data);
        return $this->db->affected_rows();
    }

    function user(){
        $query_str = "select t_user.id, "
        ."t_user.username, "
        ."t_user.nama, "
        ."t_user.status "
        ."from t_user where tipe='2' order by id asc";
        $query = $this->db->query($query_str);
        return $query->result();
    }
    
    function user_edit($id){
		$return = $this->db->query("select * from t_user where id='".$id."'");
		return $return->result();
    }

    function user_update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('t_user', $data); 
		return $this->db->affected_rows();
	}
    
    function user_delete($id){
		$this->db->query("delete from t_user where id='".$id."'");
        return $this->db->affected_rows();
	} 
    
    function get_password_by_id($id){
        $query_str = "select t_user.password as password from t_user where id='".$id."'";
        $query = $this->db->query($query_str);
        return $query->result();
    }

    function user_total(){
		$return = $this->db->query("select count(*) as jumlah from t_user where tipe='2'");
        return $return->result();
	}

	function user_belum_aktif(){
		$return = $this->db->query("select count(*) as jumlah from t_user where status='0' and tipe='2'");
        return $return->result();
	}

	function user_aktif(){
		$return = $this->db->query("select count(*) as jumlah from t_user where status='1' and tipe='2'");
        return $return->result();
    }
    
    function user_terblokir(){
		$return = $this->db->query("select count(*) as jumlah from t_user where status='2' and tipe='2'");
        return $return->result();
	}



	


}