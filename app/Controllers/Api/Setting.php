<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\SettingModel;

class Setting extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = SettingModel::class;

	public function index()
	{
        $id = '1';
        $data = [
            'status' => true,
            'message' => lang('App.successGetAllData'),
            'data' => $this->model->find($id)
        ];

        return $this->respond($data, 200);
    }
    
    public function update($id = null)
    {
        $rules = [
            'title' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'company' => $input->company,
                'website' => $input->website,
                'phone' => $input->phone,
                'email' => $input->email,
                'theme' => $input->theme,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'company' => $input['company'],
                'website' => $input['website'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'theme' => $input['theme'],
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
            $simpan = $this->model->update($id,$data);
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

    public function setLanding($id = null)
    {
        $rules = [
            'landing_intro' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $input = $this->request->getJSON();
            $data = [
                'landing_intro' => $input->landing_intro,
                'landing_link' => $input->landing_link,
                'landing_img' => $input->foto
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'landing_intro' => $input['landing_intro'],
                'landing_link' => $input['landing_link'],
                'landing_img' => $input['foto']
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
            $simpan = $this->model->update($id,$data);
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
}