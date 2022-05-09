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

    public function getSummaryByMonth($date){
        $builder = $this->db->table($this->table);
        $builder->select('tb_department.*, COUNT(IF(vw_summary_monthly.ach>1, 1, null)) AS faster, COUNT(IF(vw_summary_monthly.ach=1, 1, null)) AS ontime, COUNT(IF(vw_summary_monthly.ach<1, 1, null)) AS overdue');
        $builder->join('vw_summary_monthly', 'tb_department.department_name=vw_summary_monthly.department_name', 'left');
        $builder->where("vw_summary_monthly.date_monthly_activity='2022-01-01' OR vw_summary_monthly.date_monthly_activity is null");
        $builder->groupBy('`tb_department`.department_name');
        $builder->orderBy('`tb_department`.`id_department`', 'ASC');
        return $builder->get()->getResultArray();
    }
}