<?php 

require_once "Database.php";


$db = new Database();
// $db->query("delete from siswa");
$temp = [
    ":id" => "56446",
    ":first_name" => "jhaufb",
    ":last_name" => "jhaufb",
    ":email" => "jhaufb",
    ":password" => "jhaufb",
    ":phone_number" => "jhaufb",
    ":address" => "jhaufb",
];
$sql = "insert into customers values (:id, :first_name, :last_name, :email, :password, :phone_number, :address)";
// $sql_get = "select * from siswa";
// $db->query($sql)->bindValue($temp)->resultAll();
$db->query($sql)->bindValue($temp);
$responses = $db->execute();
// $results = $db->query($sql_get)->rowCount();
// $db->bindValues(":nis", "2345");
// $db->bindValues(":nama", "2345");
// $db->bindValues(":kelas", "2345");
// $db->bindValues(":jurusan", "2345");
// // $db->bindValues($temp);

var_dump($responses->rowCount());


// die();
// var_dump($db->resultAll());
// var_dump($db->rowCount());



?>