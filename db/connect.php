<?php
$host_name = '192.168.1.8';
$user_name = 'root';
$pass_word = '';
//$pass_word = 'm9a7r5s3';
$database_name = 'teledata';

//Mysqli
$con = mysqli_connect($host_name, $user_name, $pass_word, $database_name);

//Mysql
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name); ?>
