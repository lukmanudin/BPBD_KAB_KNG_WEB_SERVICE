<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_chat extends CI_Model {

    function chat(){
        $query = "select t_forum.id, 
        t_user.nama as pengirim, 
        t_forum.judul, t_forum.isi, 
        t_forum.tanggal_buat 
        from t_forum inner join t_user  
        on t_user.id = t_forum.pengirim 
        order by t_forum.id desc";
        $return = $this->db->query($query);
		return $return->result();
    }

    function chat_detail($id){
        $query = "select t_forum.id, 
        t_user.nama as pengirim, 
        t_forum.judul, t_forum.isi, 
        t_forum.tanggal_buat 
        from t_forum inner join t_user  
        on t_user.id = t_forum.pengirim 
        where  
        t_forum.id = '".$id."'";
        $return = $this->db->query($query);
		return $return->result();
    }
    
    function chat_input($data){
		$this->db->insert('t_forum',$data);
        return $this->db->affected_rows();
    } 
    
    function chat_delete($id){
		$this->db->query("delete from t_forum where id='".$id."'");
        return $this->db->affected_rows();
	} 
}