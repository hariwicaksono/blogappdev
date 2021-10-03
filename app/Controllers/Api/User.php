<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\UserModel;

class User extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = UserModel::class;

	public function index()
	{
		$data = $this->model->findAll();

        if ($data) {
            $response = [
                'status' => true,
                'message' => 'Berhasil menampilkan semua data',
                'data' => $user
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
            'data' => $this->model->find($id),
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
		$rules = [
            'email' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];
		
		if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'email' => $input->email,
				'username' => $input->username,
				'password' => $input->password,
				'name' => $input->name,
				'status_user' => $input->status_user,
				'status_active' => $input->status_active,
            ];
        } else {
            $data = [
                'email' => $this->request->getPost('email'),
				'username' => $this->request->getPost('username'),
				'password' => $this->request->getPost('password'),
				'name' => $this->request->getPost('name'),
				'status_user' => $this->request->getPost('status_user'),
				'status_active' => $this->request->getPost('status_active'),
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
			$id = $input->id;
            $data = [
			    'name' => $input->name,
                'email' => $input->email,
                
            ];
        } else {
            $input = $this->request->getRawInput();
			$id = $input['id'];
            $data = [
			    'name' => $input['name'],
                'email' => $input['email'],
              
            ];
        }

			$this->model->update($id, $data);
                $response = [
                    'status' => true,
                    'message' => 'Berhasil memperbarui data',
                    'data' => [],
                ];
            return $this->respond($response, 200);
            
        
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

    public function changePassword($id = null)
    {
        
        if($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'password' => $input->password
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'password' => $input['password']
            ];
        }

        if ($data > 0) {
            $this->model->update($id, $data);
            $response = [
                'status' => true,
                'message' => 'Berhasil memperbarui password',
                'data' => []
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Gagal memperbarui password',
                'data' => []
            ];
            return $this->respond($response, 200);
        }         
        
    }
    
}