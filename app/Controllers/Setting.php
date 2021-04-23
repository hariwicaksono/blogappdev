<?php namespace App\Controllers;

use App\Models\SettingModel;
use CodeIgniter\RESTful\ResourceController;

class Setting extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\SettingModel';

	public function index()
	{
        $id = '1';
        $data = [
            'status' => '200',
            'data' => $this->model->getSetting($id)
        ];

        return $this->respond($data, 200);
    }
    
    public function show($id = null)
    {
        $data = [
            'status' => '200',
            'data' => $this->model->find($id)
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        
        $data = [
            'brand' => $this->request->getPost('brand'),
            'company' => $this->request->getPost('company'),
            'website' => $this->request->getPost('website'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($data > 0) {
            $this->model->save($data);
            $response = [
                'status' => '201',
                'data' => 'Success Post Data'
            ];
            return $this->respond($response, 201);
        } else {
            $response = [
                'status' => '422',
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
                'brand' => $input['brand'],
                'company' => $input['company'],
                'website' => $input['website'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'updated_at' => date("Y-m-d H:i:s")
            ];

            if ($data > 0) {
                $this->model->update($id, $data);

                $response = [
                    'status' => '200',
                    'data' => 'Success Update data'
                ];
                return $this->respond($response, 200);
            } 

            $response = [
                'status' => '422',
                'data' => 'Failed Update Data'
            ];
            return $this->respond($response, 422);
        }

        $response = [
            'status' => '404',
            'data' => 'Failed Update Data'
        ];
        return $this->respond($response, 404);
    }

    public function delete($id = null)
    {
        if ($this->request)
        {
            //get request from Reactjs
            if($this->request->getJSON()) {
                if ($this->model->find($id)) {

                    $delete = $this->model->delete($id);
            
                    if ($delete) {
                        $response = [
                            'status' => '200',
                            'data' => 'Success Delete Data'
                        ];
                        return $this->respond($response, 200);
                    } 

                    //try {
                        //$this->model->delete($id);
                        //$response = [
                            //'status' => '1',
                            //'data' => 'Success Delete data'
                        //];
                        //return $this->respond($response, 200);
                    //} catch (\Exception $e) {
                        //$response = [
                            //'status' => '0',
                            //'data' => 'Failed Delete Data'
                        //];
                        //return $this->respond($response, 422);
                    //}
                    
                }
            } else {
                $response = [
                    'status' => '405',
                    'data' => 'Data Not Found'
                ];
                return $this->respond($response, 405);
            }
        } else {
            $response = [
                'status' => '404',
                'data' => 'Data Not Found'
            ];
            return $this->respond($response, 404);
        }
    }
    
}