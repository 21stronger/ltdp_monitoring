<?php

namespace App\Controllers;

use App\Models\Summary_monthly_model;

class Settings extends BaseController{
    public function index(){
        $data['headerTitle'] = "App Settings";
        $data['currentPage'] = "Settings";

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('settings');
        echo view('_partial/footer');
    }

    public function resetData(){
        $modelSummary = new Summary_monthly_model;
        //Check if Admin

        $resultDelete = $modelSummary->deleteAllAndResetAI();
        
        $dataActivities = $modelSummary->getAllMonthlyActivities();
        $dataSummary = activityAlter($dataActivities);
        $resultInsert = $modelSummary->addBatch($dataSummary);

        $resultDelete = json_decode($resultDelete);
        $data = array(
            "deleteStatus"=>$resultDelete[0],
            "AIStatus"=>$resultDelete[1],
            "Total Act Altered"=>count($dataSummary),
            "Total Act Inserted"=>$resultInsert
        );

        if(count($dataSummary)==$resultInsert){
            array_push($data, $data["status"] = "success");
        } else {
            array_push($data, $data["status"] = "failed");
        }

        return json_encode($data);
    }
}