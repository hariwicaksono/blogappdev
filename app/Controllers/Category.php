<?php namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\CategoryModel';

	public function index()
	{
        $count = $this->model->count_category();
        $data = [
            'status' => '1',
            'data' => $this->model->findAll(),
            'allCount' => $count
        ];

        return $this->respond($data, 200);
    }
    
    public function show($id = null)
    {
        $data = [
            'status' => '1',
            'data' => $this->model->find($id)
        ];

        return $this->response->setStatusCode(200)->setJSON($data);
    }

    public function create()
    {
        
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'name' => $this->request->getPost('name'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($data > 0) {
            $this->model->save($data);
            $response = [
                'status' => '1',
                'data' => 'Success Post Data'
            ];
            return $this->respond($response, 201);
        } else {
            $response = [
                'status' => '0',
                'data' => 'Failed Post Data'
            ];
            return $this->respond($response, 422);
        }
    }

    public function update($id = null)
    {
        if ($this->model->find($id)) {

            $input = $this->request->getRawInput();
            $data = [
                'name' => $input['name'],
                'updated_at' => date("Y-m-d H:i:s")
            ];

            if ($data > 0) {
                $this->model->update($id, $data);

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

    public function delete($id = null)
    {
        if ($this->model->find($id)) {

            $delete = $this->model->delete($id);
    
            if ($delete) {
                $response = [
                    'status' => '1',
                    'data' => 'Success Delete data'
                ];
                return $this->respond($response, 200);
            } 

            try {
                $this->model->delete($id);
                $response = [
                    'status' => '1',
                    'data' => 'Success Delete data'
                ];
                return $this->respond($response, 200);
            } catch (\Exception $e) {
                $response = [
                    'status' => '0',
                    'data' => 'Failed Delete Data'
                ];
                return $this->respond($response, 422);
            }
            
        }

        $response = [
            'status' => '0',
            'data' => 'Failed Delete Data'
        ];
        return $this->respond($response, 404);
    }
    
}