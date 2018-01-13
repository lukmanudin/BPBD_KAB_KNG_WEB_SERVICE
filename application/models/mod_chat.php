<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_chat extends CI_Model {

    function chat(){
        $query = "select t_forum.id, 
        t_forum.pengirim as id_pengirim, 
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

    function chat_komentar($id){
        $query = "select t_forum_komentar.id, 
        t_user.nama as pengirim, 
        t_forum_komentar.isi, 
        t_forum_komentar.tanggal_buat 
        from t_forum_komentar inner join t_user  
        on t_user.id = t_forum_komentar.pengirim 
        where  
        t_forum_komentar.forum = '".$id."'";
        $return = $this->db->query($query);
		return $return->result();
    }
    
    function chat_input($data){
		$this->db->insert('t_forum',$data);
        return $this->db->affected_rows();
    } 

    function chat_edit($id){
		$return = $this->db->query("select * from t_forum where id='".$id."'");
		return $return->result();
    }

    function chat_update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('t_forum', $data); 
		return $this->db->affected_rows();
	}
    
    function chat_delete($id){
		$this->db->query("delete from t_forum where id='".$id."'");
        return $this->db->affected_rows();
    } 

    function chat_input_komentar($data){
		$this->db->insert('t_forum_komentar',$data);
        return $this->db->affected_rows();
    } 

    function notifikasi($pengirim){
		$return = $this->db->query("select count(*) as jumlah from t_forum_komentar where pengirim ='".$pengirim."'");
		return $return->result();
    }
    
    
    
    
    
}