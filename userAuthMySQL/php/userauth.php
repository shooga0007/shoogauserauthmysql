<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $country, $email, $gender, $password){
    //create a connection variable using the db function in config.php
    $conn = db(); 
   $query = "SELECT * FROM students WHERE email = '$email'";  
   $result = mysqli_query($conn, $query);
   $user = mysqli_fetch_assoc($result);
   if ($user){
    if ($user['email']=== $email){
        echo "this email has been taken";
        exit;
    }
   }
   $query = "INSERT INTO students(full_names, country, email, gender, password) VALUES ('$fullnames', '$country', '$email', '$gender', '$password')";
if (mysqli_query($conn, $query)){
    echo "user registered succesfully";
}
}



//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard 
    $query = "SELECT * FROM students WHERE email ='$email' AND password = '$password'";
    // var_dump($query);
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
    $username = $student['full_names'];
    if(mysqli_num_rows($result) > 0){
        //echo "found";
        session_start();
        $_SESSION['username'] = $username;
        header('location: ../dashboard.php');
    } else {
        header('location: ../forms/login.html');
        // echo "wrong credentials";
    }

}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
    $query = "SELECT * FROM students WHERE email ='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0){
        echo "user does not exist";
     } else {
        $sql = "UPDATE students SET
        password = '$password'
        WHERE email = '$email'
        ";

        mysqli_query($conn, $sql);
        echo "password updated";
     }
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>
               </form>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     //delete user with the given id from the database
     // echo $id;
     $query = "DELETE FROM students WHERE id =$id";
     // echo $query;
     if(mysqli_query($conn, $query)){
        header('location:'. $_SERVER['PHP_SELF']. '?all=');
     } else {
        echo "error; ". mysqli_error($conn);
     }

    }
     

 
