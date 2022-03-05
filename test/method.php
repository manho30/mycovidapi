<?php
if ($_SERVER['REQUEST_METHOD'] != 'GET' || $_SERVER['REQUEST_METHOD'] != 'POST') {
   
    echo json_encode(array(
        "ok"=> false, 
        "status"=>405, 
        "message"=> $_SERVER['HTTP_HOST'], 
    ));
} else {
    echo json_encode(array(
        "ok"=> true, 
        "status"=> 200, 
        "message"=> "HTTP success", 
    ));
} 
?>
