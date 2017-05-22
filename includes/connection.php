<?php
//$con = mysqli_connect("localhost", "root", "", "punishment_game") or die("Connection not established");


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$con = new mysqli($server, $username, $password, $db);
?>
