<?php

namespace App\Models;

use CodeIgniter\Model;

class Levy extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'levy';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idUser', 'money', 'status', 'typePayment'];

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

    public function fazerCobrança ($idUser, $value)
    {
        $this->insert(array(
            'idUser' => $idUser,
            'money' => $value,
        ));
    }

    public function procurarCobranças ($id)
    {
        return $this->where(array('idUser' => $id, 'status' => true))->find();
    }

    public function pagarCobranca ($id, $payment)
    {
        $this->update($id, array(
            'status' => false,
            'typePayment' => $payment
        ));
    }

    public function procurarCobrança ($id)
    {
        $this->where(array('id' => $id));
        return $this->first();
    }
}
