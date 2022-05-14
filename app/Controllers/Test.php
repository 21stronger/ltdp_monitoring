<?php

namespace App\Controllers;

use App\Models\View_activity_pivot_model;

class Test extends BaseController{
    public function index(){
        $modelViewActivity = new View_activity_pivot_model;

        $data['headerTitle'] = "Update Project";
        $data['currentPage'] = "Update";
        $data['detailActivity'] = $modelViewActivity->where('id_project', 1)->findAll();

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('test');
        echo view('_partial/footer');
    }

    public function main(){
        echo view('welcome_message');
    }
}
