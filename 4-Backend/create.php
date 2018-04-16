<?php

$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
mysqli_query($con,"CREATE DATABASE ign");
$con->select_db("ign");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

mysqli_query($con, "CREATE TABLE `content` (
					`guid` varchar(100) NOT NULL,
					`category` varchar(8) NOT NULL,
					`title` varchar(1000) NOT NULL,
					`description` varchar(10000) NOT NULL,
					`pubDate` varchar(1000) NOT NULL,
					`link` varchar(1000) NOT NULL,
					`slug` varchar(1000) DEFAULT NULL,
					`networks` varchar(1000) DEFAULT NULL,
					`state` varchar(1000) DEFAULT NULL,
					`tags` varchar(1000) DEFAULT NULL,
					PRIMARY KEY (`guid`)
					) ENGINE=MyISAM DEFAULT CHARSET=latin1");
					
mysqli_query($con, "CREATE TABLE `thumbnails` (
					`guid` varchar(100) NOT NULL,
					`thumbnail` varchar(1000) NOT NULL,
					`size` varchar(30) NOT NULL,
					`width` int(11) NOT NULL,
					`height` int(11) NOT NULL,
					PRIMARY KEY (`guid`,`size`)
					) ENGINE=MyISAM DEFAULT CHARSET=latin1");
					
echo "Tables created";
?>