<?php

namespace App\Controllers;

use App\Models\Pic_model;

class Pic extends BaseController{
    public function index(){
        $modelPICs  = new Pic_model;

        $data['headerTitle'] = "PIC";
        $data['currentPage'] = "PIC";
        $data['dataPICs']    = $modelPICs->findAll();

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('pic');
        echo view('_partial/footer');
    }

    public function addPic(){
        $modelPIC  = new Pic_model;

        $data['name_pic']   = $this->request->getPost("surename");
        $data['user_pic']   = $this->request->getPost("username");
        $data['pass_pic']   = $this->request->getPost("password");
        $data['role_pic']   = $this->request->getPost("role");

        $result = $modelPIC->addPic($data);
        if($result){
            return redirect()->to(base_url('pic'));
        }
    }

    public function editPic(){
        $modelPIC  = new Pic_model;

        $id_pic             = $this->request->getPost("idPic");
        $data['name_pic']   = $this->request->getPost("edtSurename");
        $data['role_pic']   = $this->request->getPost("edtRole");

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