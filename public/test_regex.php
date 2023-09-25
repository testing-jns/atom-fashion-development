<?php 




$uri = "/search/{category}/{search_value}";
$rgx_get_custom_uri = "/(?={)(.*?)(?<=})/";
preg_match_all($rgx_get_custom_uri, $uri, $res_test);
var_dump($res_test[0]);

// uri yang udah di setup
$temp1 = [
    "",
    "search",
    "{category}",
    "{search_value}",
    "settings"
];

// uri dari request an
$temp2 = [
    "",
    "search",
    "makanan",
    "bebas aja sih, misal ayam goyeng",
    "settings"
];


$diff = array_diff($temp1, $temp2);

$heheh = array_filter(array_diff($temp1, $temp2), function($diff) use($temp1, $temp2) {
    $diff_index = array_search($diff, $temp1);
    
    $rgx_get_custom_uri = "/(?={)(.*?)(?<=})/";
    preg_match($rgx_get_custom_uri, $diff, $reg_res);
    if (!empty($reg_res)) return empty($temp2[$diff_index]);

    return boolval($diff_index);
});

$same_length = count($temp1) === count($temp2);
$exact_uri = empty($heheh);

var_dump($same_length);
var_dump($exact_uri);


// var_dump($heheh);
// var_dump($same_length);

// foreach ($diff as $value) {
//     $y = array_search($value, $temp1);
//     var_dump(!empty($temp2[$y]));
// }


die();


// nanti di loop

// $unconsistant_uri_index = array_search("{yyy}", $temp1);
// var_dump($unconsistant_uri_index);
$unconsistant_uri_indexs = array_map(function($unconsistant_uri) use($temp1) {
    return array_search($unconsistant_uri, $temp1);
}, $res_test[0]);

var_dump($unconsistant_uri_indexs);

$index_now;
$test = array_filter($temp1, function($key) use($temp1, $temp2, $unconsistant_uri_indexs, &$index_now) {
    // if ($temp1[$key] === $temp2[$key] || $key === $unconsistant_uri_index) return true;
    if ($temp1[$key] === $temp2[$key] ?? "") return true;

    foreach ($unconsistant_uri_indexs as $index) {
        
    }
    // $ya = count(array_filter($unconsistant_uri_indexs, function($x) use($temp2) {
    //     var_dump($temp2[$x]);
    //     return !empty($temp2[$x]);
    // }));

    // var_dump($ya);
    // return $unconsistant_uri_indexs === $ya;
}, ARRAY_FILTER_USE_KEY);

var_dump($test);

// array(3) {
//     [0]=>
//     string(0) ""
//     [1]=>
//     string(6) "search"
//     [2]=>
//     string(10) "{category}"
//   }
//   int(3)
//   array(3) {
//     [0]=>
//     string(0) ""
//     [1]=>
//     string(6) "search"
//     [3]=>
//     string(14) "{search_value}"
//   }
  


// var_dump(array_search("{umur}", $temp1)); // -> array key 


// var_dump($temp1 === $temp2);

// echo preg_replace("/\s/", "", "testing hehehe");

die();
// Example : 
// /search/{search_value}/

// 1. 
// Regex: /(?<=\{)(.*?)(?=\})/
// Result: search_value

// 2. 
// Regex: /(?={)(.*?)(?<=})/
// Result: {search_value}

// 3. 
// Regex: /(?=\/{)(.*?)(?<=}\/)/
// Result: /{search_value}/

$hey = [
    "/user",
    "/user/{account_id}",
    "/user/{account_id}/settings",
];

$str_1 = "/user/{account_id}";
$str_2 = "/user/{account_id}/";
$str_3 = "/user/{account_id}/settings";
$rgx_get_variable = "/(?<=\{)(.*?)(?=\})/";
// $rgx_get_custom_uri = "/(?=\/{)(.*?)(?<=}\/)/"; // /{accouund_id}/
$rgx_get_custom_uri = "/(?=\/{)(.*?)(?<=})/";

// $temp_var = preg_match($rgx_get_variable, $str_3, $res_var);
$temp_cus = preg_match($rgx_get_custom_uri, $str_3, $res_cus);

// var_dump($temp_var);
// var_dump($res_var);
// if $res_var empty -> no custom uri variable found
echo "";
// var_dump($temp_cus);
var_dump($res_cus);
var_dump(explode($res_cus[0], $str_1));
var_dump(explode($res_cus[0], $str_2));
var_dump(explode($res_cus[0], $str_3));


// $str_1 = "/user/{account_id}";
// $str_2 = "/user/{account_id}/";
// if !empty && != "/"

// $bad_url = "/test/ok///////////////////////////////////";

// var_dump(rtrim($bad_url, "/"));



?>