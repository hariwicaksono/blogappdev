<?php namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\RESTful\ResourceController;

class CountComment extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\CommentModel';

	public function index()
	{
        $count = $this->model->count_comment();
        $data = [
            'status' => '1',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}