<?php

namespace App\Controllers;

use App\Models\Pic_model;
use App\Models\Department_model;

class Pic extends BaseController{
    public function index(){
        $modelPICs  = new Pic_model;
        $modelDeparment = new Department_model;

        $data['headerTitle'] = "PIC";
        $data['currentPage'] = "PIC";
        $data['dataPICs']    = $modelPICs->getPics();
        $data['dataDepartments'] = $modelDeparment->findAll();

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('pic');
        echo view('_partial/footer');
    }

    public function addPic(){
        $modelPIC  = new Pic_model;

        $data['name_pic']   = $this->request->getPost("initial");
        $data['user_pic']   = $this->request->getPost("email");
        $data['pass_pic']   = $this->request->getPost("password");
        $data['role_pic']   = $this->request->getPost("role");

        if($data['role_pic']=='User' || $data['role_pic']=='Supervisor'){
            $data['id_department']  = $this->request->getPost("dept");
        } else {
            $data['id_department']  = 0;
        }

        $result = $modelPIC->addPic($data);
        if($result){
            return redirect()->to(base_url('pic'));
        }
    }

    public function editPic(){
        $modelPIC  = new Pic_model;

        $id_pic             = $this->request->getPost("idPic");
        $data['name_pic']   = $this->request->getPost("edtInitial");
        $data['role_pic']   = $this->request->getPost("edtRole");

        if($data['role_pic'] == 'User' || $data['role_pic'] == 'Supervisor'){
            $data['id_department']  = $this->request->getPost("edtDept");
        } else {
            $data['id_department']  = 0;
        }

        $passwordChanged    = $this->request->getPost("edtPassword");
        if($passwordChanged!=""){
            $data['pass_pic']   = $passwordChanged;
        }

        $result = $modelPIC->update($id_pic, $data);

        if($result){
            return redirect()->to(base_url('pic'));
        }
    }
}