<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class PostController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $author = new \App\Models\Author();
        $data['authors'] = $author->findAll();

        return view('pages/posts',$data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $post = new \App\Models\Post();
        $data = $post->find($id);
        if (!$data) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function list()
    {
        $post = new \App\Models\Post();
        $postData = $this->request->getPost();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value'];
        $sortby = $postData['order'][0]['column']; // Column index
        $sortdir = $postData['order'][0]['dir']; // asc or desc
        $sortcolumn = $postData['columns'][$sortby]['data']; // Column name

        // Total Records
        $totalRecords = $post->select('id')->countAllResults();

        // Total Records With Filter
        $totalRecordsWithFilter = $post->select('posts.id')
            ->join('authors', 'authors.id = posts.author_id')
            ->orLike('authors.first_name', $searchValue)
            ->orLike('authors.last_name', $searchValue)
            ->orLike('posts.title', $searchValue)
            ->orLike('posts.description', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        // Fetch records
        $records = $post->select('posts.*, CONCAT(authors.first_name, " ", authors.last_name) as author_name')
            ->join('authors', 'authors.id = posts.author_id')
            ->orLike('authors.first_name', $searchValue)
            ->orLike('authors.last_name', $searchValue)
            ->orLike('posts.title', $searchValue)
            ->orLike('posts.description', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id" => $record['id'],
                "author_name" => $record['author_name'],
                "title" => $record['title'],
                "description" => $record['description'],
                "created_at" => $record['created_at'],
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
        $post = new \App\Models\Post();
        $data = $this->request->getJSON();

        if (!$post->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $post->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $post->insert($data);
        $response = array(
            'status' => 'success',
            'message' => 'Post created successfully'
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
        $post = new \App\Models\Post();
        $data = $this->request->getJSON();
        unset($data->id);

        if (!$post->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => $post->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $post->update($id, $data);
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
        $post = new \App\Models\Post();

        if ($post->delete($id)) {
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