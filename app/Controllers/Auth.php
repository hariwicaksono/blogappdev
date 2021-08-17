<?php namespace App\Controllers;

use App\Models\AuthModel;
use \Appkita\CI4Restfull\RestfullApi;

class Auth extends RestfullApi
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\AuthModel';

    protected $auth = ['key'];

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
                        'id' => 1,
                        'status' => true,
                        'message' =>'Anda telah berhasil Login',
                        'data' => $cek
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'Username atau Password tidak sesuai',
                        'data' => []
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                }
            } else {
                $user = $this->request->getPost('username');
                $password = md5($this->request->getPost('password'));

                $cek = $this->model->cek_login($user,$password);
                if ($cek) {
                    $response = [
                        'id' => 1,
                        'status' => true,
                        'message'=>'Anda telah berhasil Login',
                        'data' => $cek
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                } else {
                    $response = [
                        'status' => false,
                        'message' => 'Username atau Password tidak sesuai',
                        'data' => []
                    ];
                    return $this->response->setStatusCode(200)->setJSON($response);
                }
            }
        } 
        
    }   

    
}