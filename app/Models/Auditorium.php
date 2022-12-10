<?php

namespace App\Models;

use CodeIgniter\Model;

class Auditorium extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auditorium';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['date', 'idUser', 'state'];

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

    public function login ($id)
    {
        $date = new \DateTime();
        $result = $date->format('Y-m-d H:i:s');
        return $this->insert(array(
            'date' => $result,
            'idUser' => $id,
            'state' => true
        ));
    }

    public function logout ($id)
    {
        $date = new \DateTime();
        $result = $date->format('Y-m-d H:i:s');
        return $this->insert(array(
            'date' => $result,
            'idUser' => $id,
            'state' => false
        ));
    }
}
