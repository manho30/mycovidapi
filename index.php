// redirect to documentation page 
<?php 
echo json_encode(array(
    "ok" => true,
    "status" => 400,
    "message" => "Please Specify a value! Here will bring you to the API documentation!",
    ));
header("Refresh: 5; Location: https://manho30.github.io/mycovidapi/");
exit();
?>
