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

        $data['headerTitle'] = "Detail Project";
        $data['currentPage'] = "Project";

        $data['idProject'] = $id_project;
        $data['dataPics'] = $modelPIC->findAll();
        $data['dataCategories'] = $modelCategory->findAll();
        $data['dateDepartment'] = $modelDeparment->findAll();

        $data['dataProject'] = $modelViewProject->find($id_project);

        $yearOptions = array();
        $thisYear = date('Y');
        $projectDueYear = date('Y', strtotime($data['dataProject']['project_due_date']));
        for ($i=$thisYear; $i <= $projectDueYear; $i++) {
            array_push($yearOptions, $i);
        }
        $data['yearOptions'] = $yearOptions;

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
        $modelProject = new Project_model;
        $modelActivity = new Activity_model;

        $modelMonthly = new Monthly_activity_model;

        // Year counter
        $detailProject = $modelProject->find($id_project);
        $dueDateProject = $detailProject['project_due_date'];

        $dataActivity['activity_name']   = $this->request->getPost("activityName");
        $dataActivity['activity_weight'] = $this->request->getPost("activityWeight");
        $dataActivity['activity_plan']   = $this->request->getPost("activityWeight");
        $dataActivity['activity_actual'] = 0;
        $dataActivity['id_project']      = $id_project;

        $idActivity = $modelActivity->addActivity($dataActivity);

        $arrayActDate   = $this->request->getPost("activitiesDate");
        $arrayActPlan   = $this->request->getPost("activitiesWeight");

        $arrayMonthly = array();
        for ($i=date('Y'); $i <= date('Y', strtotime($dueDateProject)); $i++) { 
            for ($j=1; $j <= 12; $j++) {
                $arrData['date_monthly_activity']    = $i.'-'.str_pad($j,2,0,STR_PAD_LEFT).'-01';
                $arrData['plan_monthly_activity']    = 0;
                $arrData['actual_monthly_activity']  = 0;
                $arrData['status_monthly_activity']  = 0;
                $arrData['id_activity']              = $idActivity;
                array_push($arrayMonthly, $arrData);
            }
        }

        for ($i=0; $i < count($arrayActDate); $i++) { 
            $date = date('Y-m', strtotime($arrayActDate[$i])).'-01';

            $index = array_search($date, 
                    array_column($arrayMonthly, 'date_monthly_activity'), 
                    true);

            $arrayMonthly[$index]['date_monthly_activity'] = $date;
            $arrayMonthly[$index]['plan_monthly_activity'] = $arrayActPlan[$i];
        }
        $data = $arrayMonthly;
        
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

        $activitiesData = $modelViewMonthly
            ->where('id_activity', $idActivity)
            ->where('plan_monthly_activity > 0')
            ->findAll();

        $arrayActDate   = $this->request->getPost("activitiesDate");
        $arrayActPlan   = $this->request->getPost("activitiesWeight");

        $countFromBase = count($activitiesData);
        $countFromPost = count($arrayActDate);

        $arrChangedDataIndex = array();
        for ($i=0; $i < count($arrayActDate); $i++) { 
            $date = date('Y-m', strtotime($arrayActDate[$i])).'-01';

            $index = array_search($date, 
                    array_column($dataActivities, 'date_monthly_activity'), 
                    true);

            $idMonthly = $dataActivities[$index]['id_monthly_activity'];
            array_push($arrChangedDataIndex, $idMonthly);

            $data['plan_monthly_activity'] = $arrayActPlan[$i];

            $modelMonthly->update($idMonthly, $data);
        }

        if($countFromBase<=$countFromPost){
            return redirect()->back();
        }

        $arrDiff = array_diff(array_column($activitiesData, 'id_monthly_activity'),
                            $arrChangedDataIndex
                            );

        foreach ($arrDiff as $key => $value) {
            $data['plan_monthly_activity'] = 0;

            $modelMonthly->update($value, $data);
        }
        return redirect()->back();
    }

    public function deleteActivity($idActivity){
        $modelActivity      = new Activity_model;
        $modelMonthly       = new Monthly_activity_model;

        $data['message'] = "success";
        $data['monthlyResult']  = $modelMonthly
                                    ->where('id_activity', $idActivity)
                                    ->delete();

        $data['activityResult'] = $modelActivity
                                    ->where('id_activity', $idActivity)
                                    ->delete();

        echo json_encode($data);
    }


    // Get Function
    public function getActivityMonthly($id_activity){
        $modelMonthly = new View_activity_monthly_model;

        $data = $modelMonthly
            ->where('id_activity', $id_activity)
            ->where('plan_monthly_activity > 0')
            ->findAll();

        echo json_encode($data);
    }

    public function getDetailActivity($id_project, $year){
        $modelViewActivity = new View_activity_pivot_model;

        $data = $modelViewActivity
            ->where('id_project', $id_project)
            ->where('YEAR', $year)
            ->orderBy('id_activity', 'asc')
            ->findAll();

        echo json_encode($data);
    }

    public function error404(){
        return view('errors/html/error_404');
    }
}