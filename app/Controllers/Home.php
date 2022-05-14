<?php

namespace App\Controllers;

use App\Models\Project_model;
use App\Models\Category_model;
use App\Models\Department_model;

class Home extends BaseController{
    public function index(){
        $modelProject = new Project_model;
        $modelCategory = new Category_model;
        $modelDepartment = new Department_model;

        $dataCategories = $modelCategory->getSummaryByMonth('01');
        $dataDepartments = $modelDepartment->getSummaryByMonth('1');

        $countFaster=0; $countOntime=0; $countOverdue=0;
        foreach ($dataCategories as $value) {
            $countFaster += $value['faster'];
            $countOntime += $value['ontime'];
            $countOverdue +=  $value['overdue'];
        }

        $data['dataDepartments'] = $dataDepartments;
        $data['dataCategories'] = $dataCategories;
        $data['countFaster'] = $countFaster;
        $data['countOntime'] = $countOntime;
        $data['countOverdue'] = $countOverdue;
        $data['countProjectOpen'] = $modelProject->getOpenProject();
        $data['countProjectClose'] = $modelProject->getCloseProject();
        $data['countProjectCancel'] = $modelProject->getCancelProject();
        $data['currentPage'] = "Dashboard";
        $data['headerTitle'] = "Monthly Achievement";
        
        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('dashboard');
        echo view('_partial/footer');
    }

    public function getCategories($month){
        $modelCategory = new Category_model;
        $dataCategories = $modelCategory->getSummaryByMonth($month);
        echo json_encode($dataCategories);
    }

    public function getAchievement($month){
        $modelProject = new Project_model;
        $modelCategory = new Category_model;
        $modelDepartment = new Department_model;

        $data['countOpen'] = $modelProject->getOpenProject();
        $data['countClose'] = $modelProject->getCloseProject();
        $data['countCancel'] = $modelProject->getCancelProject();
        $dataCategories = $modelCategory->getSummaryByMonth($month);
        $dataDepartments = $modelDepartment->getSummaryByMonth($month);

        $countFaster=0; $countOntime=0; $countOverdue=0;
        foreach ($dataCategories as $value) {
            $countFaster += $value['faster'];
            $countOntime += $value['ontime'];
            $countOverdue +=  $value['overdue'];
        }

        $data['countFaster'] = $countFaster;
        $data['countOntime'] = $countOntime;
        $data['countOverdue'] = $countOverdue;
        $data['dataCategories'] = $dataCategories;
        $data['dataDepartments'] = $dataDepartments;
        echo json_encode($data);
    }
}
