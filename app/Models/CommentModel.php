<?php namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $DBGroup  = 'default';
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['post_id', 'name', 'email', 'body', 'active'];

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

    public function getComment($id = false)
    {
        $this->select("{$this->table}.*, p.slug");
        $this->join("posts p", "p.id = {$this->table}.post_id");
        $this->where("{$this->table}.post_id", $id);
        $this->orWhere("p.slug", $id);
        $this->where("{$this->table}.active", "true");
        return $this->findAll();
    }

    public function countComment()
	{
		return $this->countAll();
	}

}