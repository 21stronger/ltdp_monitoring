<?php

namespace App\Controllers;

use App\Models\Pic_model;
use App\Models\Project_model;
use App\Models\Activity_model;
use App\Models\Category_model;
use App\Models\Department_model;
use App\Models\Monthly_activity_model;

use App\Models\View_project_detail_model;
use App\Models\View_activity_pivot_model;
use App\Models\View_activity_monthly_model;

class Project extends BaseController{
    public function index(){
        $modelPIC = new Pic_model;
        $modelProject = new Project_model;
        $modelCategory = new Category_model;
        $modelDeparment = new Department_model;
        $modelViewProject = new View_project_detail_model;

        $data['headerTitle'] = "Project";
        $data['currentPage'] = "Project";
        $data['dataPics'] = $modelPIC->findAll();
        $data['dataCategories'] = $modelCategory->findAll();
        $data['dateDepartment'] = $modelDeparment->findAll();
        $data['dataProjects'] = $modelViewProject->findAll();

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('project');
        echo view('_partial/footer');
    }

    public function detail($id_project){
        $modelPIC = new Pic_model;
        $modelCategory = new Category_model;
        $modelDeparment = new Department_model;
        $modelViewProject = new View_project_detail_model;
        $modelViewActivity = new View_activity_pivot_model;

        $data['headerTitle'] = "Detail Project";
        $data['currentPage'] = "Project";

        $data['idProject'] = $id_project;
        $data['dataPics'] = $modelPIC->findAll();
        $data['dataCategories'] = $modelCategory->findAll();
        $data['dateDepartment'] = $modelDeparment->findAll();

        $data['dataProject'] = $modelViewProject->find($id_project);
        $data['detailActivity'] = $modelViewActivity
                                    ->where('id_project', $id_project)
                                    ->orderBy('id_activity', 'asc')
                                    ->findAll();

        if(!$data['dataProject']){
            return redirect()->to(base_url('project'));
        }

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('activity');
        echo view('_partial/footer');
    }

    public function addProject(){
        $modelProject = new Project_model;

        $data['project_name']           = $this->request->getPost("projectName");
        $data['project_due_date']       = $this->request->getPost("projectDueDate");
        $data['project_activity_sum']   = 0;
        $data['achievement']            = $this->request->getPost("projectAchievement");
        $data['id_category']            = $this->request->getPost("projectCategory");
        $data['id_department']          = $this->request->getPost("projectDepartment");
        $data['id_pic']                 = $this->request->getPost("projectPic");

        $result = $modelProject->addProject($data);
        if($result){
            return redirect()->to(base_url('project'));
        }
    }

    public function addActivities($id_project){
        $modelActivity = new Activity_model;
        $modelMonthly = new Monthly_activity_model;

        $dataActivity['activity_name']   = $this->request->getPost("activityName");
        $dataActivity['activity_weight'] = $this->request->getPost("activityWeight");
        $dataActivity['activity_plan']   = $this->request->getPost("activityWeight");
        $dataActivity['activity_actual'] = 0;
        $dataActivity['id_project']      = $id_project;

        $idActivity = $modelActivity->addActivity($dataActivity);

        $arrayActDate   = $this->request->getPost("activitiesDate");
        $arrayActPlan   = $this->request->getPost("activitiesWeight");

        for ($i=0; $i < count($arrayActDate); $i++) { 
            $data[$i]['date_monthly_activity']    = $arrayActDate[$i];
            $data[$i]['plan_monthly_activity']    = $arrayActPlan[$i];
            $data[$i]['actual_monthly_activity']  = 0;
            $data[$i]['status_monthly_activity']  = 0;
            $data[$i]['id_activity']              = $idActivity;
        }
        
        $result = $modelMonthly->addBatch($data);
        if($result){
            return redirect()->to(base_url('project/detail/'.$id_project));
        } else {
            echo $result;
        }
    }

    public function editProject($idProject){
        $modelProject = new Project_model;

        $data['project_name']           = $this->request->getPost("projectName");
        $data['project_due_date']       = $this->request->getPost("projectDueDate");
        $data['achievement']            = $this->request->getPost("projectAchievement");
        $data['id_category']            = $this->request->getPost("projectCategory");
        $data['id_department']          = $this->request->getPost("projectDepartment");
        $data['id_pic']                 = $this->request->getPost("projectPic");

        $result = $modelProject->update($idProject, $data);
        if($result){
            return redirect()->back();
        }
    }

    public function getActivityMonthly($id_activity){
        $modelMonthly = new View_activity_monthly_model;

        $data = $modelMonthly
            ->where('id_activity', $id_activity)
            ->findAll();

        echo json_encode($data);
    }

    public function editActivities($idActivity){
        $modelActivity      = new Activity_model;
        $modelMonthly       = new Monthly_activity_model;
        $modelViewMonthly   = new View_activity_monthly_model;

        $dataActivity['activity_name']   = $this->request->getPost("activityName");
        $dataActivity['activity_weight'] = $this->request->getPost("activityWeight");
        $dataActivity['activity_plan']   = $this->request->getPost("activityWeight");

        // Update tb_activity
        $modelActivity->update($idActivity, $dataActivity);


        // Data Monthly Activity
        $dataActivities = $modelViewMonthly
            ->where('id_activity', $idActivity)
            ->findAll();

        $arrayActDate   = $this->request->getPost("activitiesDate");
        $arrayActPlan   = $this->request->getPost("activitiesWeight");

        $countFromBase = count($dataActivities);
        $countFromPost = count($arrayActDate);

        if($countFromBase==$countFromPost){
            for ($i=0; $i < $countFromPost; $i++) { 
                $idMonthly = $dataActivities[$i]['id_monthly_activity'];
                
                $data['date_monthly_activity'] = $arrayActDate[$i]; 
                $data['plan_monthly_activity'] = $arrayActPlan[$i];

                $modelMonthly->update($idMonthly, $data);
            }
            return redirect()->back();
        }

        if($countFromBase>$countFromPost){
            $i=0;
            for (; $i < $countFromPost; $i++) { 
                $idMonthly = $dataActivities[$i]['id_monthly_activity'];

                $data['date_monthly_activity'] = $arrayActDate[$i]; 
                $data['plan_monthly_activity'] = $arrayActPlan[$i];

                $modelMonthly->update($idMonthly, $data);
            }
            for(; $i < $countFromBase; $i++){
                $idMonthly = $dataActivities[$i]['id_monthly_activity'];
                
                $modelMonthly->delete(['id_monthly_activity' => $idMonthly]);
            }
            return redirect()->back();
        }

        if($countFromBase<$countFromPost){
            $i=0;
            for (; $i < $countFromBase; $i++) { 
                $idMonthly = $dataActivities[$i]['id_monthly_activity'];
                
                $data['date_monthly_activity'] = $arrayActDate[$i]; 
                $data['plan_monthly_activity'] = $arrayActPlan[$i];

                $modelMonthly->update($idMonthly, $data);
            }
            for(; $i < $countFromPost; $i++){
                $data['date_monthly_activity']      = $arrayActDate[$i]; 
                $data['plan_monthly_activity']      = $arrayActPlan[$i];
                $data['actual_monthly_activity']    = 0;
                $data['status_monthly_activity']    = 0;
                $data['id_activity']                = $idActivity;

                $modelMonthly->insert($data);
            }
            return redirect()->back();
        }
    }
}