<?php

namespace App\Controllers;

use App\Models\Project_model;
use App\Models\Category_model;
use App\Models\Department_model;

use App\Models\View_summary_yearly_model;
use App\Models\View_summary_monthly_project_model;

class Home extends BaseController{
    public function index(){
        $modelProject = new Project_model;
        $modelCategory = new Category_model;
        $modelDepartment = new Department_model;

        $data['dataDepartments'] = $modelDepartment->findAll();
        $data['countProjectOpen'] = $modelProject->getOpenProject();
        $data['countProjectClose'] = $modelProject->getCloseProject();
        $data['countProjectCancel'] = $modelProject->getCancelProject();
        $data['currentPage'] = "Dashboard";
        $data['headerTitle'] = "Dashboard";
        
        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('dashboard');
        echo view('_partial/footer');
    }

    public function ytd($monthFilter){
        $date = date('Y').'-'.$monthFilter.'-01';


        $modelCategory  = new Category_model;
        $modelDeparment = new Department_model;

        $modelSummaryMonthly = new View_summary_monthly_project_model;


        $dataCategories = $modelSummaryMonthly->getYTDCategoryByMonth($date);
        $dataDepartments = $modelSummaryMonthly->getYTDDepartmentByMonth($date);


        $dataProject = $modelSummaryMonthly->getProjectByMonth($date);

        $projectOpen = array_keys(
                          array_column($dataProject, 'achievement'), 
                          'Open'
                        );
        $projectClose = array_keys(
                          array_column($dataProject, 'achievement'), 
                          'Close'
                        );
        $projectCancel = array_keys(
                          array_column($dataProject, 'achievement'), 
                          'Cancel'
                        );
        $projectPostpone = array_keys(
                          array_column($dataProject, 'achievement'), 
                          'Postpone'
                        );

        $projectOverdue = array_keys(
                          array_column($dataProject, 'status'), 
                          'Overdue'
                        );
        $projectOntime = array_keys(
                          array_column($dataProject, 'status'), 
                          'Ontime'
                        );
        $projectFaster = array_keys(
                          array_column($dataProject, 'status'), 
                          'Faster'
                        );

        $data['overdue'] = count($projectOverdue);
        $data['ontime'] = count($projectOntime);
        $data['faster'] = count($projectFaster);
        $data['open'] = count($projectOpen);
        $data['close'] = count($projectClose);
        $data['cancel'] = count($projectCancel);
        $data['postpone'] = count($projectPostpone);
        $data['dataCategories'] = $dataCategories;
        $data['dataDepartments'] = $dataDepartments;

        echo json_encode($data);
    }

    public function getYearlyChartData(){
        $modelViewYearlyChart = new View_summary_yearly_model;

        $dateMonth = date('n');

        $dataChart = $modelViewYearlyChart
            ->like('date_monthly', date('Y'))
            ->get()
            ->getResult();

        $sumActual = 0;
        $sumPlan = 0;
        $month = array('Dec','Nov','Oct','Sep','Aug','Jul',
                    'Jun','May','Apr','Mar','Feb','Jan','YTD');
        $result = array(
                    array('ach', 'month')
                  );

        $sum = 0;
        foreach ($dataChart as $key => $value) {
            $ach = ($value->sumActual/$value->sumPlan)*100;
            if($key>=(12-$dateMonth)){
                $sum += $ach;
                $data = array(
                    number_format($ach, 1), 
                    $month[$key]
                );
            } else {
                $data = array(
                    0,
                    $month[$key]
                );
            }

            array_push($result, $data);
        }

        $data = array(number_format($sum/$dateMonth, 1), 'YTD');
        array_push($result, $data);

        echo json_encode($result);
    }

    public function achPicPerDept($monthFilter, $deptFilter){
        $date = date('Y').'-'.$monthFilter.'-01';

        $modelSummaryMonthly = new View_summary_monthly_project_model;

        $result = $modelSummaryMonthly->getAchPicPerDept($date, $deptFilter);

        echo json_encode($result);
    }
}
