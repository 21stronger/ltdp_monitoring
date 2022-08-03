<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Pic_model extends Model{

    protected $table        = 'tb_pic';
    protected $primaryKey   = 'id_pic';

    protected $allowedFields = ['name_pic','user_pic','role_pic','pass_pic','id_department'];
 
    public function getPics(){
        //return $this->findAll();
        $builder = $this->db->table($this->table);
        $builder->select("`tb_pic`.*, `tb_department`.*");
        $builder->join("`tb_department`", 
            "`tb_department`.`id_department` = `tb_pic`.`id_department`", 
            "left");
        return $builder->get()->getResultArray();
    }

    // public function checkPic($user_pic){
    //     $this->db->table($this->table);
    //     return $this->where('user_pic', $user_pic)->first();
    // }
 
    public function addPic($data){
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function checkPic($idPic){
        $builder = $this->db->table($this->table);
        $builder->select("`tb_pic`.*, `tb_department`.*");
        $builder->join("`tb_department`", 
            "`tb_department`.`id_department` = `tb_pic`.`id_department`", 
            "left");
        $builder->where("`tb_pic`.`id_pic`", $idPic);
        $result = $builder->get()->getResultArray();
        return $result[0];
    }
}