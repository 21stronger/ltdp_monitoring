<?php

namespace App\Controllers;

use App\Models\Pic_model;

class Profile extends BaseController{
    public function index(){
        $modelPic = new Pic_model;

        $data['dataProfile'] = $modelPic->find(session()->get('idPic'));
        $data['headerTitle'] = "Profile";
        $data['currentPage'] = "Profile";

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('profile');
        echo view('_partial/footer');
    }

    public function editPic($idPic){
        $modelPic = new Pic_model;

        $data['name_pic'] = $this->request->getPost("fullname");
        $data['user_pic'] = $this->request->getPost("username");

        $getPic   = $modelPic->where('id_pic', $idPic)
                        ->first();

        if($getPic['id_pic'] != session()->get('idPic') || 
            $getPic['user_pic'] != session()->get('username') || 
            $getPic['name_pic'] != session()->get('name') || 
            $getPic['role_pic'] != session()->get('role')){
            return redirect()->to(base_url('profile'));
        }

        $updatePic = $modelPic->update($getPic['id_pic'], $data);
        if($updatePic){
            session()->set([
                'username'  => $data['user_pic'],
                'name'      => $data['name_pic']
            ]);
            return redirect()->to(base_url('profile'));
        }
    }

    public function editPassPic($idPic){
        $modelPic = new Pic_model;

        $password       = $this->request->getPost("password");
        $newpassword    = $this->request->getPost("newpassword");
        $renewpassword  = $this->request->getPost("renewpassword");

        $dataCheck['id_pic']    = $idPic;
        $dataCheck['pass_pic']  = $password;

        // Check New Password and Re-New is match
        if($newpassword!=$renewpassword){
            session()->setFlashdata('error', 
                'New Password and Confirmation New Password doesn\'t match\nTry Again');
            return redirect()->to(base_url('profile'));
        }

        $getPic   = $modelPic->where($dataCheck)
                        ->first();

        // Check if PIC is found and old password is match
        if(!$getPic){
            session()->setFlashdata('error', 'Old Password doesn\'t match\nTry Again');
            return redirect()->to(base_url('profile'));
        }

        // Check if loggedin and session is match pic
        if($getPic['id_pic'] != session()->get('idPic') || 
            $getPic['user_pic'] != session()->get('username') || 
            $getPic['name_pic'] != session()->get('name') || 
            $getPic['role_pic'] != session()->get('role')){
            session()->setFlashdata('error', 'Try Again');
            return redirect()->to(base_url('profile'));
        }

        $data['pass_pic']   = $newpassword;
        $updatePic = $modelPic->update($getPic['id_pic'], $data);
        if($updatePic){
            session()->setFlashdata('error', 'Password Change Successful');
            return redirect()->to(base_url('profile'));
        }
    }
}
