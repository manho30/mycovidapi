<?php

include_once '../../src/path/source.php';

$date = $_GET["date"];
/**
if ($_SERVER['REQUEST_METHOD'] =='DELETE' || $_SERVER['REQUEST_METHOD'] == 'PUT') {
    header("Content-type: application/json");

    http_response_code(405);

    echo json_encode(array(
        "ok"=> false, 
        "status" => 405,
        "message" => "Method not accepted, use GET or POST instead!" , 
    ));
    die();
}
**/
/* return latest data if 
 * no query is specific. 
 * @return {object} 
 */ 
if (!$date) {

    $src = file_get_contents($vax_my);
    $csv = array_map("str_getcsv", explode("\n", $src));
    
    $variable = [];
    foreach ($csv[0] as $head_name){
        $variable[] = $head_name;
    }
    
    $output = [];
    for ($i = 0; $i < count($csv) - 1; $i++){
        if ($i === 0) {continue;}
        $combines = array_combine($variable, $csv[$i]);
        $output[$i] = $combines;
    } 
    header("Content-type: application/json");
    http_response_code(200);
        
    echo json_encode(array(
        "ok" => true,
        "status" => 200,
        "message" => $output
    ));
    
}
?>
