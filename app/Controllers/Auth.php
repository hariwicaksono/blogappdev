<?php namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\AuthModel';

    public function create()
    {
        if ($this->request)
        {
            //get request from Reactjs
            if($this->request->getJSON()) {
                $json = $this->request->getJSON();
                $user = $json->username;
                $password = md5($json->password);

                $cek = $this->model->cek_login($user,$password);
                if ($cek) {
                    $response = [
                        'id' => '1',
                        'data' => $cek
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                } else {
                    $response = [
                        'id' => '404',
                        'data' => 'User Not Found'
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                }
            } else {
                $user = $this->request->getPost('username');
                $password = md5($this->request->getPost('password'));

                $cek = $this->model->cek_login($user,$password);
                if ($cek) {
                    $response = [
                        'id' => '1',
                        'data' => $cek
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                } else {
                    $response = [
                        'id' => '404',
                        'data' => 'User Not Found'
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                }
            }
        } else{
			$response = [
				'id'=> '404',
				'data' => 'Data Not Found'
			];
            return $this->response->setStatusCode(200)->setJSON($response);
		}
        
    }   

    
}