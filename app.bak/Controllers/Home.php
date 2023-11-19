<?php

namespace App\Controllers;

use CodeIgniter\Database\RawSql;

class Home extends BaseController
{
    public function index(): string
    {
        // $db = \Config\Database::connect();
        // $builder = $db->table('authors');

        // $query = $builder->get(); //SELECT * FROM authors;

        // $query = $builder->getWHere(['id' => 1]); //SELECT * FROM authors WHERE id = 1;

        // $builder->select('id, first_name');
        // $query = $builder->get(); //SELECT id, first_name FROM authors;

        // $builder->select('id, CONCAT(first_name, " ", last_name) as full_name');
        // $query = $builder->get(); //SELECT id, CONCAT(first_name, " ", last_name) as full_name FROM authors;

        // $sql = "CONCAT(first_name, ' ', last_name) as full_name";
        // $builder->select(new RawSql($sql));
        // $query = $builder->get(); //SELECT CONCAT(first_name, ' ', last_name) as full_name FROM authors;

        // $builder->selectMax('id');
        // $query = $builder->get(); //SELECT MAX(id) FROM authors;

        // $builder->selectMin('id');
        // $query = $builder->get(); //SELECT MIN(id) FROM authors;

        // $builder->selectAvg('id');
        // $query = $builder->get(); //SELECT AVE(id) FROM authors;

        // $builder->selectSum('id');
        // $query = $builder->get(); //SELECT SUM(id) FROM authors;

        // $builder->selectCount('id');
        // $query = $builder->get(); //SELECT COUNT(id) FROM authors;

        // $builder->select('id as authorid');
        // $query = $builder->get(); //SELECT id as authorid FROM authors;

        // $builder->select('posts.*, CONCAT(authors.first_name, " ", authors.last_name) as author_name');
        // $builder->join('posts', 'posts.author_id = authors.id');
        // $builder->where('posts.id', 1);
        
        // $query = $builder->get(); //SELECT posts.*, CONCAT(authors.first_name, " ", authors.last_name) as author_name FROM authors JOIN posts ON posts.author_id = authors.id WHERE posts.id = 1;

        // $builder->select('*');
        // $builder->where('id', 1);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id = 1;

        // $builder->select('*');
        // $builder->where('first_name', 'Guilberto');
        // $builder->where('last_name', 'Gottlieb');
        // $query = $builder->get(); //SELECT * FROM authors WHERE first_name = 'Guilberto' AND last_name = 'Gottlieb';

        // $builder->select('*');
        // $builder->where('id', 1);
        // $builder->orWhere('id', 2);
        // $builder->orWhere('id', 3);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id = 1 OR id = 2;

        // $builder->select('*');
        // $builder->where('id >', 1);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id > 1;

        // $builder->select('*');
        // $builder->where('id !=', 2);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id != 2;

        // $builder->select('*');
        // $builder->where('id >=', 2);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id >= 2;

        // $builder->select('*');
        // $builder->whereIn('id', [1, 3, 4]);

        // $query = $builder->get(); //SELECT * FROM authors WHERE id IN (1, 3, 4);

        // $builder->select('*');
        // $builder->like('first_name', 'a');
        // $query = $builder->get(); //SELECT * FROM authors WHERE first_name LIKE '%a%';


        // $builder->select('*');
        // $builder->like('first_name', 'a');
        // $builder->like('last_name', 'a');
        // $query = $builder->get(); //SELECT * FROM authors WHERE first_name LIKE '%a%' AND last_name LIKE '%a%';

        // $builder->select('*');
        // $builder->orderBy('id', 'DESC');
        // $query = $builder->get(); //SELECT * FROM authors ORDER BY id DESC;

        // $builder->select('*');
        // $builder->orderBy('id', 'ASC');
        // $query = $builder->get(); //SELECT * FROM authors ORDER BY id ASC;

        // $builder->select('*');
        // $builder->groupBy('first_name');
        // $query = $builder->get(); //SELECT * FROM authors GROUP BY first_name;

        // $data = [
        //     'first_name' => 'RUFINO JOHN',
        //     'last_name' => 'AGUILAR',
        //     'email' => 'aguilarufino@gmail.com',
        //     'birthdate' => '1989-01-01',
        //     'added' => date('Y-m-d H:i:s')
        // ];

        // $builder->insert($data); //INSERT INTO authors (first_name, last_name, email, birthdate, added) VALUES ('RUFINO JOHN', 'AGUILAR', 'aguilarufino@gmail', '1989-01-01', '2021-01-01 00:00:00');

        // $builder->select('*');
        // $builder->where('last_name', 'AGUILAR');
        // $query = $builder->get(); //SELECT * FROM authors WHERE last_name = 'AGUILAR';

        //  $data = [
        //     'first_name' => 'RUFINO',
        // ];

        // $builder->where('id', 101);
        // $builder->update($data); //UPDATE authors SET first_name = 'RUFINO' WHERE id = 101;

        // $builder->select('*');
        // $builder->where('id', 101);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id = 101;

        // $builder->where('id', 101);
        // $builder->delete(); //DELETE FROM authors WHERE id = 101;

        // $builder->select('*');
        // $builder->where('id', 101);
        // $query = $builder->get(); //SELECT * FROM authors WHERE id = 101;




        // $authors = $query->getResult();
            
        // return json_encode($authors);

        return view('welcome_message');
    }
}