<?php

namespace App\Controllers;

use App\Models\Project_model;
use App\Models\Department_model;
use App\Models\Monthly_activity_model;

use App\Models\View_summary_monthly_model;
use App\Models\View_project_detail_model;
use App\Models\View_activity_pivot_model;

class Update extends BaseController{
    public function index(){
        $modelProject = new Project_model;
        $modelDeparment = new Department_model;
        $modelView = new View_summary_monthly_model;

        $data['headerTitle'] = "Update Project";
        $data['currentPage'] = "Update";
        $data['dateDepartment'] = $modelDeparment->getDepartments();
        $data['dataProjects'] = $modelProject->getProjects();
        $data['dataSummary'] = (session()->get('role')=="Admin")? 
                    $modelView->findAll(): 
                    $modelView->where('name_pic', session()->get('name'))->findAll();

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('update');
        echo view('_partial/footer');
    }

    public function detail($id_project){
        $modelViewProject = new View_project_detail_model;
        $modelViewActivity = new View_activity_pivot_model;

        $data['dataProject'] = $modelViewProject->find($id_project);
        $data['detailActivity'] = $modelViewActivity
                                    ->where('id_project', $id_project)
                                    ->orderBy('id_activity', 'asc')
                                    ->findAll();
        $data['headerTitle'] = "Detail Project";
        $data['currentPage'] = "Update";

        if(!$data['dataProject']){
            return redirect()->to(base_url('update'));
        }
        
        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('detail');
        echo view('_partial/footer');
    }

    public function updateDetail(){
        $modelMonthly = new Monthly_activity_model;

        $id     = $this->request->getPost("idUpdate");
        $data['actual_monthly_activity']    = $this->request->getPost("value");

        $modelMonthly->update($id, $data);
    }
}
