<?php 

header("Content-Type: text/javascript");

$responses = [
    "meta" => [],
    "results" => [
        "error" => "Method not Allowed!"
    ]
];

$json_responses = json_encode(
    $responses, 
    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
);

http_response_code(405);
echo $json_responses;


?>
