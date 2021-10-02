<?php namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{ 
    protected $DBGroup  = 'default';
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID             = 0;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['menu', 'url', 'menu_order', 'parent_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
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

    public function countMenu()
	{
		return $this->countAll();
	}

}