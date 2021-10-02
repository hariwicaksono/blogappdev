<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\CommentModel;
 
class Comment extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = CommentModel::class;

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
            'data' => $this->model->getComment($id)
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
                'post_id' => $input->post_id,
                'name' => $input->name,
                'email' => $input->email,
                'body' => $input->body,
                'active' => '',
            ];
        } else {
            $data = [
                'post_id' => $this->request->getPost('post_id'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'body' => $this->request->getPost('body'),
                'active' => '',
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
        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'active' => $input->active,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'active' => $input['active'],
            ];
        }

        if ($data > 0) {
            $this->model->update($id, $data);
            $response = [
                'status' => true,
                'message' => 'Berhasil memperbarui data',
                'data' => [],
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Gagal memperbarui data',
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        }
    }

    public function countComment()
	{
        $count = $this->model->countComment();
        $data = [
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}