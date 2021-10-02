<?php namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AuthModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $insertID         = 0;
    protected $protectFields    = true;
    protected $allowedFields    = ['email', 'username', 'password', 'name', 'status_user', 'status_active'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = '';

     // Validation
     protected $validationRules      = [];
     protected $validationMessages   = [];
     protected $skipValidation       = false;
     protected $cleanValidationRules = true;
 
     // Callbacks
     protected $allowCallbacks       = true;
     protected $beforeInsert         = ['beforeInsert'];
     protected $afterInsert          = [];
     protected $beforeUpdate         = ['beforeUpdate'];
     protected $afterUpdate          = [];
     protected $beforeFind           = [];
     protected $afterFind            = [];
     protected $beforeDelete         = [];
     protected $afterDelete          = [];

    public function cek_login($user,$password)
	{
        return $this->db->table('users')
            ->where('email',$user)
            ->where('password',$password)
            ->get()->getResult();
	}

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }

    public function findUserByEmailAddress(string $emailAddress)
    {
        $user = $this
            ->asArray()
            ->where(['email' => $emailAddress])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified email address');

        return $user;
    }


}