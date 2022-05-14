<?php

namespace App\Controllers;

use App\Models\Pic_model; 

class Login extends BaseController{
    public function index(){
        echo view('_partial/header_login');
        echo view('login');
        echo view('_partial/footer_login');
    }

    public function check(){
        $session = session();
        $model = new Pic_model;

        $username = $this->request->getGet("username");
        $password = $this->request->getGet("password");

        $checkPic = $model->where('user_pic', $username)
                        ->first();
        if($checkPic){
            if($checkPic['pass_pic']==$password){
                session()->set([
                    'username' => $checkPic['user_pic'],
                    'name' => $checkPic['name_pic'],
                    'role' => $checkPic['role_pic'],
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
