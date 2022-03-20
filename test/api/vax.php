<?php

$date = $_GET["date"];

/* return latest data if 
 * no query is specific. 
 * @return {object} 
 */ 
if (!$date) {

    $src = file_get_contents("https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_malaysia.csv");
    $csv = array_map("str_getcsv", explode("\n", $src));
    
    $variable = [];
    //$var = array_shift($csv);

    foreach ($csv[0] as $head_name){
        $variable[] = $head_name;
    }
    
    $output = [];
    for ($i = 0; $i < count($csv) - 1; $i++){
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
