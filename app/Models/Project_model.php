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

    // public function editProject($id_project, $data){
    //     $builder = $this->db->table($this->table);
    //     return $builder->update($id_project, $data);
    // }

    // public function deleteProject($id_project){
    //     $builder = $this->db->table($this->table);
    //     return $builder->delete($id_project);
    // }
}