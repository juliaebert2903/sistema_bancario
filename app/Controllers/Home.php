<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Auditorium;
use App\Models\Account;
use App\Models\Levy;

class Home extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function login()
    {
        return view('login');
    }

    public function fazerLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new User;
        $query = $userModel->login($email, $password)->getResult();
        if (count($query) == 1) {
            $auditorium = new Auditorium;
            $auditorium->login($query[0]->id);

            $this->session->set(array(
                'id' => $query[0]->id,
                'name' => $query[0]->name,
                'email' => $email,
            ));
            return redirect()->to('/');
        } else {
            $this->session->setFlashdata("error", "O email/senha digitado está incorreto.");
            return redirect()->back();
        }
    }

    public function cadastro ()
    {
        return view('cadastro');
    }
    
    public function fazerCadastro ()
    {
        $nome = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new User;
        if ($userModel->procurarEmail($email)) {
            $this->session->setFlashdata("error", "O email já está em uso.");
            return redirect()->back();
        }
        $id = $userModel->cadastro($nome, $email, $password);
        if ($id) {
            $accountModel = new Account;
            $accountModel->fazerCadastro($id);
            $levyModel = new Levy;
            $levyModel->fazerCobrança($id, 24.99);
            $levyModel->fazerCobrança($id, 100);
            $levyModel->fazerCobrança($id, 99.99);
            $levyModel->fazerCobrança($id, 44.25);
            $levyModel->fazerCobrança($id, 122.33);
            $this->session->set(array(
                'id' => $id,
                'name' => $nome,
                'email' => $email,
            ));
            return redirect()->to('/');
        } else {
            $this->session->setFlashdata("error", "Houve um erro durante o cadastro.");
            return redirect()->back();
        }

        return view('cadastro');
    }

    public function logout ()
    {
        $auditorium = new Auditorium;
        $auditorium->logout($this->session->id);
    
        $array_items = ['name', 'email'];
        $this->session->remove($array_items);

        return redirect()->to('/login');
    }
}
