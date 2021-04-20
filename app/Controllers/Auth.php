<?php namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\AuthModel';

    public function create()
    {
        
        $user = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        $cek = $this->model->cek_login($user,$password);
        if ($cek) {
            $response = [
                'id' => '2',
                'data' => $cek
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            $response = [
                'id' => '404',
                'data' => 'User Not Found'
            ];
            return $this->response->setStatusCode(404)->setJSON($response);
        }
    }

    
}