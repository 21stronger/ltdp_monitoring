<?php
 
namespace App\Models;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Session\SessionInterface;
use CodeIgniter\Model;
 
class View_summary_monthly_project_alter_model extends Model{

    protected $table = 'vw_summary_monthly_project';
    protected $column_search = ['id_project', 'date_monthly', 'monthly', 'status', 'ytd', 'project_name', 'project_due_date', 'category_name', 'department_name', 'name_pic', 'achievement'];

    public function __construct(RequestInterface $request, SessionInterface $session){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);

        $this->session = $session;
    }

    private function getDatatablesQuery(){
        $status = $this->request->getPost('form')[1]['value'];
        ($status!=null)? 
            $this->dt->like('status', $status): '';

        $this->dt->like('date_monthly', date('Y').'-'.$this->request->getPost('form')[0]['value']);
        $this->dt->like('achievement', $this->request->getPost('form')[2]['value']);
        $this->dt->like('department_name', $this->request->getPost('form')[3]['value']);
        
        if($this->session->get('role')=="User"){
            $this->dt->like('name_pic', $this->session->get('name'));
        }
        if($this->session->get('role')=="Supervisor"){
            $this->dt->like('department_name', $this->session->get('nameDept'));
        }

        $this->dt->groupStart();
            $this->dt->like('id_project', $this->request->getPost('search')['value']);
            $this->dt->orLike('project_name', $this->request->getPost('search')['value']);
            $this->dt->orLike('category_name', $this->request->getPost('search')['value']);
            $this->dt->orLike('department_name', $this->request->getPost('search')['value']);
            $this->dt->orLike('name_pic', $this->request->getPost('search')['value']);
            $this->dt->orLike('monthly', $this->request->getPost('search')['value']);
            $this->dt->orLike('status', $this->request->getPost('search')['value']);
            $this->dt->orLike('ytd', $this->request->getPost('search')['value']);
            $this->dt->orLike('achievement', $this->request->getPost('search')['value']);
        $this->dt->groupEnd();

        $this->dt->orderBy('id_project', 'ASC');
    }

    function getDatatables(){
        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit(
                $this->request->getPost('length'), 
                $this->request->getPost('start')
            );
        $query = $this->dt->get();
        return $query->getResult();
    }

    function countFiltered(){
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll(){
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}