<?php

namespace App\Controllers;

use App\Models\Category_model;
use App\Models\Department_model;

use App\Models\View_ytd_achievement_model;
use App\Models\View_activity_pivot_model;

class Test extends BaseController{
  public function index(){
      echo view('errors/html/error_404');
  }

  public function main(){
      echo view('welcome_message');
  }
}
