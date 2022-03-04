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
} else {
    if ($date_request == "all") {
        $url =
            "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/icu.csv";

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

    } else {
        if ($date_request == "now") {
            $url =
                "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/icu.csv";

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
            
            $full_data = array_splice($final_data, - 4320); 
          
            $full_data_array = array_chunk($full_data, 16);
                        
            // get last array element 
            $now_data = $fully_data_array[count($full_data_array) - 1 ];
            
            //state parameter 
            $state_request = $_GET["state"];
           
            // no specify parameterized
            if (empty($state_request)) {
                header("Content-type: application/json");
                
                http_response_code(200);

                echo json_encode(array(
                    "ok"=> true, 
                    "status" => 2000,
                    "result" => $full_data
                ));
                
            // if has parameter for state 
            } else {
                $array_number = array_search(
                    $state_request,
                    array_column($latest_date, "state")
                );
                if ($array_number == "") {
                    
                    header("Content-type: application/json");
                    
                    http_response_code(400);

                    echo json_encode(array(
                        "ok"=> false, 
                        "status" => 400,
                        "description" => "Invalid state or no such data from Malaysia Database! Please try again!",
                    ));
                    
                } else {
                    header("Content-type: application/json");

                    http_response_code(200);
                    
                    echo json_encode(array(
                        "ok"=> true, 
                        "status" => 200,
                        "result" => $latest_date[$array_number], 
                    ));
                }
            }
        } else {
            $url =
                "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/icu.csv";

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
            
            $data = array_chunk($final_data, 16);
            $count = count($data);
            $latest_date_count = $count - 1;
            $latest_date = $data[$latest_date_count][0]["date"];
            $date1 = new DateTime($latest_date);
            $date2 = new DateTime($date_request);
            $diff = $date1->diff($date2);
            $diff_day = $diff->days;
            $requested_date_count = $latest_date_count - $diff_day;
            $latest_date_data = $data[$requested_date_count];
            $output_date_data = $latest_date_data[0]["date"];
            if ($output_date_data !== $date_request) {                
                header("Content-type: application/json");
   
                http_response_code(404);
             
                echo json_encode(array(
                    "ok" => false,
                    "status" => 404, 
                    "message" => "Invalid date or no such data from Malaysia Database! Please try again!",
                )); 
                
            } else {
                $state_request = $_GET["state"];
                if (empty($state_request)) {
                    header("Content-type: application/json");

                    http_response_code(200);
                    
                    echo json_encode(array(
                        "ok"=> true, 
                        "status" => 200,
                        "result" =>$latest_date_data, 
                    ));
                    
                } else {
                    $array_number = array_search(
                        $state_request,
                        array_column($latest_date_data, "state")
                    );
                    if ($array_number == "") {
                        
                        header("Content-type: application/json");

                        http_response_code(404);

                        echo json_encode(array(
                            "ok" => false,
                            "status" => 404, 
                            "message" => "Invalid date or no such data from Malaysia Database! Please try again!",
                        ));
                        
                    } else {
                        header("Content-type: application/json");
                        header("Access-Control-Allow-Origin: *");

                        http_response_code(200);

                        echo json_encode(array(
                            "ok"=> true, 
                            "status" => 200,
                            "result" => json_encode($latest_date_data[$array_number]), 
                        ));
                    }
                }
            }
        }
    }
}
?>
