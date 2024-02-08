<?php 

foreach (scandir(__DIR__) as $dir_content) {
    $path = __DIR__ . "/" . $dir_content;
    if (!is_file($path)) continue;
    if (boolval(substr_count($dir_content,".config.php"))) {
        require_once $path;
    }
}
