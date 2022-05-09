<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Project_model;

class Department extends BaseController{
    public function index(){
        $modelDepartment = new Department_model;
        $modelProject = new Project_model;

        $dataDepartments = $modelDepartment->getSummaryByMonth('1');

        $countFaster=0; $countOntime=0; $countOverdue=0;
        foreach ($dataDepartments as $value) {
            $countFaster += $value['faster'];
            $countOntime += $value['ontime'];
            $countOverdue +=  $value['overdue'];
        }

        $data['dataDepartments'] = $dataDepartments;
        $data['countFaster'] = $countFaster;
        $data['countOntime'] = $countOntime;
        $data['countOverdue'] = $countOverdue;
        $data['countProjectOpen'] = $modelProject->getOpenProject();
        $data['countProjectClose'] = $modelProject->getCloseProject();
        $data['countProjectCancel'] = $modelProject->getCancelProject();
        $data['currentPage'] = "Department";
        $data['headerTitle'] = "Department Achievement";
        
        echo view('_partial\header', $data);
        echo view('_partial\sidebar');
        echo view('department');
        echo view('_partial\footer');
    }
}
