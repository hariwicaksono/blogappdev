<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\CategoryModel;

class Category extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = CategoryModel::class;

	public function index()
	{
		$data = $this->model->findAll();
		
        if ($data) {
            $response = [
                'status' => true,
                'message' => 'Berhasil menampilkan semua data',
                'data' => $data
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Tidak ada data',
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }
    
    public function show($id = null)
    {
        $data = [
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $this->model->find($id)
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = [
            'name' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'user_id' => $input->user_id,
                'group' => $input->group,
                'name' => $input->name,
            ];
        } else {
            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'name' => $this->request->getPost('name'),
            ];
        }

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'message' => 'Validasi Gagal',
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        } else {
            $simpan = $this->model->save($data);
            if ($simpan) {
                $response = [
                    'status' => true,
                    'message' => 'Berhasil menyimpan data',
                    'data' => [],
                ];
                return $this->respond($response, 200);
            }
        }
    } 

    public function update($id = null)
    {
        $rules = [
            'name' => [
                'rules'  => 'required',
                'errors' => []
            ]
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'group' => $input->group,
                'name' => $input->name,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'group' => $input['group'],
                'name' => $input['name'],
            ];
        }

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'message' => 'Validasi Gagal',
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        } else {
            $simpan = $this->model->update($id, $data);
            if ($simpan) {
                $response = [
                    'status' => true,
                    'message' => 'Berhasil memperbarui data',
                    'data' => [],
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function delete($id = null)
    {
        $id = $this->model->find($id);
        if ($id) {
                $this->model->delete($id);
                $response = [
                    'status' => true,
                    'message' => 'Berhasil menghapus data',
                    'data' => []
                ];
                return $this->respond($response, 200);
        }  else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal menghapus data',
                    'data' => []
                ];
                return $this->respond($response, 200);
        }        
    }

    public function countCategory()
	{
        $count = $this->model->countCategory();
        $data = [
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}