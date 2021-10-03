<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\BlogModel;

class Blog extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = BlogModel::class;

	public function index()
	{
		$data = $this->model->getBlog();
		$count = $this->model->countBlog();

        if ($data) {
            $response = [
                'status' => true,
                'message' => 'Berhasil menampilkan semua data',
                'data' => $data,
                'allCount' => $count
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
            'data' => $this->model->getBlog($id),  
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
                'date' => $input->date,
                'time' => $input->time,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'title' => $input['title'],
                'summary' => $input['summary'],
                'body' => $input['body'],
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

    public function imgUpload($id = null)
    {
        if ($this->request->getJSON()) {
            $json = $this->request->getJSON();
            $data = [
                'post_image' => $json->foto,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'post_image' => $input['foto'],
            ];
        }

        if ($data > 0) {
            $this->model->update($id, $data);

            $response = [
                'status' => true,
                'message' => 'Berhasil Upload',
                'data' => []
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Gagal Upload',
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }

    public function setCategory($id = null)
    {
        if ($this->request->getJSON()) {
            $json = $this->request->getJSON();
            $data = [
                'category_id' => $json->category_id,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'category_id' => $input['category_id'],
            ];
        }

        if ($data > 0) {
            $this->model->update($id, $data);
            $response = [
                'status' => true,
                'message' => 'Berhasil memperbarui data',
                'data' => []
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Gagal memperbarui data',
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }

    public function countBlog()
	{
        $count = $this->model->countBlog();
        $data = [
            'status' => true,
            'message' => 'Berhasil menampilkan data',
            'data' => $count
        ];

        return $this->respond($data, 200);
    }

    public function searchBlog()
    {
		$input = $this->request->getVar();
        $query = $input['query'];
		$data = $this->model->searchBlog($query);
        if ($data) {
            $response = [
                'status' => true,
                'message' => 'Berhasil menampilkan data',
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

    public function searchTag()
    {
		$input = $this->request->getVar();
        $category = $input['category'];
        return $this->respond(["status" => true, "message" => "Success", "data" => $this->model->searchByTag($category)], 200);
    }
    
}