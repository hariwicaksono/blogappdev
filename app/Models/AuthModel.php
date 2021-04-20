<?php namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['email', 'username', 'password', 'name', 'status_user', 'status_active', 'created_at', 'updated_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $skipValidation     = true;

    public function cek_login($user,$password)
	{
        return $this->db->table('users')
            ->where('email',$user)
            ->where('password',$password)
            ->get()->getResultArray();
	}


}