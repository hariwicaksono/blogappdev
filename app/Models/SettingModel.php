<?php namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $DBGroup  = 'default';
    protected $table = 'settings';
    protected $primaryKey = 'id'; 
    protected $insertID             = 0;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['brand', 'company', 'website', 'phone', 'email', 'landing_intro', 'landing_img', 'theme'];
    
    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

}