<?php

namespace App\Models;

use CodeIgniter\Model;

class Account extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'account';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['agency', 'accountNumber', 'money', 'idUser'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function fazerCadastro($idUser)
    {
        $date = new \DateTime();
        $agency = substr($date->format('His'), -5);
        $accountNumber = substr($date->format('His'), 0);

        $this->insert(array(
            'idUser' => $idUser,
            'agency' => $agency,
            'accountNumber' => $accountNumber
        ));
    }

    public function procurarContaUsuario ($idUser)
    {
        $this->where(array(
            'idUser' => $idUser
        ));
        return $this->first();
    }

    public function procurarConta ($agency, $accountNumber)
    {
        $this->where(array(
            'agency' => $agency,
            'accountNumber' => $accountNumber
        ));
        return $this->first();
    }

    public function fazerTransferencia ($myAccount, $otherAccount, $value)
    {
        $this->update($myAccount['id'], array('money' => $myAccount['money'] - $value));
        $this->update($otherAccount['id'], array('money' => $otherAccount['money'] + $value));
    }

    public function pagarCobranca ($idUser, $value)
    {
        $this->update($idUser, array('money' => $value));
    }
}
