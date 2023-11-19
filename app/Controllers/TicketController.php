<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class TicketController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $office = new \App\Models\Office();
        $data['offices'] = $office->findAll();

        return view('pages/tickets',$data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $ticket = new \App\Models\Ticket();
        $data = $ticket->find($id);
        if (!$data) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function list()
    {
        $ticket = new \App\Models\Ticket();
        $postData = $this->request->getPost();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value'];
        $sortby = $postData['order'][0]['column']; // Column index
        $sortdir = $postData['order'][0]['dir']; // asc or desc
        $sortcolumn = $postData['columns'][$sortby]['data']; // Column name

        // Total Records
        $totalRecords = $ticket->select('id')->countAllResults();

        // Total Records With Filter
        $totalRecordsWithFilter = $ticket->select('ticket.id')
            ->join('office', 'office.id = ticket.office_id')
            ->orLike('ticket.first_name', $searchValue)
            ->orLike('ticket.last_name', $searchValue)
            ->orLike('office.office', $searchValue)
            ->orLike('ticket.description', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        // Fetch records
        $records = $ticket->select('ticket.*, office.office')
            ->join('office', 'office.id = ticket.office_id')
            ->orLike('ticket.first_name', $searchValue)
            ->orLike('ticket.last_name', $searchValue)
            ->orLike('office.office', $searchValue)
            ->orLike('ticket.description', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id" => $record['id'],
                "first_name" => $record['first_name'],
                "last_name" => $record['last_name'],
                "email" => $record['email'],
                "office" => $record['office'],
                "severity" => $record['severity'],
                "description" => $record['description'],
                "status" => $record['status']
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
        $ticket = new \App\Models\Ticket();
        $data = $this->request->getJSON();


        //print_r($data);
        if (!$ticket->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $ticket->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }
        
        $udpate = array();
        $udpate['first_name'] = $data->first_name;
        $udpate['last_name'] = $data->last_name;
        $udpate['email'] = $data->email;
        $udpate['office_id'] = $data->office_id;
        $udpate['severity'] = $data->severity;
        $udpate['description'] = $data->description;
        $udpate['status'] = 'pending';
        $udpate['created_at'] = date("Y-m-d H:i:s");
        //$udpate['updated_at'] = null;
        //$udpate['acccomplished_at'] = null;

        $ticket->insert($udpate);
        $response = array(
            'status' => 'success',
            'message' => 'Ticket created successfully'
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
        $ticket = new \App\Models\Ticket();
        $data = $this->request->getJSON();

        $udpate = array();
        $udpate['first_name'] = $data->first_name;
        $udpate['last_name'] = $data->last_name;
        $udpate['email'] = $data->email;
        $udpate['office_id'] = $data->office_id;
        $udpate['severity'] = $data->severity;
        $udpate['description'] = $data->description;
       // $udpate['created_at'] = null;
        //$udpate['updated_at'] = date("Y-m-d H:i:s");
      //  $udpate['acccomplished_at'] = null;

        unset($data->id);

        if (!$ticket->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $post->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $ticket->update($id, $udpate);
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
    public function delete($id = null)
    {
        $ticket = new \App\Models\Ticket();

        if ($ticket->delete($id)) {
            $response = array(
                'status' => 'success',
                'message' => 'Post deleted successfully'
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