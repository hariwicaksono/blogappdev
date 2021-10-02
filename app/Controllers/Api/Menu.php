<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\MenuModel;

class Menu extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = MenuModel::class;

    public function index()
    {
        $data = $this->model->findAll();
        $count = $this->model->countMenu();

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
            'data' => $this->model->find($id)
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = [
            'menu' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'menu' => $input->menu,
                'url' => $input->url,
                'parent_id' => $input->parent_id,
            ];
        } else {
            $data = [
                'menu' => $this->request->getPost('menu'),
                'url' => $this->request->getPost('url'),
                'parent_id' => $this->request->getPost('parent_id'),
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
                'menu' => $input->menu,
                'url' => $input->url,
                'parent_id' => $input->parent_id,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'menu' => $input['menu'],
                'url' => $input['url'],
                'parent_id' => $input['parent_id'],
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
        } else {
            $response = [
                'status' => false,
                'message' => 'Gagal menghapus data',
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }
}
