
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_test extends CI_Model{
    
    function test(){
        $query = "select * "
                ."from t_peringatan_dini ";
        $result = $this->db->query($query);
        return $result->result();
    }
    
    

}
