<?php

namespace App\Models;

use CodeIgniter\Model;

class Ticket extends Model
{
    protected $table            = 'ticket';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['office_id','first_name','last_name','email','severity','description','status'];

    // // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $accomplishedField  = 'accomplished_at';

    // Validation
    protected $validationRules      = [
        'office_id' => 'required|integer',
        'first_name' => 'required|min_length[3]|max_length[255]',
        'last_name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|min_length[3]|max_length[255]',
        'severity' => 'required|min_length[1]|max_length[3]',
        'description' => 'required|min_length[3]|max_length[500]',
        'status' => 'required|min_length[3]|max_length[32]',
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

    // Relationship/Association
    protected $returnTypeRelations = 'array';
    protected $belongsTo=[
        'office'=>[
            'model'=>'App\Models\Office',
            'foreign_key'=>'office_id',
            'local_key'=>'id'
        ]
    ];
}