<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthIdentity extends Model
{
    protected $table            = 'auth_identities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sercret','secret2','updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'sercret' => 'required|min_length[3]|max_length[200]',
        'secret2'  => 'required|min_length[3]|max_length[200]',
        'updated_at'  => 'required|valid_date'

    ];
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
}