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
                WHERE `vw_summary_category_pivot`.`date_monthly_activity` LIKE '2022-".$month."%') summary", 
            "`tb_category`.`category_name`=`summary`.`category_name`", 
            "left");
        return $builder->get()->getResultArray();
    }
}