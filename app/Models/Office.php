<?php

namespace App\Models;

use CodeIgniter\Model;

class Office extends Model
{
    protected $table            = 'office';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['office','code','description'];


    // Validation
    protected $validationRules      = [
        'office' => 'required|min_length[3]|max_length[500]',
        'code' => 'required|min_length[3]|max_length[12]',
        'description' => 'required|min_length[3]|max_length[500]'
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