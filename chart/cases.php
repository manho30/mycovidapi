<?php
/**
 * Variable
 * 
 * @param {string} $string
 * @param {string} $fill
 * @param {string} $color
 * 
 * @param {int} $width
 * @param {int} $point
 * 
 * @param {bool} $ygrid
 * @param {bool} $xgrid
 */

$date = $_GET["date"]; 
$fill = $_GET["fill"];
$title = $_GET["title"]; 
$color = $_GET["color"];

$width = $_GET["width"];
$point = $_GET["point"];

$xgrid = $_GET["xgrid"];
$ygrid = $_GET["ygrid"];

/**
 * Detect request method
 * 
 * @return Error code when method not match.
 */
if ($_SERVER['REQUEST_METHOD'] =='DELETE' || $_SERVER['REQUEST_METHOD'] == 'PUT') {
    header("Content-type: application/json");

    http_response_code(405);

    echo json_encode(array(
        "ok"=> false, 
        "status" => 405,
        "message" => "Method not accepted, use GET or POST instead!" , 
    ));
    die();
} 
if (empty($date)) {
    header("Content-type: application/json");

    http_response_code(400);
    $str = json_encode('{"type":"line","data":{"labels":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"datasets":[{"data":[12,6,5,18,12,20,50,80,90,78,24,67],"fill":false,"borderColor":getGradientFillHelper("vertical",["#fafa6e","#ecf76f","#dff470","#d2f072","#c5ed74","#b9e976","#ace578","#a0e17b","#95dd7d","#89d880","#7ed482","#73cf84","#68ca87","#5dc589","#52c18a","#48bc8c","#3eb78d"]),"borderWidth":3,"pointRadius":0,}]},"options":{"legend":{"display":false},"scales":{"xAxes":[{"display":true,"gridLines":{"display":false,},}],"yAxes":[{"display":true,"gridLines":{"display":false,},}]},"title":{"text":"Covid-19data","display":true,},}}');
    echo json_encode(array(
        "ok" => false,
        "status" => 400,
        "message" => null
    ));
    
} else {
    $chart_config = array(
            "type" => "line", 
            "data" => array(
                "labels" => array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"),
                "datasets" => array(
                    array(
                        "data" => array(12,6,5,18,12,20,50,80,90,78,24,67), 
                        "fill" => false, 
                        "borderColor" => $color, 
                        "borderWidth" => $width,
                        "pointRadius" => $point
                    )
                ) 
            ), 
            "options" => array(
                "legend" => array(
                    "display" => false
                ),
                "scales" => array(
                    "xAxes" => array(
                        array(
                            "display" => true,
                            "gridLines" => array(
                                "display" => false,                        
                            ),
                        )
                    ), 
                    "yAxes" => array(
                        array(
                            "display" => true,
                            "gridLines" => array(
                                "display" => false,                        
                            ),
                        )
                    )
                ), 
                "title" => array(
                    "text" => "Covid-19data",
                    "display" => true,
                ),
            )
        );
$query = urlencode(json_encode($chart_config));
    $image = file_get_contents('https://quickchart.io/chart?c=$query');
    http_response_code(200);
    header('Content-type: image/png;');
    header("Content-Length: " . strlen($image));
    echo $image;
}
?>
