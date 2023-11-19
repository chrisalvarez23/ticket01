<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class DashboardController extends ResourceController
{
    public function index()
    {
        $ticket = new \App\Models\Ticket();


        $data['totalcritical'] = $ticket->where('severity','C')->countAllResults();
        $data['totalhigh'] = $ticket->where('severity','H')->countAllResults();
        $data['totalmedium'] = $ticket->where('severity','M')->countAllResults();
        $data['totallow'] = $ticket->where('severity','L')->countAllResults();


        $data['totalpending'] = $ticket->where('status','pending')->countAllResults();
        $data['totalprocessing'] = $ticket->where('status','processing')->countAllResults();
        $data['totalresolved'] = $ticket->where('status','resolved')->countAllResults();
        $data['totaltotal'] = $ticket->countAll();


        $office = new \App\Models\Office();
        $data['offices'] = $office->findAll();

        return view('pages/dashboard',$data);

    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $ticket = new \App\Models\Dashboard();
        $data = $this->request->getJSON();

        $udpate = array();
        $udpate['status'] = $data->status;

        unset($data->id);

        if (!$ticket->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $ticket->errors()
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
}