<?php

namespace App\Controllers;

use App\Models\Project_model;
use App\Models\Category_model;
use App\Models\Department_model;

use App\Models\View_ytd_achievement_model;

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

    // Perlu banyak penyempurnaan
    public function ytd($monthFilter){
        $modelCategory  = new Category_model;
        $modelDeparment = new Department_model;
        $modelYtdAch    = new View_ytd_achievement_model;

        $arrCategories  = $modelCategory->findAll();
        $dataCategories = array();
        for ($i=0; $i < count($arrCategories); $i++) { 
          $dataCategories[$i]['idCategory']     = $arrCategories[$i]['id_category'];
          $dataCategories[$i]['nameCategory']   = $arrCategories[$i]['category_name'];
          $dataCategories[$i]['fasterCategory'] = 0;
          $dataCategories[$i]['ontimeCategory'] = 0;
          $dataCategories[$i]['overdueCategory']= 0;
        }

        $arrDepartment  = $modelDeparment->findAll();
        $dataDepartments= array();
        for ($i=0; $i < count($arrDepartment); $i++) { 
          $dataDepartments[$i]['id_department']     = $arrDepartment[$i]['id_department'];
          $dataDepartments[$i]['department_name']   = $arrDepartment[$i]['department_name'];
          $dataDepartments[$i]['fasterDepartment'] = 0;
          $dataDepartments[$i]['ontimeDepartment'] = 0;
          $dataDepartments[$i]['overdueDepartment']= 0;
        }

        $data = $modelYtdAch->findAll();

        $totalProject = 0;
        $idBefore   = 0;
        $monthlyPlanAch    = 0;
        $monthlyActuAch  = 0;
        $newData = array();
        for ($i=0; $i < count($data); $i++) { 
          $diff         = ($idBefore==$data[$i]['id_project'])? true: false;
          $totalProject = ($idBefore==$data[$i]['id_project'])? $totalProject+0: $totalProject+1;
          $totalProject = ($data[$i]['date_monthly_activity']=='2023-01-01')? $totalProject+1: $totalProject+0;
          $totalProject = ($data[$i]['date_monthly_activity']=='2024-01-01')? $totalProject+1: $totalProject+0;

          $monthlyPlanAch = ($diff)? 
                      $monthlyPlanAch+$data[$i]['sumPlan']: 
                      $data[$i]['sumPlan'];
          $monthlyActuAch = ($diff)? 
                      $monthlyActuAch+$data[$i]['sumActual']: 
                      $data[$i]['sumActual'];
          $idBefore=$data[$i]['id_project'];

          $newData[$i]['id_project']      = $data[$i]['id_project'];
          $newData[$i]['id_category']     = $data[$i]['id_category'];
          $newData[$i]['id_department']     = $data[$i]['id_department'];
          $newData[$i]['date_monthly_activity']  = $data[$i]['date_monthly_activity'];
          $newData[$i]['sumPlan']         = $data[$i]['sumPlan'];
          $newData[$i]['sumActual']       = $data[$i]['sumActual'];
          $newData[$i]['achievement']     = $data[$i]['achievement'];
          $newData[$i]['monthlyPlanAch']  = $monthlyPlanAch;
          $newData[$i]['monthlyActuAch']  = $monthlyActuAch;
        }

        $newNewData = array();
        $indexOld = 0;
        $indexNew = 0;
        for ($i=0; $i < $totalProject; $i++) { 
          $firstMonth = date('n', strtotime($newData[$indexOld]['date_monthly_activity']));
          for($j=1; $j <= 12; $j++){
            $month = date('n', strtotime($newData[$indexOld]['date_monthly_activity']));
            $time = mktime(0, 0, 0, $j, 1, date('Y', strtotime($newData[$indexOld]['date_monthly_activity'])));

            if($newData[$indexOld]['achievement']=='Cancel'){
              $newNewData[$indexNew]['id_project']      = $newData[$indexOld]['id_project'];
              $newNewData[$indexNew]['id_category']     = $newData[$indexOld]['id_category'];
              $newNewData[$indexNew]['id_department']     = $newData[$indexOld]['id_department'];
              $newNewData[$indexNew]['date_monthly_activity']  = date('Y-m-d', $time);
              $newNewData[$indexNew]['sumPlan']         = $newData[$indexOld]['sumPlan'];
              $newNewData[$indexNew]['sumActual']       = $newData[$indexOld]['sumActual'];
              $newNewData[$indexNew]['monthlyPlanAch']  = $newData[$indexOld]['monthlyPlanAch'];
              $newNewData[$indexNew]['monthlyActuAch']  = $newData[$indexOld]['monthlyActuAch'];
              $newNewData[$indexNew]['faster']  = 0;
              $newNewData[$indexNew]['ontime']  = 0;
              $newNewData[$indexNew]['overdue'] = 0;
              $newNewData[$indexNew]['close']   = 0;
              $newNewData[$indexNew]['open']    = 0;
              $newNewData[$indexNew]['cancel']  = 1;
              $newNewData[$indexNew]['postpone']= 0;

              $indexOld = ($indexOld<count($newData)-1)? $indexOld+1: $indexOld;
              $indexNew++;
              continue;
            }

            if($newData[$indexOld]['achievement']=='Postpone'){
              $newNewData[$indexNew]['id_project']      = $newData[$indexOld]['id_project'];
              $newNewData[$indexNew]['id_category']     = $newData[$indexOld]['id_category'];
              $newNewData[$indexNew]['id_department']     = $newData[$indexOld]['id_department'];
              $newNewData[$indexNew]['date_monthly_activity']  = date('Y-m-d', $time);
              $newNewData[$indexNew]['sumPlan']         = $newData[$indexOld]['sumPlan'];
              $newNewData[$indexNew]['sumActual']       = $newData[$indexOld]['sumActual'];
              $newNewData[$indexNew]['monthlyPlanAch']  = $newData[$indexOld]['monthlyPlanAch'];
              $newNewData[$indexNew]['monthlyActuAch']  = $newData[$indexOld]['monthlyActuAch'];
              $newNewData[$indexNew]['faster']  = 0;
              $newNewData[$indexNew]['ontime']  = 0;
              $newNewData[$indexNew]['overdue'] = 0;
              $newNewData[$indexNew]['close']   = 0;
              $newNewData[$indexNew]['open']    = 0;
              $newNewData[$indexNew]['cancel']  = 0;
              $newNewData[$indexNew]['postpone']= 1;

              $indexOld = ($indexOld<count($newData)-1)? $indexOld+1: $indexOld;
              $indexNew++;
              continue;
            }

            if($month==$j){
              $newNewData[$indexNew]['id_project']      = $newData[$indexOld]['id_project'];
              $newNewData[$indexNew]['id_category']     = $newData[$indexOld]['id_category'];
              $newNewData[$indexNew]['id_department']     = $newData[$indexOld]['id_department'];
              $newNewData[$indexNew]['date_monthly_activity']  = date('Y-m-d', $time);
              $newNewData[$indexNew]['sumPlan']         = $newData[$indexOld]['sumPlan'];
              $newNewData[$indexNew]['sumActual']       = $newData[$indexOld]['sumActual'];
              $newNewData[$indexNew]['monthlyPlanAch']  = $newData[$indexOld]['monthlyPlanAch'];
              $newNewData[$indexNew]['monthlyActuAch']  = $newData[$indexOld]['monthlyActuAch'];
              switch(true){
                case ($newData[$indexOld]['monthlyActuAch']>$newData[$indexOld]['monthlyPlanAch']):
                  $newNewData[$indexNew]['faster']  = 1;
                  $newNewData[$indexNew]['ontime']  = 0;
                  $newNewData[$indexNew]['overdue'] = 0;
                  break;
                
                case ($newData[$indexOld]['monthlyActuAch']==$newData[$indexOld]['monthlyPlanAch']):
                  $newNewData[$indexNew]['faster']  = 0;
                  $newNewData[$indexNew]['ontime']  = 1;
                  $newNewData[$indexNew]['overdue'] = 0;
                  break;
                
                case ($newData[$indexOld]['monthlyActuAch']<$newData[$indexOld]['monthlyPlanAch']):
                  $newNewData[$indexNew]['faster']  = 0;
                  $newNewData[$indexNew]['ontime']  = 0;
                  $newNewData[$indexNew]['overdue'] = 1;
                  break;
                
                default:
                  $newNewData[$indexNew]['faster']  = 0;
                  $newNewData[$indexNew]['ontime']  = 0;
                  $newNewData[$indexNew]['overdue'] = 0;
                  break;
              }
              switch(true){
                case ($newData[$indexOld]['monthlyActuAch']==100&&
                  $newData[$indexOld]['monthlyPlanAch']==100):
                  $newNewData[$indexNew]['close']   = 1;
                  $newNewData[$indexNew]['open']    = 0;
                  $newNewData[$indexNew]['cancel']  = 0;
                  $newNewData[$indexNew]['postpone']= 0;
                  break;

                case ($newData[$indexOld]['monthlyActuAch']<100&&
                  $newData[$indexOld]['monthlyPlanAch']<=100):
                  $newNewData[$indexNew]['close']   = 0;
                  $newNewData[$indexNew]['open']    = 1;
                  $newNewData[$indexNew]['cancel']  = 0;
                  $newNewData[$indexNew]['postpone']= 0;
                  break;

                default:
                  $newNewData[$indexNew]['close']   = 0;
                  $newNewData[$indexNew]['open']    = 0;
                  $newNewData[$indexNew]['cancel']  = 0;
                  $newNewData[$indexNew]['postpone']= 0;
                  break;
              }
              $indexOld = ($indexOld<count($newData)-1)? $indexOld+1: $indexOld;
            } else {
              if($indexOld==count($data)-1){
                $newNewData[$indexNew]['id_project']      = $newData[$indexOld]['id_project'];
                $newNewData[$indexNew]['id_category']     = $newData[$indexOld]['id_category'];
                $newNewData[$indexNew]['id_department']     = $newData[$indexOld]['id_department'];
                $newNewData[$indexNew]['date_monthly_activity']  = date('Y-m-d', $time);
                $newNewData[$indexNew]['sumPlan']         = 0;
                $newNewData[$indexNew]['sumActual']       = 0;
                $newNewData[$indexNew]['monthlyPlanAch']  = $newData[$indexOld]['monthlyPlanAch'];
                $newNewData[$indexNew]['monthlyActuAch']  = $newData[$indexOld]['monthlyActuAch'];
                switch (true) {
                  case ($newData[$indexOld]['monthlyActuAch']>$newData[$indexOld]['monthlyPlanAch']):
                    $newNewData[$indexNew]['faster']  = 1;
                    $newNewData[$indexNew]['ontime']  = 0;
                    $newNewData[$indexNew]['overdue'] = 0;
                    break;
                  
                  case ($newData[$indexOld]['monthlyActuAch']==$newData[$indexOld]['monthlyPlanAch']):
                    $newNewData[$indexNew]['faster']  = 0;
                    $newNewData[$indexNew]['ontime']  = 1;
                    $newNewData[$indexNew]['overdue'] = 0;
                    break;
                  
                  case ($newData[$indexOld]['monthlyActuAch']<$newData[$indexOld]['monthlyPlanAch']):
                    $newNewData[$indexNew]['faster']  = 0;
                    $newNewData[$indexNew]['ontime']  = 0;
                    $newNewData[$indexNew]['overdue'] = 1;
                    break;
                  
                  default:
                    $newNewData[$indexNew]['faster']  = 0;
                    $newNewData[$indexNew]['ontime']  = 0;
                    $newNewData[$indexNew]['overdue'] = 0;
                    break;
                }
                switch(true){
                  case ($newData[$indexOld]['monthlyActuAch']==100&&
                    $newData[$indexOld]['monthlyPlanAch']==100):
                    $newNewData[$indexNew]['close']   = 1;
                    $newNewData[$indexNew]['open']    = 0;
                    $newNewData[$indexNew]['cancel']  = 0;
                    $newNewData[$indexNew]['postpone']= 0;
                    break;

                  case ($newData[$indexOld]['monthlyActuAch']<100&&
                    $newData[$indexOld]['monthlyPlanAch']<=100):
                    $newNewData[$indexNew]['close']   = 0;
                    $newNewData[$indexNew]['open']    = 1;
                    $newNewData[$indexNew]['cancel']  = 0;
                    $newNewData[$indexNew]['postpone']= 0;
                    break;

                  default:
                    $newNewData[$indexNew]['close']   = 0;
                    $newNewData[$indexNew]['open']    = 0;
                    $newNewData[$indexNew]['cancel']  = 0;
                    $newNewData[$indexNew]['postpone']= 0;
                    break;
                }
              } else
              if($j<$firstMonth){
                $newNewData[$indexNew]['id_project']      = $newData[$indexOld]['id_project'];
                $newNewData[$indexNew]['id_category']     = $newData[$indexOld]['id_category'];
                $newNewData[$indexNew]['id_department']     = $newData[$indexOld]['id_department'];
                $newNewData[$indexNew]['date_monthly_activity']  = date('Y-m-d', $time);
                $newNewData[$indexNew]['sumPlan']         = 0;
                $newNewData[$indexNew]['sumActual']       = 0;
                $newNewData[$indexNew]['monthlyPlanAch']  = 0;
                $newNewData[$indexNew]['monthlyActuAch']  = 0;
                $newNewData[$indexNew]['faster']  = 0;
                $newNewData[$indexNew]['ontime']  = 1;
                $newNewData[$indexNew]['overdue'] = 0;
                $newNewData[$indexNew]['close']   = 0;
                $newNewData[$indexNew]['open']    = 1;
                $newNewData[$indexNew]['cancel']  = 0;
                $newNewData[$indexNew]['postpone']= 0;
              } else {
                $newNewData[$indexNew]['id_project']      = $newData[$indexOld-1]['id_project'];
                $newNewData[$indexNew]['id_category']     = $newData[$indexOld-1]['id_category'];
                $newNewData[$indexNew]['id_department']     = $newData[$indexOld-1]['id_department'];
                $newNewData[$indexNew]['date_monthly_activity']  = date('Y-m-d', $time);
                $newNewData[$indexNew]['sumPlan']         = 0;
                $newNewData[$indexNew]['sumActual']       = 0;
                $newNewData[$indexNew]['monthlyPlanAch']  = $newData[$indexOld-1]['monthlyPlanAch'];
                $newNewData[$indexNew]['monthlyActuAch']  = $newData[$indexOld-1]['monthlyActuAch'];
                switch (true) {
                  case ($newData[$indexOld-1]['monthlyActuAch']>$newData[$indexOld-1]['monthlyPlanAch']):
                    $newNewData[$indexNew]['faster']  = 1;
                    $newNewData[$indexNew]['ontime']  = 0;
                    $newNewData[$indexNew]['overdue'] = 0;
                    break;
                  
                  case ($newData[$indexOld-1]['monthlyActuAch']==$newData[$indexOld-1]['monthlyPlanAch']):
                    $newNewData[$indexNew]['faster']  = 0;
                    $newNewData[$indexNew]['ontime']  = 1;
                    $newNewData[$indexNew]['overdue'] = 0;
                    break;
                  
                  case ($newData[$indexOld-1]['monthlyActuAch']<$newData[$indexOld-1]['monthlyPlanAch']):
                    $newNewData[$indexNew]['faster']  = 0;
                    $newNewData[$indexNew]['ontime']  = 0;
                    $newNewData[$indexNew]['overdue'] = 1;
                    break;
                  
                  default:
                    $newNewData[$indexNew]['faster']  = 0;
                    $newNewData[$indexNew]['ontime']  = 0;
                    $newNewData[$indexNew]['overdue'] = 0;
                    break;
                }
                switch(true){
                  case ($newData[$indexOld-1]['monthlyActuAch']==100&&
                    $newData[$indexOld-1]['monthlyPlanAch']==100):
                    $newNewData[$indexNew]['close']   = 1;
                    $newNewData[$indexNew]['open']    = 0;
                    $newNewData[$indexNew]['cancel']  = 0;
                    $newNewData[$indexNew]['postpone']= 0;
                    break;

                  case ($newData[$indexOld-1]['monthlyActuAch']<100&&
                    $newData[$indexOld-1]['monthlyPlanAch']<=100):
                    $newNewData[$indexNew]['close']   = 0;
                    $newNewData[$indexNew]['open']    = 1;
                    $newNewData[$indexNew]['cancel']  = 0;
                    $newNewData[$indexNew]['postpone']= 0;
                    break;

                  default:
                    $newNewData[$indexNew]['close']   = 0;
                    $newNewData[$indexNew]['open']    = 0;
                    $newNewData[$indexNew]['cancel']  = 0;
                    $newNewData[$indexNew]['postpone']= 0;
                    break;
                }
              }
            }
            $indexNew++;
          }
        }

        $filteredIndex = array();
        $filteredIndex = array_keys(
                          array_column($newNewData, 'date_monthly_activity'), 
                          '2022-'.$monthFilter.'-01'
                        );

        $veryNewData = array();
        for ($i=0; $i < count($filteredIndex); $i++) { 
          $veryNewData[$i] = $newNewData[$filteredIndex[$i]];
        }

        foreach ($veryNewData as $key => $value) {
          $dataCategories[$value['id_category']-1]['fasterCategory']  += $value['faster'];
          $dataCategories[$value['id_category']-1]['ontimeCategory']  += $value['ontime'];
          $dataCategories[$value['id_category']-1]['overdueCategory'] += $value['overdue'];
          $dataDepartments[$value['id_department']-1]['fasterDepartment']  += $value['faster'];
          $dataDepartments[$value['id_department']-1]['ontimeDepartment']  += $value['ontime'];
          $dataDepartments[$value['id_department']-1]['overdueDepartment'] += $value['overdue'];
        }

        $faster  = array_keys(array_column($veryNewData, 'faster'), 1);
        $ontime  = array_keys(array_column($veryNewData, 'ontime'), 1);
        $overdue = array_keys(array_column($veryNewData, 'overdue'), 1);
        $close   = array_keys(array_column($veryNewData, 'close'), 1);
        $open    = array_keys(array_column($veryNewData, 'open'), 1);
        $cancel  = array_keys(array_column($veryNewData, 'cancel'), 1);
        $postpone= array_keys(array_column($veryNewData, 'postpone'), 1);

        $result['faster'] = count($faster);
        $result['ontime'] = count($ontime);
        $result['overdue'] = count($overdue);
        $result['close'] = count($close);
        $result['open'] = count($open);
        $result['cancel'] = count($cancel);
        $result['postpone']= count($postpone);
        $result['dataCategories'] = $dataCategories;
        $result['dataDepartments']= $dataDepartments;

        //echo json_encode($newData);
        echo json_encode($result);
    }
}


// Profile, Name, Department, Extention

// Dropdown Bulan YTD Department achievement
// Achievemtn, plan 100 langsung closed
// PIC berdasarkan dept