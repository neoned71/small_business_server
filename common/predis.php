<?php
require "predis/autoload.php";
Predis\Autoloader::register();

$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "hostname",
    "port" => port,
    "password” => “password"));
echo "Connected to Redis";


$x=$redis->lpush("users","3 4 5 56 6");
echo "<br>".$x." ".json_encode($redis->lrange("users",0,-1));


?>