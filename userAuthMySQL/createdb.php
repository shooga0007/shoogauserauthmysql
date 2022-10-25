<?php
$host = "local host";
$user = "root";
$password = "";


$sql = "CREATE TABLE students (
    `id` int AUTO INCREMENT PRIMARY KEY,
    full names VARCHAR(120) NOT NULL,
    country VARCHAR(32) NOT NULL,
    email VARCHAR(60),
    gender VARCHAR(10),
    dob TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if($conn){
    if (mysqli_query($conn, $sql)) {
        echo "table Students created succesfully";
        } else {
            echo "Error creating table: ". mysqli_error($conn);
        }
        mysqli_close($conn);
 }