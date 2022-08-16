<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Project_model extends Model{

    protected $table        = 'tb_project';
    protected $primaryKey   = 'id_project';
 
    protected $allowedFields = [
        'id_category',
        'id_department',
        'id_pic',
        'project_name',
        'project_due_date',
        'achievement'
    ];
 
    public function getProjects(){
       return $this->findAll();
    }

    public function getOpenProject(){
        $builder = $this->db->table($this->table);
        $builder->where('achievement', 'Open');
        return $builder->get()->getNumRows();
    }

    public function getCloseProject(){
        $builder = $this->db->table($this->table);
        $builder->where('achievement', 'Close');
        return $builder->get()->getNumRows();
    }

    public function getCancelProject(){
        $builder = $this->db->table($this->table);
        $builder->where('achievement', 'Cancel');
        return $builder->get()->getNumRows();
    }

    public function addProject($data){
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function getProjectList(){
        $builder = $this->db->table($this->table);
        $builder->select("`tb_project`.`id_project`, `tb_project`.`project_name`, `tb_project`.`achievement`, `tb_project`.`project_due_date`, `tb_category`.`category_name`, `tb_department`.`department_name`, `tb_pic`.`name_pic`, `tb_summary_monthly_alter`.`ytd`, CASE WHEN `tb_project`.`achievement`='Cancel' THEN 'Cancel' WHEN `tb_project`.`achievement`='Postpone' THEN 'Postpone' WHEN `tb_summary_monthly_alter`.`ytd` < 100 THEN 'Open' ELSE 'Close' END AS `ach`");
        $builder->join(
            "(SELECT id_project, MAX(ytd) AS ytd FROM `tb_summary_monthly` GROUP BY id_project) AS `tb_summary_monthly_alter`",
            "`tb_project`.`id_project`=`tb_summary_monthly_alter`.`id_project`",
            "left");
        $builder->join("tb_category", "`tb_project`.`id_category` = `tb_category`.`id_category`", "left");
        $builder->join("tb_department", "`tb_project`.`id_department` = `tb_department`.`id_department`", "left");
        $builder->join("tb_pic", "`tb_project`.`id_pic` = `tb_pic`.`id_pic`", "left");

        // $builder->groupStart();
        //     $builder->like('`tb_project`.`id_project`', $request->getPost('search')['value']);
        //     $builder->orLike('`tb_project`.`project_name`', $request->getPost('search')['value']);
        //     $builder->orLike('`tb_project`.`project_due_date`', $request->getPost('search')['value']);
        //     $builder->orLike('`tb_category`.`category_name`', $request->getPost('search')['value']);
        //     $builder->orLike('`tb_department`.`department_name`', $request->getPost('search')['value']);
        //     $builder->orLike('`tb_pic`.`name_pic`', $request->getPost('search')['value']);
        // $builder->groupEnd();

        return $builder->get()->getResultArray();
    }
}