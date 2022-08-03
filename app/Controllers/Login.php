<?php

namespace App\Controllers;

use App\Models\Pic_model; 

class Login extends BaseController{
    public function index(){
        $data['headerTitle'] = "Login";

        echo view('_partial/header_login', $data);
        echo view('login');
        echo view('_partial/footer_login');
    }

    public function check(){
        $session = session();
        $modelPIC = new Pic_model;

        $username = $this->request->getGet("username");
        $password = $this->request->getGet("password");

        $dataPIC = $modelPIC->where('user_pic', $username)
                        ->first();

        $checkPic = $modelPIC->checkPic($dataPIC['id_pic']);

        if($checkPic){
            if($checkPic['pass_pic']==$password){
                session()->set([
                    'idPic'     => $checkPic['id_pic'],
                    'username'  => $checkPic['user_pic'],
                    'name'      => $checkPic['name_pic'],
                    'idDept'    => $checkPic['id_department'],
                    'nameDept'  => $checkPic['department_name'],
                    'role'      => $checkPic['role_pic'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
