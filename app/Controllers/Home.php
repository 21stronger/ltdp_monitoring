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
}


// Add Project Tahun 2021

// Graph perbaikan
// Profile, Name, Department, Extention

// PIC berdasarkan dept

// Reminder

// Halaman Department, Category
// Navbar, Department
// Penanda Project kosong
// Project belum sikron
// Grafik YTD Ach per PIC
// Yearly Report Di full

// SELECT * FROM `vw_summary_monthly` dipercepat

// email, PIC, Surename, Password pada tabel 
// Supervisor Update

// Penjumlahan Weight, Limit input
// perhitungan koma koma

// DONE
// Cancel dan Postpone belum muncul di update
// Detail Achievement belum sinkron