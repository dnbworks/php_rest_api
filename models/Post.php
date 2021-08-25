<?php

class Post {
    private $conn;
    private $table = 'posts';


    // post properties

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;


    // constructor with db

    public function __construct($db)
    {
        $this->conn = $db;

    }

    // get post
    public function read(){
        $sql = 'SELECT c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
                FROM 
                ' . $this->table . ' p
                LEFT JOIN
                  category c ON p.category_id = c.id
                  ORDER BY p.created_at DESC';
        
        // prepared statement

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}