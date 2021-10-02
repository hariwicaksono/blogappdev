<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup  = 'default';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID             = 0;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['email', 'username', 'password', 'name', 'status_user', 'status_active'];

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

    public function getUser($id = false)
    {
        return $this->where(['email' => $id])->first();
    }

    public function updatePassword($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['email' => $id]);
    }

    public function countUser()
	{
		return $this->countAll();
	}

}