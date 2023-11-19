<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Shield\Entities\User;

class UserRoleController extends ResourceController
{

     /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $userRole = new \App\Models\UserRole();
        $data['user_id'] = $userRole->findAll();

        return view('pages/userRoles',$data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $user = new \App\Models\User();
        $data = $user->select('users.*, auth_groups_users.group, auth_groups_users.id AS auth_id')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
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
        ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
        ->orLike('auth_groups_users.group', $searchValue)
            ->orLike('users.username', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        // Fetch records
        $records = $user->select('users.*, auth_groups_users.group, auth_groups_users.id AS auth_id')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->orLike('auth_groups_users.group', $searchValue)
            ->orLike('users.username', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id" => $record['id'],
                "username" => $record['username'],
                "group" => $record['group'],
                "created_at" => $record['created_at'] ? $record['created_at']  : null ,

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
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $user = new \App\Models\UserRole();
        $data = $this->request->getJSON();

        unset($data->id);

        if (!$user->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $user->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }
        
        $udpate = array();
        $udpate['group'] = $data->group;
        $udpate['create_at'] = date("Y-m-d H:i:s");

        $user->update($id, $udpate);
        $response = array(
            'status' => 'success',
            'message' => 'Post updated successfully'
        );

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    
}
