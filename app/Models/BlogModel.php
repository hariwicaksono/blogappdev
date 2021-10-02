<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $DBGroup  = 'default';
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID             = 0;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['category_id', 'user_id', 'title', 'slug', 'summary', 'body', 'post_image', 'date', 'time'];

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

    public function getBlog($id = false)
    {
        if ($id === false) {
            $this->select("{$this->table}.*, c.name as category, u.name as user");
            $this->join("categories c", "c.id = {$this->table}.category_id", "left");
            $this->join("users u", "u.id = {$this->table}.user_id");
            $this->where("c.group", "blog");
            $this->orderBy("{$this->table}.id", "DESC");
            return $this->findAll();
        } else {
            $this->select("{$this->table}.*, c.name as category, u.name as user");
            $this->join("categories c", "c.id = {$this->table}.category_id");
            $this->join("users u", "u.id = {$this->table}.user_id");
            $this->where("{$this->table}.id", $id);
            $this->orWhere("{$this->table}.slug", $id);
            return $this->findAll();
        }
    }

    public function countBlog()
    {
        return $this->countAll();
    }

    public function searchBlog($id)
    {
        $this->like("title", $id);
        $this->orLike("body", $id);
        return $this->findAll();
    }

    public function searchTag($category)
    {
        $this->select("{$this->table}.*, c.name as category, u.name as user");
        $this->join("categories c", "c.id = {$this->table}.category_id");
        $this->join("users u", "u.id = {$this->table}.user_id");
        $this->where("c.name", $category);
        $this->orderBy("{$this->table}.id", "DESC");
        return $this->findAll();
    }
}
