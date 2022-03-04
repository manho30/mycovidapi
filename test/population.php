<?php
$url = "https://github.com/MoH-Malaysia/covid19-public/blob/main/static/population.csv";

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

for ($j = 0;$j < count($data_array) - 1;$j++) {
    $data = array_combine($column_name, $data_array[$j]);
    $final_data[$j] = $data;
}

header("Content-type: application/json");

http_response_code(200);

echo json_encode(array(
    "ok" => true,
    "status" => 200,
    "result" => "Hello World" ,
));
?>
