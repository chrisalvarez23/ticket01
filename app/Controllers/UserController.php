<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Shield\Entities\User;

class UserController extends ResourceController
{

     /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $user = new \App\Models\User();
        $data['user'] = $user->findAll();

        return view('pages/users',$data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $user = new \App\Models\User();
        $data = $user->select('users.*, auth_identities.secret as email')
            ->join('auth_identities', 'auth_identities.user_id = users.id')
            ->find($id);

        if (!$data) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function list()
    {
        $user = new \App\Models\User();
        $postData = $this->request->getPost();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value'];
        $sortby = $postData['order'][0]['column']; // Column index
        $sortdir = $postData['order'][0]['dir']; // asc or desc
        $sortcolumn = $postData['columns'][$sortby]['data']; // Column name

        // Total Records
        $totalRecords = $user->select('id')->countAllResults();

        // Total Records With Filter
        $totalRecordsWithFilter = $user->select('users.id')
            ->join('auth_identities', 'auth_identities.user_id = users.id')
            ->orLike('auth_identities.secret', $searchValue)
            ->orLike('users.username', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        // Fetch records
        $records = $user->select('users.*, auth_identities.secret, auth_identities.secret2')
            ->join('auth_identities', 'auth_identities.user_id = users.id')
            ->orLike('auth_identities.secret', $searchValue)
            ->orLike('users.username', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id" => $record['id'],
                "username" => $record['username'],
                "secret" => $record['secret'],
                "created_at" => $record['created_at'] ? $record['created_at']  : null ,
                "updated_at" => $record['updated_at'] ? $record['updated_at'] : null,
                "deleted_at" => $record['deleted_at'] ? $record['deleted_at'] : null
            );
        }

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data" => $data
        );

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $user = new \App\Models\User();
        $data = $this->request->getJSON();

        if (!$user->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $user->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $users = auth()->getProvider();

        $user = new User([
            'username' => $data->username,
            'email'    => $data->email,
            'password' => $data->password,
            'addgroup' => 'user',
        ]);
        
        $users->save($user);
        
        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());
        
        // Add to default group
        $users->addToDefaultGroup($user);

        $response = array(
            'status' => 'success',
            'message' => 'User created successfully'
        );

        return $this->response->setStatusCode(Response::HTTP_CREATED)->setJSON($response);
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $user = new \App\Models\User();
        $data = $this->request->getJSON();

        unset($data->id);

        if (!$user->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $user->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        
        // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();

        $user_m = $users->findById(13);
        $user_m->fill([
            'username' => $data->username,
            'email'    => $data->email,
            'password' => $data->password,
            'addgroup' => 'user',
        ]);
        $users->save($user_m);
        // $user_m->forcePasswordReset();


        $response = array(
            'status' => 'success',
            'message' => 'User updated successfully'
        );

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $user = new \App\Models\User();

        $users = auth()->getProvider();
        if ($users->delete($id, true)) {
            $response = array(
                'status' => 'success',
                'message' => 'User deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'message' => 'Post not found'
        );
        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }
}
