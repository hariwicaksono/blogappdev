<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\SlideshowModel;

class Slideshow extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = SlideshowModel::class;

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
            'img_slide' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'img_slide' => $input->foto,
                'text_slide' => $input->text_slide,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'img_slide' => $this->request->getPost('foto'),
                'text_slide' => $this->request->getPost('text_slide'),
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
            'text_slide' => [
                'rules'  => 'required',
                'errors' => []
            ]
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'text_slide' => $input->text_slide,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'text_slide' => $input['text_slide'],
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
    
    public function upload($id = null)
    {
        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'img_slide' => $input->foto
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'img_slide' => $input['foto']
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

} 