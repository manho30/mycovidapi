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
        "message" => json_decode($str)//"Parameter in yyyy-mm-dd was required",
    ), JSON_UNESCAPED_SLASHES);
    
} else {
    
    $image = file_get_contents('https://quickchart.io/chart?c=%7Btype%3A%22line%22%2Cdata%3A%7Blabels%3A%5B%22Jan%22%2C%22Feb%22%2C%22Mar%22%2C%22Apr%22%2C%22May%22%2C%22Jun%22%2C%22Jul%22%2C%22Aug%22%2C%22Sep%22%2C%22Oct%22%2C%22Nov%22%2C%22Dec%22%5D%2Cdatasets%3A%5B%7Bdata%3A%5B12%2C6%2C5%2C18%2C12%2C20%2C50%2C80%2C90%2C78%2C24%2C67%5D%2Cfill%3Afalse%2CborderColor%3AgetGradientFillHelper(%22vertical%22%2C%5B%22%23fafa6e%22%2C%22%23ecf76f%22%2C%22%23dff470%22%2C%22%23d2f072%22%2C%22%23c5ed74%22%2C%22%23b9e976%22%2C%22%23ace578%22%2C%22%23a0e17b%22%2C%22%2395dd7d%22%2C%22%2389d880%22%2C%22%237ed482%22%2C%22%2373cf84%22%2C%22%2368ca87%22%2C%22%235dc589%22%2C%22%2352c18a%22%2C%22%2348bc8c%22%2C%22%233eb78d%22%5D)%2CborderWidth%3A3%2CpointRadius%3A0%2C%7D%5D%7D%2Coptions%3A%7Blegend%3A%7Bdisplay%3Afalse%7D%2Cscales%3A%7BxAxes%3A%5B%7Bdisplay%3Atrue%2CgridLines%3A%7Bdisplay%3Afalse%2C%7D%2C%7D%5D%2CyAxes%3A%5B%7Bdisplay%3Atrue%2CgridLines%3A%7Bdisplay%3Afalse%2C%7D%2C%7D%5D%7D%2Ctitle%3A%7Btext%3A%22Covid-19data%22%2Cdisplay%3Atrue%2C%7D%2C%7D%7D');
    http_response_code(200);
    header('Content-type: image/png;');
    header("Content-Length: " . strlen($image));
    echo $image;
}
?>
