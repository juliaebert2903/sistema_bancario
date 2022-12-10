<?php

namespace App\Models;

use CodeIgniter\Model;

class Applique extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'applique';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idUser', 'money', 'appliqueDate'];

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

    public function fazerAplicacao ($idUser, $value)
    {
        $this->insert(array(
            'idUser' => $idUser,
            'money' => $value
        ));
    }

    public function procurarAplicacao ($id)
    {
        $this->where(array('id' => $id));
        return $this->first();
    }

    public function procurarAplicacoes ($idUser)
    {
        $this->where(array('idUser' => $idUser));
        return $this->find();
    }

    public function resgatarAplicacao ($id)
    {
        $this->where(array('id' => $id))->delete($id);
    }
}
