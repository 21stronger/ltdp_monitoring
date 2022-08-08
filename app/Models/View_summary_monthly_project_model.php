<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class View_summary_monthly_project_model extends Model{

    protected $table = 'vw_summary_monthly_project';

    public function getProjectDetail($idProject){
        $yearMonth = date('Y-m');

        $builder = $this->db->table($this->table);
        $builder->select('achievement, project_name, project_due_date, category_name, department_name, name_pic');
        $builder->where('id_project', $idProject);
        $builder->like('date_monthly', $yearMonth);
        $result = $builder->get()->getResultArray();
        return $result[0];
    }

    public function getProjectByMonth($date){
        $builder = $this->db->table($this->table);
        $builder->where('date_monthly', $date);
        $builder->orderBy('`vw_summary_monthly_project`.`id_project`', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getProjectByMonthAndPic($date, $pic){
        $builder = $this->db->table($this->table);
        $builder->where('date_monthly', $date);
        $builder->where();
        $builder->orderBy('`vw_summary_monthly_project`.`id_project`', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getAchPicPerDept($date, $dept){
        $builder = $this->db->table($this->table);
        $builder->select('department_name, name_pic, AVG(monthly) AS percentage');
        $builder->where('date_monthly', $date);
        $builder->where('department_name', $dept);
        $builder->where("achievement <> 'Cancel'");
        $builder->where("achievement <> 'Postpone'");
        $builder->groupBy(['department_name', 'name_pic']);
        $builder->orderBy('department_name');
        return $builder->get()->getResultArray();  
    }

    public function getYTDDepartmentByMonth($date){
        $builder = $this->db->table('tb_department');
        $builder->select("
            `tb_department`.*,
            (CASE WHEN a.Overdue IS NOT null THEN a.Overdue ELSE 0 END) AS overdueDepartment,
            (CASE WHEN a.Ontime IS NOT null THEN a.Ontime ELSE 0 END) AS ontimeDepartment,
            (CASE WHEN a.Faster IS NOT null THEN a.Faster ELSE 0 END) AS fasterDepartment");
        $builder->join("
            (SELECT `vw_summary_monthly_project`.`department_name`,
            SUM(CASE WHEN `status`='Overdue' THEN 1 ELSE 0 END) AS Overdue,
            SUM(CASE WHEN `status`='Ontime' THEN 1 ELSE 0 END) AS Ontime,
            SUM(CASE WHEN `status`='Faster' THEN 1 ELSE 0 END) AS Faster
            FROM `vw_summary_monthly_project` 
            WHERE `vw_summary_monthly_project`.`date_monthly`='{$date}' AND (`vw_summary_monthly_project`.`achievement`='Open' OR `vw_summary_monthly_project`.`achievement`='Close')
            GROUP BY `vw_summary_monthly_project`.`department_name`
            ORDER BY `vw_summary_monthly_project`.`id_project`) a", 
            "a.`department_name`=`tb_department`.`department_name`", "left");
        return $builder->get()->getResultArray();
    }

    public function getYTDCategoryByMonth($date){
        $builder = $this->db->table('tb_category');
        $builder->select("
            `tb_category`.`id_category` AS idCategory,
            `tb_category`.`category_name` AS nameCategory,
            (CASE WHEN a.Overdue IS NOT null THEN a.Overdue ELSE 0 END) AS overdueCategory,
            (CASE WHEN a.Ontime IS NOT null THEN a.Ontime ELSE 0 END) AS ontimeCategory,
            (CASE WHEN a.Faster IS NOT null THEN a.Faster ELSE 0 END) AS fasterCategory");
        $builder->join("
            (SELECT `vw_summary_monthly_project`.`category_name`,
            SUM(CASE WHEN `status`='Overdue' THEN 1 ELSE 0 END) AS Overdue,
            SUM(CASE WHEN `status`='Ontime' THEN 1 ELSE 0 END) AS Ontime,
            SUM(CASE WHEN `status`='Faster' THEN 1 ELSE 0 END) AS Faster
            FROM `vw_summary_monthly_project` 
            WHERE `vw_summary_monthly_project`.`date_monthly`='{$date}' AND (`vw_summary_monthly_project`.`achievement`='Open' OR `vw_summary_monthly_project`.`achievement`='Close')
            GROUP BY `vw_summary_monthly_project`.`category_name`
            ORDER BY `vw_summary_monthly_project`.`id_project`) a", 
            "a.`category_name`=`tb_category`.`category_name`", "left");
        return $builder->get()->getResultArray();
    }
}