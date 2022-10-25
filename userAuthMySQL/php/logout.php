<?php

function logout(){
    session_start();
    if(isset($_SESSION['username'])){
        session_destroy();
        header('location: ../forms/login.html');
    }
}
logout();