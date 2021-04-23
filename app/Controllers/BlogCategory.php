<?php namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\RESTful\ResourceController;

class BlogCategory extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\BlogModel';

    public function update($id = null)
    {
        if ($this->request)
        {
            //get request from Reactjs
            if($this->request->getJSON()) {
                $input = $this->request->getJSON();
                $data = [
                    'category_id' => $input->category_id
                ];

                if ($data > 0) {
                    $this->model->update($input->id, $data);

                    $response = [
                        'status' => '200',
                        'data' => 'Success Update data'
                    ];
                    return $this->respond($response, 200);
                } else {
                    $response = [
                        'status' => '404',
                        'data' => 'Failed Update Data'
                    ];
                    return $this->respond($response, 404);
                }
                
            }
        }


    }


    
}