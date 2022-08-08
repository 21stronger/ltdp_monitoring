<?php

namespace App\Controllers;

use App\Models\Summary_monthly_model;

class CheckerController extends BaseController{

    protected function index(){
        $modelSummary = new Summary_monthly_model;

        $dataActivities = $modelSummary->getAllMonthlyActivities();

        $dataSummary = fungsi($dataActivities);

        //$result = $modelSummary->addBatch($dataSummary);
        echo json_encode($dataSummary);
    }

    protected function updatePerProject($idProject){
        $modelSummary = new Summary_monthly_model;

        $dataSummaries  = $modelSummary->where('id_project', $idProject)->findAll();
        $dataActivities = $modelSummary->getMonthlyActivityByIdProject($idProject);

        $dataSummary = activityAlter($dataActivities);

        $countDataSum = count($dataSummaries);
        $countDataAct = count($dataSummary);

        if($countDataSum==0){
            $response = $modelSummary->addBatch($dataSummary);

            $result = array('count'=>0, 'data'=>$dataSummary);
        } else
        if($countDataSum<>$countDataAct){
            $modelSummary->where('id_project', $idProject)->delete();
            $response = $modelSummary->addBatch($dataSummary);

            $result = array('count'=>$countDataSum.":".$countDataAct, 
                            'dataSummary'=>$dataSummary,
                            'dataActivities'=>$dataSummaries);
        } else {
            foreach ($dataSummaries as $key => $value) {
                $id = $value['id_monthly'];
                $data = $dataSummary[$key];

                $modelSummary->update($id, $data);
            }

            $result = array('count'=>'same', 'data'=>$dataSummary);
        }
    }
}