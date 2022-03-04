<?php 
header("Content-type: application/json");

echo json_encode(array(
    "ok" => true,
    "status" => 400,
    "message" => "Please specify a value! Refer to API documentation!",
    "documentation" => "https://manho30.github.io/mycovidapi/", 
));
header("Location: https://manho30.github.io/mycovidapi/");

exit();
?>
