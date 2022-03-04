<?php
// param
$date_request = $_GET["date"];
if ($date_request == "") {
    header("Content-type: application/json");

    http_response_code(400);

    echo json_encode(array(
        "ok" => false,
        "status" => 400,
        "description" => "Parameter in yyyy-mm-dd was required",
    ));
}
else {
    if ($date_request == "all") {
        $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/icu.csv";

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

        //      My skill too trash, i can't make the old data be format :(
        //      make the every single day data to array of arrays from
        //      only the data start from 7 May 2021 providing Putrajaya icu data
        //      but some day is still missing Putrajaya's data
        //      Here start collecting data from 1 July 2021.
        $full_data = $final_data;
        $final_full_data = array_splice($full_data, 7031);

        //      before 5 Jan 2021 the Putrajaya data was missing
        //      $final_notfull_data = $final_data;
        //      $array_splice($final_notfull_data, 7031);
        $full_data_array = array_chunk($final_full_data, 16);
        //      $notfull_data_array = array_chunk($final_notfull_data, 15);
        //      $final_data = array_merge($full_data_array, $notfull_data_array);
        header("Content-type: application/json");

        http_response_code(200);

        echo json_encode(array(
            "ok" => true,
            "status" => 200,
            "result" => $full_data_array,
        ));

    }
    else if ($date_request == "now") {
        $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/icu.csv";

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

        for ($j = 0;$j < $count;$j++) {
            $data = array_combine($column_name, $data_array[$j]);

            $final_data[$j] = $data;
        }

        $full_data = array_splice($final_data, -4320);

        $full_data_array = array_chunk($full_data, 16);

        // get last array element
        $now_data = $full_data_array[count($full_data_array) - 1];

        //state parameter
        $state_request = $_GET["state"];

        // no specify parameterized
        if (empty($state_request)) {
            header("Content-type: application/json");

            http_response_code(200);

            echo json_encode(array(
                "ok" => true,
                "status" => 2000,
                "result" => $now_data
            ));

            // if has parameter for state
            
        }
        else {
            $array_number = array_search($state_request, array_column($latest_date, "state"));
            if ($array_number == "") {

                header("Content-type: application/json");

                http_response_code(400);

                echo json_encode(array(
                    "ok" => false,
                    "status" => 400,
                    "description" => "Invalid state or no such data from Malaysia Database! Please try again!",
                ));

            }
            else {
                header("Content-type: application/json");

                http_response_code(200);

                echo json_encode(array(
                    "ok" => true,
                    "status" => 200,
                    "result" => $latest_date[$array_number],
                ));
            }
        }
    }
    else {
        echo json_encode(array(
            "ok" => false,
            "status" => 404,
            "message" => "Invalid date or no such data from Malaysia Database! Please try again!",
        ));
    }
}
?>
