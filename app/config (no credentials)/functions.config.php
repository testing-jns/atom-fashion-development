<?php 

function custom_random(int $length = 32) {
    if ($length % 2 === 0) return bin2hex(random_bytes($length / 2));
    throw new Exception("Can't use odd numbers");
}