<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Activity_model extends Model{

    protected $table        = 'tb_activity';
    protected $primaryKey   = 'id_activity';

    protected $allowedFields = ['activity_name','activity_weight','activity_plan'];
    
    public function getActivities(){
       return $this->findAll();
    }

    public function addActivity($data){
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function editActivity($id_activity, $data){
        $builder = $this->db->table($this->table);
        $builder->where($primaryKey, $id_activity);
        $builder->update($data);
    }

    public function deleteActivity($id_activity){
        $builder = $this->db->table($this->table);
        return $builder->delete($id_activity);
    }
}
