<?php 
class User_model extends CI_Model {


        public function check_login($data)
        {
                $this->db->where($data);        
                return $this->db->get('admin_tbl')->num_rows();
        }
}
