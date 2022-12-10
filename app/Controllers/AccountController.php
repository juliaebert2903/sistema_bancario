<?php

namespace App\Controllers;

use App\Models\Account;
use App\Models\Levy;
use App\Models\Applique;

class AccountController extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        if (!$this->session->name) return redirect()->to('/login');

        $accountModel = new Account;
        $account = $accountModel->procurarContaUsuario($this->session->id);
        $levyModel = new Levy;
        $levies = $levyModel->procurarCobranças($this->session->id);
        $appliqueModel = new Applique;
        $appliquies = $appliqueModel->procurarAplicacoes($this->session->id);
        
        return view('dashboard', array('account' => $account, 'levies' => $levies, 'appliquies' => $appliquies));
    }
    
    public function fazerTransferencia()
    {
        if (!$this->session->name) return redirect()->to('/login');

        $agency = $this->request->getPost('agency');
        $account = $this->request->getPost('account');
        $value = $this->request->getPost('value');

        $accountModel = new Account;
        $otherAccount = $accountModel->procurarConta($agency, $account);
        if (!$otherAccount) {
            $this->session->setFlashdata("error-transfer", "Agência/conta está com dado incorreto.");
            return redirect()->back();
        } else {
            $myAccount = $accountModel->procurarContaUsuario($this->session->id);
            if ($myAccount['money'] < $value) {
                $this->session->setFlashdata("error-transfer", "Você não possui saldo suficiente.");
                return redirect()->back();
            } else {
                $accountModel->fazerTransferencia($myAccount, $otherAccount, $value);
                $this->session->setFlashdata("error-transfer", "Transferência realizada com sucesso!");
                return redirect()->to('/');
            }
        }
    }
    
    public function pagarCobranca ($id)
    {
        $accountModel = new Account;
        $myAccount = $accountModel->procurarContaUsuario($this->session->id);

        $levyModel = new Levy;
        $levy = $levyModel->procurarCobrança($id);
        if ($myAccount['money'] < $levy['money']) {
            $this->session->setFlashdata("error-payment-$id", "Você não possui saldo suficiente.");
            return redirect()->back();
        } else {
            $levyModel = new Levy;
            $levyModel->pagarCobranca($id, $this->request->getPost('typePayment'));
            $accountModel->pagarCobranca($myAccount['id'], $myAccount['money'] - $levy['money']);
            return redirect()->to('/');
        }
    }

    public function fazerAplicacao ()
    {
        $value = $this->request->getPost('value');

        $accountModel = new Account;
        $myAccount = $accountModel->procurarContaUsuario($this->session->id);
        if ($myAccount['money'] < $value) {
            $this->session->setFlashdata("error-applique", "Você não possui saldo suficiente.");
            return redirect()->back();
        } else {
            $appliqueModel = new Applique;
            $appliqueModel->fazerAplicacao($this->session->id, $value);
            $accountModel->pagarCobranca($myAccount['id'], $myAccount['money'] - $value);
            return redirect()->to('/');
        }
    }
    
    public function resgatarAplicacao ($id)
    {
        $appliqueModel = new Applique;
        $applique = $appliqueModel->procurarAplicacao($id);

        $accountModel = new Account;
        $myAccount = $accountModel->procurarContaUsuario($this->session->id);

        $date = (new \DateTime());
        $juros = $date->diff(new \DateTime($applique['appliqueDate']));
        $juros = $juros->format("%a");

        $accountModel->pagarCobranca($myAccount['id'], $myAccount['money'] + $applique['money'] + ($applique['money'] * $juros * 0.0017));
        
        $appliqueModel->resgatarAplicacao($id);
        return redirect()->to('/');
    }
}
