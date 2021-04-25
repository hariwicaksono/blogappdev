<?php namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\CategoryModel';

	public function index()
	{
        $id=$this->request->getVar('id');

        if ($id == null) {
			$data = $this->model->getCategory();
		} else {
			$data = $this->model->getCategory($id);
		}
		
        if ($data) {
            $response = [
                'status' => '200',
                'data' => $data
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => '404',
                'data' => 'Data Not Found'
            ];
            return $this->respond($response, 404);
        }
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
        if ($this->request)
        {
            //get request from Reactjs
            if($this->request->getJSON()) {
                $input = $this->request->getJSON();
                $data = [
                    'user_id' => $input->user_id,
                    'name' => $input->name,
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
            else { 
                $response = [
                    'status' => '405',
                    'data' => 'Method Not Allowed'
                ];
                return $this->respond($response, 405);
                }
             /**$data = [
                    'user_id' => $this->request->getPost('user_id'),
                    'name' => $this->request->getPost('name'),
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
                **/
        }
    } 

    public function update($id = null)
    {
        if ($this->request)
        {
            //get request from Reactjs
            if($this->request->getJSON()) {
                $input = $this->request->getJSON();
                $data = [
                    'name' => $input->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                if ($data > 0) {
                    $this->model->update($input->id, $data);

                    $response = [
                        'status' => '200',
                        'data' => 'Success Update data'
                    ];
                    return $this->respond($response, 200);
                } else {
                    $response = [
                        'status' => '404',
                        'data' => 'Failed Update Data'
                    ];
                    return $this->respond($response, 404);
                }
                
            }
            else { 
                $response = [
                    'status' => '405',
                    'data' => 'Method Not Allowed'
                ];
                return $this->respond($response, 405);
                }
            /**else {
                //get request from PostMan and more
                $input = $this->request->getRawInput();
                $data = [
                    'name' => $input['name'],
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                if ($data > 0) {
                    $this->model->update($id, $data);
    
                    $response = [
                        'status' => '200',
                        'data' => 'Success Update data'
                    ];
                    return $this->respond($response, 200);
                } else {
                    $response = [
                        'status' => '404',
                        'data' => 'Failed Update Data'
                    ];
                    return $this->respond($response, 404);
                }      
            }**/
        }
       
        
    }

    public function delete($id = null)
    {
        $delete = $this->model->find($id);
        if ($delete) {
            $this->model->delete($id);
            $response = [
                'status' => '200',
                'data' => 'Sukses Menghapus Data'
            ];
            return $this->respond($response, 200);
        } else {
                    $response = [
                        'status' => '404',
                        'data' => 'Failed Update Data'
                    ];
                    return $this->respond($response, 404);
                }    
        
    }
    
}