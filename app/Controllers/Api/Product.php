<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\ProductModel;

class Product extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = ProductModel::class;

	public function index()
	{
		$data = $this->model->getProduct();
        $count = $this->model->countProduct();
		
        if ($data) {
            $response = [
                'status' => true,
                'message' => 'Berhasil menampilkan semua data',
                'data' => $data,
                'jumlah' => $count
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
            'data' => $this->model->getProduct($id)
            //'data' => $this->model->find($id)
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = [
            'title' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'category_id' => $input->category_id,
                'user_id' => $input->user_id,
                'title' => $input->title,
                'slug' => str_replace(' ', '-', strtolower($input->title)),
                'summary' => $input->summary,
                'body' => $input->body,
                'price' => $input->price,
                'unit' => $input->unit,
                'post_image' => $input->foto,
                'date' => $input->date,
                'time' => $input->time,
            ];
        } else {
            $data = [
                'category_id' => $this->request->getPost('category_id'),
                'user_id' => $this->request->getPost('user_id'),
                'title' => $this->request->getPost('title'),
                'slug' => str_replace(' ', '-', strtolower($this->request->getPost('title'))),
                'summary' => $this->request->getPost('summary'),
                'body' => $this->request->getPost('body'),
                'price' => $this->request->getPost('price'),
                'unit' => $this->request->getPost('unit'),
                'post_image' => $this->request->getPost('foto'),
                'date' => $this->request->getPost('date'),
                'time' => $this->request->getPost('time'),
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
            'title' => [
                'rules'  => 'required',
                'errors' => []
            ]
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'title' => $input->title,
                'summary' => $input->summary,
                'body' => $input->body,
                'price' => $input->price,
                'unit' => $input->unit,
                'date' => $input->date,
                'time' => $input->time,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'title' => $input['title'],
                'summary' => $input['summary'],
                'body' => $input['body'],
                'price' => $input['price'],
                'unit' => $input['unit'],
                'date' => $input['date'],
                'time' => $input['time'],
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
	
	public function countProduct()
	{
        $count = $this->model->countProduct();
        $data = [
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}