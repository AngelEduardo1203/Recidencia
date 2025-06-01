<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;


class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $rules = [
            'user' => 'required',
            'password' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $userModel = new UserModel();
        $post = $this->request->getPost(['user', 'password']);

        $user = $userModel->validateUser($post['user'], $post['password']);

        if ($user !== null) {
            $this->setSession($user);

            // Supongamos que el usuario tiene una propiedad 'rol' o 'role'
            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('calendario/'));
            } else {
                return redirect()->to(base_url('usuario/'));
            }
        }

        return redirect()->back()->withInput()->with('errors', 'El usuario y/o contraseña son incorrectos.');
        }

    private function setSession($userData)
    {
        $data = [
            'logged_in' => true,
            'user_id' => $userData['id'], // antes era 'userid'
            'user_name' => $userData['name'],
            'role'      => $userData['role'],  
            'is_admin' => $userData['role'] === 'admin', // usa tu campo "role"
        ];

        session()->set($data);
        //$this->session->set($data);
    }


    public function logout()
    {
        if ($this->session->get('logged_in')) {
            $this->session->destroy();
        }
        return redirect()->to(base_url('/'));
    }
}
