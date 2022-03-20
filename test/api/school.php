<?php

$school = $_GET["school"];

/* return latest data if 
 * no query is specific. 
 * @return {object} 
 */ 
if (!$school) {

    $src = file_get_contents("https://raw.githubusercontent.com/manho30/covid19-public/main/vaccination/vax_school.csv");
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
    if($school){

        $src = file_get_contents("https://raw.githubusercontent.com/manho30/covid19-public/main/vaccination/vax_school.csv");
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

        $code_index = array_search($school, array_column(json_decode(json_encode($output), true), "code")); 
        $school_index = array_search($school, array_column(json_decode(json_encode($output), true), "school")); 

        if (!$code_index && !$school_index) {

            header("Content-type: application/json");
            http_response_code(404);

            echo json_encode(array(
                "ok" => false,
                "status" => 404,
                "message" => "Invalid query! Could not found in Malaysia Repository! Please try again!"
            ));

        } else if($code_index || $school_index){

            $value = $code_index == false ? false : true;

            $index;

            if(value){
                $index  = $code_index;
            } else {
                $index  = $school_index;
            }
            header("Content-type: application/json");
            http_response_code(200);

            echo json_encode(array(
                "ok" => true,
                "status" => 200,
                "message" => $output[$index]
            ));
        }       
    } 
}
?>
