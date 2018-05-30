<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*  
    ** NOTE m_history_login **
    list fungsi bawaan PHP :
    - date ()
    - array ()
*/
class m_history_login extends CI_Model {
    
    // variable untuk set nama table dan query-query yang akan dipakai
    var $table = 'login_histories';
    var $q_check_duplicate = "SELECT * FROM login_histories WHERE tgl_login LIKE ?";

    /*  
		nama fungsi : mengambil_history
		deskripsi : method untuk pengambilan data history login yang nantinya akan dikembalikan pada controller
	*/
    public function mengambil_history($id) {
        $hasil = $this->db->query("SELECT * FROM login_histories ORDER BY tgl_login DESC LIMIT 5")->result();
        return $hasil;
    }

    /*  
		nama fungsi : mengambil_history
		deskripsi : method untuk pengecekan jika admin login pada hari yang sama maka tidak akan disave didb tetapi hanya diupdate
	*/
    public function mengambil_duplikasi_login() {
        $result = $this->db->query($this->q_check_duplicate, array("%".date('Y-m-d')."%"))->result() ;
        return $result;
    }

    /*  
		nama fungsi : simpan_history
		deskripsi : method untuk save kapan admin login dan jika login pada hari yang sama maka akan diupdate
	*/
    public function simpan_history($id_user) {
        $data = array(
            "id_user" => $id_user,
            "tgl_login" => date('Y-m-d H:i')
        );

        // pengecekan login, jika admin baru melakukan login maka akan masuk pada if (count($this->mengambil_duplikasi_login()) < 1) untuk disave
        if (count($this->mengambil_duplikasi_login()) < 1) {

            if ($this->db->insert($this->table, $data)) {
                return $result = true;
            } else {
                $error = $this->db->error();
                return $result = false;
            }

        // kondisi untuk update
        }  else {
            
            $query = $this->db->where('id_history_login',$this->mengambil_duplikasi_login()[0]->login_history_id);
            if ($this->db->update($this->table, $data)) {
                return $result = true;
            } else {
                $error = $this->db->error();
                return $result = false;
            }
        }     
    }
}
