<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class OfficeController extends ResourceController
{
    public function index()
    {
        return view('pages/offices');
    }

        /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $office = new \App\Models\Office();
        $data = $office->find($id);
        if (!$data) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }
        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function list()
    {
        $office = new \App\Models\Office();
        $postData = $this->request->getPost();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value'];
        $sortby = $postData['order'][0]['column']; // Column index
        $sortdir = $postData['order'][0]['dir']; // asc or desc
        $sortcolumn = $postData['columns'][$sortby]['data']; // Column name

        // Total Records
        $totalRecords = $office->select('id')->countAllResults();

        // Total Records With Filter
        $totalRecordsWithFilter = $office->select('id')
            ->orLike('office', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        // Fetch records
        $records = $office->select('*')
            ->orLike('office', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id" => $record['id'],
                "office" => $record['office'],
                "code" => $record['code'],
                "description" => $record['description']
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
        $office = new \App\Models\Office();
        $data = $this->request->getJSON();

        if (!$office->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $office->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $office->insert($data);
        $response = array(
            'status' => 'success',
            'message' => 'Office created successfully'
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
       
        $office = new \App\Models\Office();
        $data = $this->request->getJSON();
        
        //unset($data->id);
        if (!$office->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $office->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $office->update($id, $data);
        $response = array(
            'status' => 'success',
            'message' => 'office updated successfully'
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
        $office = new \App\Models\Office();

        if ($office->delete($id)) {
            $response = array(
                'status' => 'success',
                'message' => 'office deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'message' => 'office not found'
        );
        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }
}
