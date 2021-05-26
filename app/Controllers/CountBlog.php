<?php namespace App\Controllers;

use App\Models\BlogModel;
use \Appkita\CI4Restfull\RestfullApi;

class CountBlog extends RestfullApi
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\BlogModel';
    protected $auth = ['key'];
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