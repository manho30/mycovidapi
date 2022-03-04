<?php

$param = $_GET["date"];
$repo_url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

// no parameter
if(is_null($param)){
    header("Content-type: application/json");
    echo json_encode(array(
        "ok" => false,
        "status" => 400,
        "message" => "Parameter in yyyy-mm-dd was required",
    ));
} else {
    if($param == "all"){
        $curl = curl_init($repo_url);
        curl_setopt($curl, CURLOPT_URL, $repo_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $res = curl_exec($curl);
        curl_close($curl);
        
        $splited_csv = explode("\n", $res);
        $data_array = array_map("str_getcsv", $splited_csv);
        
        $data_name = array_shift($data_array);
        $length = count($data_array) - 1; 
        
        $name_array = [];
        foreach ($data_name as $name) {
            $name_array[] = $name;
        }

        $final_data = [];
        for ($i = 0; $i < $count; $i++) {
            $data = array_combine($name_array, $data_array[$i]);           
            $final_data[$j] = $data;
        }        

        header("Content-type: application/json");        
        echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                "result" => $final_data, 
        ));
    }
}
?>
