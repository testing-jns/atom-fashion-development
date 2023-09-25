<!-- 
    Created by Jhuanes Septinus
    Vanilla PHP MVC
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $view_data["title"] ?></title>

    <link rel="stylesheet" href="./assets/css/home.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to XI SIJA 2</h1>
        </header>
        <main>
            <div class="table_name">
                .....
            </div>
            <div class="infomation">
                <table>
                    <tbody>
                        <tr>
                            <th colspan="3">Keterangan</th>
                        </tr>
                        <tr>
                            <td>Total Siswa</td>
                            <td>:</td>
                            <td><?= $view_data["students_length"] ?></td>
                        </tr>
                        <tr>
                            <td>Detected</td>
                            <td>:</td>
                            <td><?= $view_data["directories_detected"] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="sija-students" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th></th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($view_data["sija_students"] as $value) : ?>
                    <tr>
                        <td class="presence"><?= $value["presence"] ?></td>
                        <td class="name"><?= $value["full_name"] ?></td>
                        <td class="semicolon">:</td>
<?php if (empty($value["web_link"])) : ?>
                        <td class="link">Not Detected!</td>
<?php else: ?>
                        <td class="link">
                            <a href="<?= $value["web_link"]?>" target="_blank" rel="noopener noreferrer"><?= $value["web_link"]?></a>
                        </td>
<?php endif; ?>
                    </tr>
<?php endforeach; ?>
                </tbody>
            </table>
            <div class="action">
                <button>UPLOAD YOUR WEB</button>
                <button onclick="location.reload();">REFRESH</button>
            </div>
        </main>
    </div>
    <footer></footer>
</body>
</html>