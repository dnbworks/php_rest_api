<?php

header('Access-Control-Allow-Origin: *');
header('content-Type: application/json');

include_once('../config/Database.php');
include_once('../models/Post.php');

// Instantiate Db & connect

$database = new Database();
$db = $database->connect();

// Instantiate Post blog object

$post = new Post($db);


// query
$result = $post->read();

// get row count
$rowcount = $result->rowCount();


// check if there's posts
if($rowcount > 0){
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // push to data
        array_push($post_arr['data'], $post_item);
    }

    // turn to JSON

    echo  json_encode($post_arr);

} else {
    echo json_encode(
        array(
            'message' => 'No posts found'
        )
    );
}


