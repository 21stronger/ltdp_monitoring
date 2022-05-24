<?php

namespace App\Controllers;

use App\Models\Pica_model;
use App\Models\Project_model;

use App\Models\View_activity_pica_model;

class Pica extends BaseController{
    public function index(){
        echo view('errors/html/error_404');
    }

    public function getPica($idPica){
        $modelViewActivityPica  = new View_activity_pica_model;

        $data = $modelViewActivityPica->where('id_pica', $idPica)->first();

        echo json_encode($data);
    }

    public function addPica($id_project){
        $modelPica  = new Pica_model;
        $modelProject = new Project_model;

        // User Project Validation
        $queryVal = $modelProject->where('id_project', $id_project);
        $queryRes = (session()->get('role')!="Admin")? 
            $queryVal->where('id_pic', session()->get('idPic'))->first():
            $queryVal->first();
        
        if($queryRes==null){
            return redirect()->back();
        }
        // End User Project Validation 

        $data['pica_due_date'] = $this->request->getPost("picaDueDate");
        $data['root_cause'] = $this->request->getPost("rootCause");
        $data['capa']       = $this->request->getPost("capa");
        $data['id_monthly_activity']   = $this->request->getPost("activityMonth");

        $result = $modelPica->insert($data);
        if($result){
            return redirect()->back();
        }
    }

    public function editPica($id_pica){
        $modelPica  = new Pica_model;
        $modelViewActivityPica  = new View_activity_pica_model;

        // User Project Validation
        $queryVal = $modelViewActivityPica->where('id_pica', $id_pica);
        $queryRes = (session()->get('role')!="Admin")? 
            $queryVal->where('id_pic', session()->get('idPic'))->first():
            $queryVal->first();
        
        if($queryRes==null){
            return redirect()->back();
        }
        // End User Project Validation 

        $data['pica_due_date']      = $this->request->getPost("picaDueDate");
        $data['root_cause']         = $this->request->getPost("rootCause");
        $data['capa']               = $this->request->getPost("capa");
        $data['id_monthly_activity']= $this->request->getPost("activityMonth");

        $result = $modelPica->update($id_pica, $data);
        if($result){
            return redirect()->back();
        }
    }
}