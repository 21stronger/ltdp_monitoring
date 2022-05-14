<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Pic_model extends Model{

    protected $table        = 'tb_pic';
    protected $primaryKey   = 'id_pic';

    protected $allowedFields = ['name_pic','user_pic','role_pic','pass_pic'];
 
    public function getPics(){
       return $this->findAll();
    }

    public function checkPic($user_pic){
        $this->db->table($this->table);
        return $this->where('user_pic', $user_pic)->first();
    }
 
    public function addPic($data){
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editPic($id_pic, $data){
        $builder = $this->db->table($this->table);
        return $builder->update($id_pic, $data);
    }

    public function delPic($id_pic){
        $builder = $this->db->table($this->table);
        return $builder->delete($id_pic);
    }
}