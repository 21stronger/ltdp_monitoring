<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Department_model extends Model{

    protected $table        = 'tb_department';
    protected $primaryKey   = 'id_department';
 
    public function getDepartments(){
       return $this->findAll();
    }

    public function addDepartment($data){
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editDepartment($id_department, $data){
        $builder = $this->db->table($this->table);
        $builder->where($primaryKey, $id_department);
        $builder->update($data);
    }

    public function deleteDepartment($id_department){
        $builder = $this->db->table($this->table);
        return $builder->delete($id_department);
    }

    public function getSummaryByMonth($month){
        $builder = $this->db->table($this->table);
        $builder->select('
        `tb_department`.`id_department`, 
        `tb_department`.`department_name`, 
        `summary`.`date_monthly_activity`, 
        COALESCE(`summary`.`overdue`, 0) AS overdue, 
        COALESCE(`summary`.`ontime`, 0) AS ontime, 
        COALESCE(`summary`.`faster`, 0) AS faster');
        $builder->join(
            "(SELECT * FROM `vw_summary_department_pivot` 
                WHERE `vw_summary_department_pivot`.`date_monthly_activity`='2022-".$month."-01') summary", 
            "`tb_department`.`department_name`=`summary`.`department_name`", 
            "left");
        return $builder->get()->getResultArray();
    }
}