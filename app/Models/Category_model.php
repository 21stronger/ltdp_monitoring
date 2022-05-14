<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Category_model extends Model{

    protected $table        = 'tb_category';
    protected $primaryKey   = 'id_category';
 
    public function getCategories(){
       return $this->findAll();
    }

    public function addCategory($data){
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editCategory($id_category, $data){
        $builder = $this->db->table($this->table);
        $builder->where($primaryKey, $id_category);
        $builder->update($data);
    }

    public function deleteCategory($id_category){
        $builder = $this->db->table($this->table);
        return $builder->delete($id_category);
    }

    // public function getSummaryByMonth1($date){
    //     $builder = $this->db->table($this->table);
    //     $builder->select('tb_category.*, COUNT(IF(vw_summary_monthly.ach>1, 1, null)) AS faster, COUNT(IF(vw_summary_monthly.ach=1, 1, null)) AS ontime, COUNT(IF(vw_summary_monthly.ach<1, 1, null)) AS overdue');
    //     $builder->join('vw_summary_monthly', 'tb_category.category_name=vw_summary_monthly.category_name', 'left');
    //     $builder->where("vw_summary_monthly.date_monthly_activity='2022-01-01' OR vw_summary_monthly.date_monthly_activity is null");
    //     $builder->groupBy('`tb_category`.id_category');
    //     return $builder->get()->getResultArray();
    // }

    public function getSummaryByMonth($month){
        $builder = $this->db->table($this->table);
        $builder->select('
        `tb_category`.`id_category`, 
        `tb_category`.`category_name`, 
        `summary`.`date_monthly_activity`, 
        COALESCE(`summary`.`overdue`, 0) AS overdue, 
        COALESCE(`summary`.`ontime`, 0) AS ontime, 
        COALESCE(`summary`.`faster`, 0) AS faster');
        $builder->join(
            "(SELECT * FROM `vw_summary_category_pivot` 
                WHERE `vw_summary_category_pivot`.`date_monthly_activity`='2022-".$month."-01') summary", 
            "`tb_category`.`category_name`=`summary`.`category_name`", 
            "left");
        return $builder->get()->getResultArray();
    }
}