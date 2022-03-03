<?php
$url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

// no parameter
if (empty($_GET["date"])) {
    header("Content-type: application/json");    
    echo json_encode(array(
        "ok" => false,
        "status" => 400,
        "message" => "Parameter in yyyy-mm-dd was required",
    ), JSON_PRETTY_PRINT);    
} else {
    // request all data
    if ($_GET["date"] == "all") {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $label_name = [];
        $final_data = [];

        $data_array = array_map("str_getcsv", explode("\n", $resp));
        $all_labels_array = array_shift($data_array);

        foreach ($all_labels_array as $label) {
            $label_name[] = $label;
        }

        $count = count($data_array) - 1;

        for ($i = 0; $i < $count; $i++) {
            $data = array_combine($label_name, $data_array[$i]);
            $new_data[$i] = $data;
        }

        header("Content-type: application/json");        
        echo json_encode(array(
                "ok"=> true, 
                "status" => 200,
                "result" => $final_data, 
            ), JSON_PRETTY_PRINT);
            
    } else {
        if ($_GET["date"] == "now") {
            $url = "https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/vaccination/vax_malaysia.csv";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

            $label_name = [];

            $final_data = [];

            $data_array = array_map("str_getcsv", explode("\n", $resp));

            $labels = array_shift($data_array);

            foreach ($labels as $label) {
                $label_name[] = $label;
            }

            $count = count($data_array) - 1;

            for ($j = 0; $j < $count; $j++) {
                $data = array_combine($label_name, $data_array[$j]);

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
                "result" =>$datedata, 
            ), JSON_PRETTY_PRINT);
            
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

            $label_name = [];

            $final_data = [];

            $data_array = array_map("str_getcsv", explode("\n", $resp));

            $labels = array_shift($data_array);

            foreach ($labels as $label) {
                $label_name[] = $label;
            }

            $count = count($data_array) - 1;

            for ($j = 0; $j < $count; $j++) {
                $data = array_combine($label_name, $data_array[$j]);

                $final_data[$j] = $data;
            }

            header("Content-type: application/json");
            $data = json_encode($final_data);

            $array_number = array_search(
                $_GET["date"],
                array_column(json_decode($data, true), "date")
            );
            if ($array_number == "") {
                header("Content-type: application/json");
                echo json_encode(array(
                    "ok" => false,
                    "status" => 404, 
                    "message" => "Invalid date, please try again!",
                ), JSON_PRETTY_PRINT);
            } else {
                $data2 = json_decode($data);
                $datedata = $data2[$array_number];
                echo json_encode($datedata, JSON_PRETTY_PRINT);
            }
            exit();
        }
    }
}
?>
