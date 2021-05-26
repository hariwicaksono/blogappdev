<?php namespace App\Controllers;

use \Appkita\CI4Restfull\RestfullApi;

class ImageUpload extends RestfullApi
{
    protected $format       = 'json';
    protected $auth = ['key'];
	public function create()
    {
        $gambar = $this->request->getFile('foto');
        $fileName = $gambar->getName();
        if ($gambar !== "") {
            $gambar->move('images/', $fileName);
            $response = [
                'status' => '201',
                'data' => 'Image Upload Success'
            ];
            return $this->respond($response, 201);
        } else {
            $response = [
                'status' => '422',
                'data' => 'Failed Upload Data'
            ];
            return $this->respond($response, 422);
        }
    }
    
}