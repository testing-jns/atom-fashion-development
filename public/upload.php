<?php
// var_dump(php_ini_loaded_file());


echo "<pre>";
print_r($_FILES);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title> 
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        Pilih file: <input type="file" name="berkas" />
        <input type="submit" name="upload" value="upload" />
    </form> 
</body> 
</html>