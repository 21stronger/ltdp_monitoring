<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Monthly_activity_model extends Model{

    protected $table        = 'tb_monthly_activity';
    protected $primaryKey   = 'id_monthly_activity';

    protected $allowedFields = ['actual_monthly_activity'];
 
    public function addBatch($data){
        $builder = $this->db->table($this->table);
        return $builder->insertBatch($data);
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