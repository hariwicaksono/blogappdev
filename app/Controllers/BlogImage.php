<?php namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\RESTful\ResourceController;

class BlogImage extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\BlogModel';

    public function update($id = null)
    {
        if ($this->model->find($id)) {

            $input = $this->request->getRawInput();
            $data = [
                'post_image' => $input['foto']
            ];

            if ($this->model->update($id, $data) > 0) {

                $response = [
                    'status' => '1',
                    'data' => 'Success Update data'
                ];
                return $this->respond($response, 200);
            } 

            $response = [
                'status' => '0',
                'data' => 'Failed Update Data'
            ];
            return $this->respond($response, 422);
        }

        $response = [
            'status' => '0',
            'data' => 'Failed Update Data'
        ];
        return $this->respond($response, 404);
    }


    
}