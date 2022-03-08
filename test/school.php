<?php

if ($_SERVER['REQUEST_METHOD'] !='POST') {
    die();
}

$url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_school.csv";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

$column_name = [];

$final_data = [];

$data_array = array_map("str_getcsv", explode("\n", $resp));

$labels = array_shift($data_array);

foreach ($labels as $label) {
    $column_name[] = $label;
}

$count = count($data_array) - 1;

for ($j = 0; $j < $count; $j++) {
    $data = array_combine($column_name, $data_array[$j]);
    $final_data[$j] = $data;
}

header("Content-type: application/json");

http_response_code(200);

echo json_encode(array(
    "ok"=> true, 
    "status" => 200,
    "result" => $final_data, 
));

?>
