<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class AuthorController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('pages/authors');
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $author = new \App\Models\Author();
        $data = $author->find($id);
        if (!$data) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function list()
    {
        $author = new \App\Models\Author();
        $postData = $this->request->getPost();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value'];
        $sortby = $postData['order'][0]['column']; // Column index
        $sortdir = $postData['order'][0]['dir']; // asc or desc
        $sortcolumn = $postData['columns'][$sortby]['data']; // Column name

        // Total Records
        $totalRecords = $author->select('id')->countAllResults();

        // Total Records With Filter
        $totalRecordsWithFilter = $author->select('id')
            ->orLike('first_name', $searchValue)
            ->orLike('last_name', $searchValue)
            ->orLike('email', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        // Fetch records
        $records = $author->select('*')
            ->orLike('first_name', $searchValue)
            ->orLike('last_name', $searchValue)
            ->orLike('email', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id" => $record['id'],
                "first_name" => $record['first_name'],
                "last_name" => $record['last_name'],
                "email" => $record['email'],
                "birthdate" => $record['birthdate'],
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
        $author = new \App\Models\Author();
        $data = $this->request->getJSON();

        if (!$author->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $author->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $author->insert($data);
        $response = array(
            'status' => 'success',
            'message' => 'Author created successfully'
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
        $author = new \App\Models\Author();
        $data = $this->request->getJSON();
        unset($data->id);

        if (!$author->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $author->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $author->update($id, $data);
        $response = array(
            'status' => 'success',
            'message' => 'Author updated successfully'
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
        $author = new \App\Models\Author();

        if ($author->delete($id)) {
            $response = array(
                'status' => 'success',
                'message' => 'Author deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'message' => 'Author not found'
        );
        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }
}