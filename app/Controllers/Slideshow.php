<?php namespace App\Controllers;

use App\Models\SlideshowModel;
use CodeIgniter\RESTful\ResourceController;

class Slideshow extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\SlideshowModel';

	public function index()
	{
        $id=$this->request->getVar('id');

        if ($id == null) {
			$data = $this->model->getSlideshow();
		} else {
			$data = $this->model->getSlideshow($id);
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
        
        $data = [
            'img_slide' => $this->request->getPost('foto'),
            'text_slide' => $this->request->getPost('text_slide'),
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
                'text_slide' => $input['text_slide'],
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
        }

        
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