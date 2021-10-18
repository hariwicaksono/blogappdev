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
                'message' => lang('App.successGetAllData'),
                'data' => $data
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => lang('App.noData'),
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }
    
    public function show($id = null)
    {
        $data = [
            'status' => true,
            'message' => lang('App.successGetData'),
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
                'message' => lang('App.errors'),
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        } else {
            $simpan = $this->model->save($data);
            if ($simpan) {
                $response = [
                    'status' => true,
                    'message' => lang('App.successSave'),
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
                'message' => lang('App.errors'),
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        } else {
            $simpan = $this->model->update($id, $data);
            if ($simpan) {
                $response = [
                    'status' => true,
                    'message' => lang('App.successUpdate'),
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
                    'message' => lang('App.successDelete'),
                    'data' => []
                ];
                return $this->respond($response, 200);
        }  else {
                $response = [
                    'status' => false,
                    'message' => lang('App.failedDelete'),
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
            'message' => lang('App.successGetData'),
            'data' => $count
        ];

        return $this->respond($data, 200);
    }
    
}