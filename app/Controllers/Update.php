<?php

namespace App\Controllers;

use App\Models\Pica_model;
use App\Models\Project_model;
use App\Models\Activity_model;
use App\Models\Department_model;
use App\Models\Summary_monthly_model;
use App\Models\Monthly_activity_model;

use App\Models\View_summary_monthly_project_alter_model;
use App\Models\View_summary_monthly_project_model;
use App\Models\View_activity_description_model;
use App\Models\View_summary_monthly_model;
use App\Models\View_project_detail_model;
use App\Models\View_activity_pivot_model;
use App\Models\View_activity_pica_model;

class Update extends CheckerController{

    public function index(){
        $modelProject = new Project_model;
        $modelDeparment = new Department_model;
        $modelSummaryMonthly = new Summary_monthly_model;
        
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
        $modelActivity  = new Activity_model;

        $modelViewActivityPica  = new View_activity_pica_model;
        $modelViewActivity      = new View_activity_pivot_model;
        $modelViewInformation   = new View_activity_description_model;
        $modelViewSummaryProject= new View_summary_monthly_project_model;

        $data['idProject'] = $id_project;
        $data['dataProject'] = $modelViewSummaryProject->getProjectDetail($id_project);
        $data['detailActivity'] = $modelViewActivity
                                    ->where('id_project', $id_project)
                                    ->orderBy('id_activity', 'asc')
                                    ->findAll();
        $data['dataDescription'] = $modelViewInformation
                                    ->where('id_project', $id_project)
                                    ->where("description IS NOT null AND description != ''")
                                    ->findAll();
        $data['dataPica']    = $modelViewActivityPica
                                ->where('id_project', $id_project)
                                ->findAll();
        $data['dataActivities'] = $modelActivity
                                    ->where('id_project', $id_project)
                                    ->findAll();
        $data['headerTitle'] = "Detail Project";
        $data['currentPage'] = "Update";

        $yearOptions = array();
        $thisYear = date('Y');
        $projectDueYear = date('Y', strtotime($data['dataProject']['project_due_date']));
        for ($i=$thisYear; $i <= $projectDueYear; $i++) {
            array_push($yearOptions, $i);
        }
        $data['yearOptions'] = $yearOptions;

        if(!$data['dataProject']){
            return redirect()->to(base_url('update'));
        }
        
        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('detail');
        echo view('_partial/footer');
    }

    public function updateDetail($idProject){
        $modelMonthly = new Monthly_activity_model;

        $idMonthly     = $this->request->getPost("activityIdAch");
        $id = ($idMonthly==null)? 0: $idMonthly;

        $data['actual_monthly_activity']    = $this->request->getPost("activityActualAch");
        $data['description']                = $this->request->getPost("activityDescriptionAch");

        $modelMonthly->update($id, $data);

        $result['id']   = $id;
        $result['value']= number_format($data['actual_monthly_activity']);
        
        $this->updatePerProject($idProject);
        
        return json_encode($result);
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

    public function getDetailMonthly($id_monthly){
        $modelViewMonthly = new View_activity_description_model;

        $result = $modelViewMonthly->find($id_monthly);

        return json_encode($result);
    }

    public function getMonthly($idActivity){
        $modelMonthly = new Monthly_activity_model;

        $data = $modelMonthly
                    ->select('`id_monthly_activity`, `date_monthly_activity`')
                    ->where('id_activity', $idActivity)
                    ->where('plan_monthly_activity > 0')
                    ->findAll();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['date_monthly_activity'] = datetostr($data[$i]['date_monthly_activity']);
        }

        return json_encode($data);
    }

    public function getDataSummary(){
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $datatable = new View_summary_monthly_project_alter_model($request, $session);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->id_project;
                $row[] = $list->category_name;
                $row[] = $list->project_name;
                $row[] = datetostr($list->date_monthly);
                $row[] = $list->department_name;
                $row[] = $list->name_pic;
                $row[] = $list->monthly.'%';
                $row[] = $list->status;
                $row[] = $list->ytd.'%';
                $row[] = $list->achievement;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
}
