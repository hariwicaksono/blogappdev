<?php namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class CountCategory extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\CategoryModel';

	public function index()
	{
        $count = $this->model->count_category();
        $data = [
            'status' => '1',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}