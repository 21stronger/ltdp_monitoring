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

class Project extends CheckerController{
    
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
            $this->updatePerProject($id_project);
            return redirect()->to(base_url('project/detail/'.$id_project));
        } else {
            echo $result;
        }
    }

    public function editProject($idProject){
        $modelProject = new Project_model;
        $modelActivity = new Activity_model;
        $modelMonthly   = new Monthly_activity_model;

        $projectData = $modelProject->find($idProject);
        $projectYear = date('Y', strtotime($projectData['project_due_date']));
        
        $data['project_name']           = $this->request->getPost("projectName");
        $data['project_due_date']       = $this->request->getPost("projectDueDate");
        $data['achievement']            = $this->request->getPost("projectAchievement");
        $data['id_category']            = $this->request->getPost("projectCategory");
        $data['id_department']          = $this->request->getPost("projectDepartment");
        $data['id_pic']                 = $this->request->getPost("projectPic");

        $modelProject->update($idProject, $data);

        $arrIdActivity = $modelActivity
                        ->select('id_activity')
                        ->where('id_project', $idProject)
                        ->findAll();

        //Activity
        $dataYear = date('Y', strtotime($data['project_due_date']));
        if($dataYear>$projectYear){

            $arrayMonthly = array();
            for ($i=$projectYear+1; $i <= $dataYear; $i++) { 

                // Monthly Creator
                foreach ($arrIdActivity as $key => $value) {
                    for ($j=1; $j <= 12; $j++) {
                        $arrData['date_monthly_activity']    = $i.'-'.str_pad($j,2,0,STR_PAD_LEFT).'-01';
                        $arrData['plan_monthly_activity']    = 0;
                        $arrData['actual_monthly_activity']  = 0;
                        $arrData['status_monthly_activity']  = 0;
                        $arrData['id_activity']              = $value['id_activity'];
                        array_push($arrayMonthly, $arrData);
                    }
                }
            }
            $modelMonthly->addBatch($arrayMonthly);
        }else
        // 2022 < 2025
        if($dataYear<$projectYear){

            //2025, 2025 > 2022
            for ($i=$projectYear; $i > $dataYear; $i--) { 
                //Monthly Date Deleter
                $arrIdMonthly  = array();
                foreach ($arrIdActivity as $key => $value) {
                    $data = $modelMonthly
                        ->where('id_activity', $value['id_activity'])
                        ->where("date_monthly_activity LIKE '{$i}%'")
                        ->findAll();
                    foreach ($data as $keyMon => $valueMon) {
                        array_push($arrIdMonthly, $valueMon['id_monthly_activity']);
                    }
                }
                $modelMonthly->delete($arrIdMonthly);
            }
        }

        $this->updatePerProject($idProject);
        return redirect()->back();
    }

    public function editActivities($idActivity){
        $modelActivity      = new Activity_model;
        $modelMonthly       = new Monthly_activity_model;
        $modelViewMonthly   = new View_activity_monthly_model;

        $dataActivity['activity_name']   = $this->request->getPost("activityName");
        $dataActivity['activity_weight'] = $this->request->getPost("activityWeight");
        $dataActivity['activity_plan']   = $this->request->getPost("activityWeight");

        $idProject = $modelActivity->select('id_project')->where('id_activity', $idActivity)->first();

        // Update tb_activity
        $modelActivity->update($idActivity, $dataActivity);

        // Data Activity
        $arrayActDate   = $this->request->getPost("activitiesDate");
        $arrayActPlan   = $this->request->getPost("activitiesWeight");

        // Get Data from db
        $dataActivities = $modelMonthly
                            ->where('id_activity', $idActivity)
                            ->findAll();

        foreach ($dataActivities as $key => &$value) {
            $dataActivities[$key]['plan_monthly_activity'] = 0;
        }

        foreach ($arrayActDate as $keys => $values) {
            $date = date('Y-m', strtotime($values))."-01";

            $index = array_search(
                $date,
                array_column($dataActivities, 'date_monthly_activity'),
                true
            );

            $dataActivities[$index]['plan_monthly_activity'] = $arrayActPlan[$keys];
        }

        $array123 = array();
        foreach($dataActivities as $values1){
            $idMonthly = $values1['id_monthly_activity'];
            $data['plan_monthly_activity'] = $values1['plan_monthly_activity'];

            //array_push($array123, array($idMonthly, $data));
            $modelMonthly->update($idMonthly, $data);
        }

        //echo json_encode(array('sources'=>$dataActivities, 'result'=>$array123));
        $this->updatePerProject($idProject);
        return redirect()->back();
    }

    public function deleteActivity($idActivity){
        $modelActivity      = new Activity_model;
        $modelMonthly       = new Monthly_activity_model;

        $idProject = $modelActivity->select('id_project')->where('id_activity', $idActivity)->first();

        $data['message'] = "success";
        $data['monthlyResult']  = $modelMonthly
                                    ->where('id_activity', $idActivity)
                                    ->delete();

        $data['activityResult'] = $modelActivity
                                    ->where('id_activity', $idActivity)
                                    ->delete();

        $this->updatePerProject($idProject['id_project']);

        echo json_encode($data);
    }


    // Get Function
    public function getActivityMonthly($id_activity){
        $modelMonthly = new View_activity_monthly_model;

        $data = $modelMonthly
            ->where('id_activity', $id_activity)
            ->where('(plan_monthly_activity > 0 OR plan_monthly_activity IS null)')
            ->findAll();

        echo json_encode($data);
    }

    public function getDetailActivity($id_project, $year){
        $modelViewActivity = new View_activity_pivot_model;

        $data = $modelViewActivity
            ->where('id_project', $id_project)
            ->where('(YEAR = '.$year.' OR YEAR IS null)')
            ->orderBy('id_activity', 'asc')
            ->findAll();

        echo json_encode($data);
    }

    public function error404(){
        return view('errors/html/error_404');
    }
}