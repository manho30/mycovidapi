<?php
$date_request = $_GET["date"];
if (empty($date_request)) {
    header("Content-type: application/json");

    echo json_encode(array(
        "ok"=> false, 
        "status" => 400,
        "description" => "Parameter in yyyy-mm-dd was required" , 
    ));

} else {
    if ($date_request == "all") {
        $url =
            "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv";

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

        echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                "result" => $final_data, 
            ));

    } else {
        if ($date_request == "now") {
            $url =
                "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv";

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
            $data1 = json_encode($final_data);

            $data2 = json_decode($data1);
            $latest1 = count($data2);
            $latest = $latest1 - 1;
            $datedata = $data2[$latest];

            echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                "result" => $datedata, 
            ));

        } else {
            $url =
                "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv";

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

                echo json_encode(array(
                    "ok"=> false, 
                    "status" => 400,
                    "description" => "Invalid date, please try again!" , 
                ));

            } else {
                $data2 = json_decode($data);
                $datedata = $data2[$array_number];
                echo json_encode($datedata);
            }
            exit();
        }
    }
}
