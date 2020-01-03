<?php
class Register_model extends CI_Model
{
    function insert($data)
    {
        $this->db->insert('karyawan', $data);
        return $this->db->insert_id();
    }

    function verify_email($key)
    {
        $this->db->where('verification_key', $key);
        $this->db->where('is_email', '0');
        $query = $this->db->get('karyawan');
        if ($query->num_rows() > 0) {
                $data = array(
                    'is_email'  => '1'
                );
                $this->db->where('verification_key', $key);
                $this->db->update('karyawan', $data);
                return true;
            } else {
                return false;
            }
    }
}

 