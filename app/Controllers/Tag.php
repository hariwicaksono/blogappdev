<?php namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\RESTful\ResourceController;

class Tag extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\BlogModel';
    
    public function show($id = null)
    {
        $id=$this->request->getVar('category');

        if ($id == null) {
			return $this->respond(['status' => '0','data'=> 'id tidak boleh kosong']);
		} else {
			$search = $this->model->searchTag($id);
		}
		
        if ($search) {
            $response = [
                'status' => '1',
                'data' => $search
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => '0',
                'data' => 'Data Not Found'
            ];
            return $this->respond($response, 404);
        }
    }

}