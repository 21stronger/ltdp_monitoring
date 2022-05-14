<?php

namespace App\Controllers;

class Profile extends BaseController{
    public function index(){
        $data['headerTitle'] = "Profile";
        $data['currentPage'] = "Profile";

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('profile');
        echo view('_partial/footer');
    }
}
