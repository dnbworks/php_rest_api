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
} else {

}