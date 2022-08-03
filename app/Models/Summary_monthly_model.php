<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Summary_monthly_model extends Model{

    protected $table        = 'tb_summary_monthly';
    protected $primaryKey   = 'id_monthly';

    protected $allowedFields = [
        'id_activity',
        'date_monthly',
        'plan',
        'actual',
        'monthly',
        'status',
        'ytd',
        'achievement'
    ];

    public function addBatch($data){
        $builder = $this->db->table($this->table);
        return $builder->insertBatch($data);
    }

    public function saveBatch($data){
        $builder = $this->db->table($this->table);
        return $builder->updateBatch($data, 'id_monthly');
    }
    
    public function deleteAllAndResetAI(){
        $builder = $this->db->table($this->table);
        $deleteStatus = $builder->emptyTable();

        $AIStatus = $this->db->query("ALTER TABLE `tb_summary_monthly` AUTO_INCREMENT = 1");

        return json_encode(array($deleteStatus, $AIStatus));
    }

    public function getAllMonthlyActivities(){
        $builder = $this->db->table("`tb_monthly_activity`");
        $builder->select('
            `tb_project`.`id_project`, 
            `tb_project`.`project_name`, 
            `tb_project`.`achievement`,
            `tb_monthly_activity`.*
        ');
        $builder->join(
            "`tb_activity`", 
            "`tb_activity`.`id_activity` = `tb_monthly_activity`.`id_activity`", 
            "left");
        $builder->join(
            "`tb_project`", 
            "`tb_project`.`id_project` = `tb_activity`.`id_project`", 
            "left");
        $builder->orderBy("`tb_project`.`id_project`, `tb_monthly_activity`.`date_monthly_activity`");
        return $builder->get()->getResultArray();
    }

    public function getMonthlyActivityByIdProject($idProject){
        $builder = $this->db->table("`tb_monthly_activity`");
        $builder->select('
            `tb_project`.`id_project`, 
            `tb_project`.`project_name`, 
            `tb_project`.`achievement`,
            `tb_monthly_activity`.*
        ');
        $builder->join(
            "`tb_activity`", 
            "`tb_activity`.`id_activity` = `tb_monthly_activity`.`id_activity`", 
            "left");
        $builder->join(
            "`tb_project`", 
            "`tb_project`.`id_project` = `tb_activity`.`id_project`", 
            "left");
        $builder->where('`tb_project`.`id_project`', $idProject);
        $builder->orderBy("`tb_project`.`id_project`, `tb_monthly_activity`.`date_monthly_activity`");
        return $builder->get()->getResultArray();
    }
}