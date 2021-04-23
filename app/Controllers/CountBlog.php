<?php namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\RESTful\ResourceController;

class CountBlog extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\BlogModel';

	public function index()
	{
        $count = $this->model->count_blog();
        $data = [
            'status' => '200',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}