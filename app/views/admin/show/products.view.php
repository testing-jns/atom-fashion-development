<?php

require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";

use core\Database;

$db = new Database();

$sql = "SELECT code, `name`,  thumbnail_id FROM products";

$response = $db->query($sql)->execute();
// var_dump($response);
$resultAll = $response->resultAll();


// foreach ($resultAll as $value) {
//     var_dump($value->name);
//     $sql = "SELECT * FROM thumbnails WHERE id = '$value->thumbnail_id'";
//     $response = $db->query($sql)->execute();
//     var_dump($response->resultAll());
// }

$total_products = count($resultAll);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <div class="container">
        <h1>Total Products : <?= $total_products; ?></h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultAll as $key => $value): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $value->name; ?></td>
                    <td>
                        <ul>
                        <?php 
                    $sql = "SELECT * FROM thumbnails WHERE id = '$value->thumbnail_id'";
                    $response = $db->query($sql)->execute();    
                    ?>
                    <?php foreach ($response->resultAll() as $v): ?>
                            <li>
                                <img src="<?= BASE_URL . "assets/img/products/" . $v->image; ?>" width="200">
                            </li>
                    <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>