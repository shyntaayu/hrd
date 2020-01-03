<?php
class Login_model extends CI_Model
{
    function can_login($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('karyawan');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $store_password = $this->encrypt->decode($row->password, $this->config->item('key_secret'));
                if ($password == $store_password) {
                    $newdata = array(
                        'name'  => $row->nama,
                        'id' => $row->nik
                    );
                    $this->session->set_userdata($newdata);
                } else {
                    return 'Password Salah';
                }
            }
        } else {
            return 'Alamat Email Salah';
        }
    }
}
