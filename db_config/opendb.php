<?php
include("config.php");
$conn = mysql_connect($db_host, $db_user, $db_pass);
$select = mysql_select_db($db_name);
?>