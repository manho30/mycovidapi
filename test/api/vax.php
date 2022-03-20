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
        "message" => $output[count($output) - 1]
    ));
    
} else {
    if($date == "all"){
        $src = file_get_contents("https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_malaysia.csv");
        $csv = array_map("str_getcsv", explode("\n", $src));
    
        $variable = [];

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
    } else {
        $src = file_get_contents("https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_malaysia.csv");
        $csv = array_map("str_getcsv", explode("\n", $src));
    
        $variable = [];

        foreach ($csv[0] as $head_name){
            $variable[] = $head_name;
        }
    
        $output = [];
        for ($i = 0; $i < count($csv) - 1; $i++){
            $combines = array_combine($variable, $csv[$i]);
            $output[$i] = $combines;
        } 

        $index = array_search($date, array_column(json_decode(json_encode($output), true), "date")); 
/*
        $msg = "";
        $code = 404;
        $ok = false;

        if (!$index) {
            $msg = "Invalid query! Could not found in Malaysia Repository! Please try again!";
        } else {
            $msg = json_decode(output)[$index];
            $code = 200;
            $ok = true;
        }
*/ 
        header("Content-type: application/json");
        http_response_code(code);
        
        echo json_encode(array(
            "ok" => true,
            "status" => 400,
            "message" => $index
        ));
    } 
}
?>
