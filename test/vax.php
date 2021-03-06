<?php
// query from http request
$query = $_GET["date"];
$beautify = $_GET["beautify"];
$state = $_GET["state"];

// return default data (latest data ) if no specify query
if(!$query || $query == "now"){
    if (!$state){
        $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        curl_close($curl);

        // change the csv data as array of arrays form. 
        $data_array = array_map("str_getcsv", explode("\n", $response));

        // remove variable elements from the first line
        $variable_list = array_shift($data_array);

        // list all variables in an array.
        $variable_name = []; 
        foreach ($variable_list as $variable) {
            $variable_name[] = $variable;
        }

        // add variable name to every single data.
        $out_data = [];
        for ($i = 0; $i < count($data_array) - 1; $i++) {
            $data = array_combine($variable_name, $data_array[$i]);
            $out_data[$i] = $data;
        }

        // return the last element from array 
        $find_latest_data = $out_data[count(json_decode(json_encode($out_data))) - 1];
        $final_data = $find_latest_data;

        // no beautify requested 
        if (!$beautify){

            // header for return json data.
            header("Content-type: application/json");
            http_response_code(200); 

            echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                "result" => $final_data
            ));
            die();

        } else {

            // header for return json data.
            header("Content-type: application/json");
            http_response_code(200);

            echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                "result" => $final_data
            ), JSON_PRETTY_PRINT);

            die();
        }

    // for request state data
    } else {
        $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_state.csv";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        curl_close($curl);

        // change the csv data as array of arrays form. 
        $data_array = array_map("str_getcsv", explode("\n", $response));

        // remove variable elements from the first line
        $variable_list = array_shift($data_array);

        // list all variables in an array.
        $variable_name = []; 
        foreach ($variable_list as $variable) {
            $variable_name[] = $variable;
        }

        // add variable name to every single data.
        $out_data = [];
        for ($i = 0; $i < count($data_array) - 1; $i++) {
            $data = array_combine($variable_name, $data_array[$i]);
            $out_data[$i] = $data;
        }

        // return the last element from array 
        $state_array = array_chunk($out_data, 16);
        $find_latest_data = $out_data[count($state_data) - 1];
        $final_data = $find_latest_data;

        // header for return json data.
        header("Content-type: application/json");
        http_response_code(200);

        echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                //"result" => $state_array, 
                "result2" => $out_data, 
            ), JSON_PRETTY_PRINT);

        die(); 
    } 
} else {
    if($query){
        if($query == 'all'){
            $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);
            curl_close($curl);

            // make the csv data to array of arrays form. 
            $data_array = array_map("str_getcsv", explode("\n", $response));

            // remove variable elements from the first line
            $variable_list = array_shift($data_array);

            // list all variables in an array.
            $variable_name = []; 
            foreach ($variable_list as $variable) {
                $variable_name[] = $variable;
            }

            // add variable name to every single data.
            $out_data = [];
            for ($i = 0; $i < count($data_array) - 1; $i++) {
                $data = array_combine($variable_name, $data_array[$i]);
                $out_data[$i] = $data;
            }

            // change data to array form
            $final_data = array_chunk($out_data, 1);

            // header for return json data.
            header("Content-type: application/json");
            http_response_code(200);

            if (!$beautify || $beautify == "false" || $beautify == false) {

                echo json_encode(array(
                    "ok"=> true, 
                    "status" => 200,
                    "result" => $final_data
                ));
                die();

            } else {

            echo json_encode(array(
                    "ok"=> true, 
                    "status" => 200,
                    "result" => $final_data
            ), JSON_PRETTY_PRINT);
            die();

            }

        // ?????????????????????
        // query with specify date
        } else {

            $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);
            curl_close($curl);

            // change the csv data to array of arrays form. 
            $data_array = array_map("str_getcsv", explode("\n", $response));

            // remove variable elements from the first line
            $variable_list = array_shift($data_array);

            // list all variables in an array.
            $variable_name = []; 
            foreach ($variable_list as $variable) {
                $variable_name[] = $variable;
            }

            // add variable name to every single data.
            $out_data = [];
            for ($i = 0; $i < count($data_array) - 1; $i++) {
                $data = array_combine($variable_name, $data_array[$i]);
                $out_data[$i] = $data;
            }

            // find the data from incoming query.
            $data_index = array_search($query, array_column(json_decode(json_encode($out_data), true), "date")); 

            // no data found
            // ?????????????????????????????????????????????
            if (!$data_index) {

                // header for return json data.
                // ?????? json ????????????????????????
                header("Content-type: application/json");
                http_response_code(404);

                echo json_encode(array(
                    "ok"=> false, 
                    "status" => 404,
                    "result" => "The data you requested could not be found in the Malaysia Ministry of Health database, please try again!" 
                ));

                die();
            } else {
                if (!$beautify || $beautify == "false" || $beautify == false) {

                    // header for return json data.
                    // ?????? json ????????????????????????
                    header("Content-type: application/json");
                    http_response_code(200);

                    echo json_encode(array(
                        "ok"=> true, 
                        "status" => 200,
                        "result" => $out_data[$data_index]
                    ));

                    die();

                } else {

                    // header for return json data.
                    // ?????? json ????????????????????????
                    header("Content-type: application/json");
                    http_response_code(200);

                    echo json_encode(array(
                        "ok"=> true, 
                        "status" => 200,
                        "result" => $out_data[$data_index]
                    ), JSON_PRETTY_PRINT );

                    die();
                }
            }
        }
    }
}
?>
