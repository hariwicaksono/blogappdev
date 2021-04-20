<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ImageUpload extends ResourceController
{
    protected $format       = 'json';

	public function create()
    {
        $gambar = $this->request->getFile('foto');
        $fileName = $gambar->getName();
        if ($gambar !== "") {
            $gambar->move('public/images/', $fileName);
            $response = [
                'status' => '1',
                'data' => 'Image Upload Success'
            ];
            return $this->respond($response, 201);
        } else {
            $response = [
                'status' => '0',
                'data' => 'Failed Upload Data'
            ];
            return $this->respond($response, 422);
        }
    }
    
}