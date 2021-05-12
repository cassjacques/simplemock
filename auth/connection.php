<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "admin123";
$dbname = "simplemock";

$link = mysqli_connect("localhost", "root", "admin123", "simplemock");

if(!$link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}



// create database simplemock

// CREATE TABLE users (
    //  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //  username VARCHAR(30) NOT NULL,
    //  email VARCHAR(30) NOT NULL,
    //  password VARCHAR(30) NOT NULL,
    //  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);