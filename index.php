<?php
// parameter in url
$req_param = $_GET["date"];

// moh github repo
$url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

// no date parameter
if (empty($date_request)) {
    header("Content-type: application/json");
    echo json_encode(
        "ok" => "false",
        "status" => "400",
        "Message" => "Parameter in yyyy-mm-dd was required. Please try again! ",
    );
} else {
    
    // if request all data
    if ($date_request == "all") {
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
        echo json_encode($final_data);
        
    } else {
        // if request latest data
        if ($date_request == "latest") {

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
                $final_data[$j] = array_combine($column_name, $data_array[$j]);
            }

            header("Content-type: application/json");
            echo json_encode(json_decode(json_encode($final_date )[count(json_decode(json_encode($final_data))) - 1]); 
            
        } else {
            $url =
                "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

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
            $data = json_encode($final_data);

            $array_number = array_search(
                $date_request,
                array_column(json_decode($data, true), "date")
            );
            if ($array_number == "") {
                header("Content-type: application/json");
                echo json_encode(
                    "ok" => "false",
                    "status" => "404",
                    "Message" => "Invalid date, request not found! Please edit the date parameter and try again! ",
                ); 
            } else {
                $data2 = json_decode($data);
                $datedata = $data2[$array_number];
                echo json_encode($datedata);
            }
            exit();
        }
    }
}
