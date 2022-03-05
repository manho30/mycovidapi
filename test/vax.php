<?php
$query = $_GET("date");

if(!query){
    $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);
    curl_close($curl);

    $data_array = array_map("str_getcsv", explode("\n", $response));
    $data_name = [];
    $data_list = array_shift($data_array);

    foreach ($data_list as $list) {
        $data_name[] = $lis5;
    }

    for ($i = 0; $i < count($data_array) - 1; $i++) {
        $data = array_combine($data_name, $data_array[$i]);
        $out_data[$i] = $data;
    }
    header("Content-type: application/json");
    http_response_code(200);

    echo json_encode(array(
        "ok"=> true, 
        "status" => 200,
        "result" => $out_data, 
    ));
}
?>
