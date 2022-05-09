<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class View_activity_detail_model extends Model{

    protected $table = 'vw_activity_detail';
    protected $primaryKey   = 'id_project';

    public function monthCount($id_project){
        $builder = $this->db->table($this->table);
        $builder->select('`activity_name`, COUNT(1) AS count, `activity_weight`');
        $builder->where('id_project', $id_project);
        $builder->groupBy('activity_name');
        return $builder->get()->getResultArray();
    }
}