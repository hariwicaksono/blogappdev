<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;
use App\Models\AuthModel;

class Auth extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = AuthModel::class;

    /**
     * Authenticate Existing User
     * @return Response
     * @throws ReflectionException
     */
    public function login()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput();

        if (!$this->validate($rules, $errors)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_OK
                );
        }

        return $this->getJWTForUser($input['email']);
    }

    private function getJWTForUser(
        string $emailAddress,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        try {
            $user = $this->model->findUserByEmailAddress($emailAddress);
            unset($user['password']);

            $query = $this->model->where(['email' => $emailAddress])->first();
            $isuser = $query['status_user'];

            helper('jwt');

            if ($isuser == "Admin") {
            return $this
                ->getResponse(
                    [
                        'status' => true,
                        'message' => 'Admin authenticated successfully',
                        'data' => $user,
                        'isadmin' => true,
                        'access_token' => getSignedJWTForUser($emailAddress)
                    ]
                );
            } else {
                return $this
                ->getResponse(
                    [
                        'status' => true,
                        'message' => 'User authenticated successfully',
                        'data' => $user,
                        'isuser' => true,
                        'access_token' => getSignedJWTForUser($emailAddress)
                    ]
                );
            }
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
    
}